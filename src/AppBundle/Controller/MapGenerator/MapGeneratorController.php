<?php


namespace AppBundle\Controller\MapGenerator;

use AppBundle\Form\BasketballInputFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapGeneratorController extends Controller
{
    /**
     * @Route("/input", name="user_input")
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
            return $this->render('map_generator/show_heatmap.html.twig', array(
                'accuracyValues' => $accuracyValues,
                'efficiencyValues' => $efficiencyValues,
                'sidebarColClass' => 'col-md-3',
                'bodyColClass' => 'col-md-9'
            ));
        }

        return $this->render('map_generator/input_form.html.twig', [
            'heatmapForm' => $form->createView(),
            'sidebarColClass' => 'col-md-5',
            'bodyColClass' => 'col-md-7'
        ]);
    }

    /**
     * @Route("/show_heatmap", name="show_heatmap")
     */
//    public function showHeatmapAction(Request $request)
//    {
//        return $this->render('map_generator/show_heatmap.html.twig');
//    }
}