<?php

namespace AppBundle\Controller\MapGenerator;

use AppBundle\Form\BasketballInputFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapGeneratorController extends Controller
{

    // TODO:  positionsMap needs to be passed into base.html.twig once with a refresh only after new pros are added
    // so we don't have to query that table each page load
    /**
     * @Route("/input", name="stats_input")
     */
    public function inputAction(Request $request)
    {
        $form = $this->createForm(
            BasketballInputFormType::class
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $heatmapRepository = $this->container->get('heatmap_repository');
            list($accuracyValues, $efficiencyValues) = $heatmapRepository->calculateValues($form->getData());
            $this->addFlash(
                'success',
                'Data Accepted.  Generating Heatmap.'
            );

            $em = $this->getDoctrine()->getManager();
            $heatmapOptions = array(
                'accuracyValues' => $accuracyValues,
                'efficiencyValues' => $efficiencyValues,
                'positionsMap' => $heatmapRepository->positionsMap($em)
            );
            
            $current_user = $this->getUser();
            if ($current_user != null) {
                $formDate = $form->getData()['date'];
                $dataSetRepository = $this->container->get('user_data_set_repository');
                $dataSetRepository->persistUserDataSet(
                    $current_user,
                    $accuracyValues,
                    $efficiencyValues,
                    $formDate
                );

                $this->addFlash(
                    'success',
                    'Saved Data Entry!'
                );

                $heatmapOptions['playerName'] = $current_user->getName();
            }

            return $this->render('map_generator/show_heatmap.html.twig', $heatmapOptions);
        }

        return $this->render('map_generator/input_form.html.twig', [
            'heatmapForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/pro_show/{proName}", name="pro_show")
     */
    public function proShowAction($proName)
    {
        $proId = $this->getDoctrine()->getRepository('AppBundle:Pro')->findOneByName($proName)->getId();
        $proRepository = $this->container->get('pro_data_set_repository');
        $latestStats = $proRepository->getLatestPlayerStats($proId);

        return $this->render('map_generator/show_heatmap.html.twig', array(
            'accuracyValues' => $latestStats["accuracyData"],
            'efficiencyValues' => $latestStats["efficiencyData"],
            'positionsMap' => $this->container->get('heatmap_repository')->positionsMap($em = $this->getDoctrine()->getManager()),
            'playerName' => $proName            
        ));
    }

}