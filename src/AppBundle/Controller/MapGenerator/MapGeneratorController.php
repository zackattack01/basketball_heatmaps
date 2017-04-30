<?php

namespace AppBundle\Controller\MapGenerator;

use AppBundle\Form\BasketballInputFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapGeneratorController extends Controller
{
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
            }

            return $this->render('map_generator/show_heatmap.html.twig', array(
                'accuracyValues' => $accuracyValues,
                'efficiencyValues' => $efficiencyValues,
                'positionsMap' => $heatmapRepository->positionsMap()
            ));
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
        return $this->render('map_generator/show_heatmap.html.twig', array(
            
        ));
    }

}