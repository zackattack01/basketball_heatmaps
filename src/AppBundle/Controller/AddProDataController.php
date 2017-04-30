<?php

namespace AppBundle\Controller;

use AppBundle\Form\ProStatsInputFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddProDataController extends Controller
{
    /**
     * @Route("/add_new_pro_stats", name="pro_stats_input")
     */
    public function addProStatsAction(Request $request)
    {
        $form = $this->createForm(
            ProStatsInputFormType::class
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pro = $this->getDoctrine()->getRepository('AppBundle:Pro')->findOneByName($form->getData()['name']);
            if ($pro) {
                $this->addFlash(
                    'info',
                    'Pro already added.  Logging Stats.'
                );
            } else {
                $proRepository = $this->container->get('pro_repository');
                $pro = $proRepository->persistPro($form->getData());
                
                $this->addFlash(
                    'success',
                    'New Pro Accepted.  Logging Stats.'
                );
            }
            $heatmapRepository = $this->container->get('heatmap_repository');
            try {
                $csvFile = $form->getData()['csv_stats_upload'];
                if ($csvFile) {
                    $csvPath = $csvFile->getPathname();
                    list($accuracyValues, $efficiencyValues) = $heatmapRepository->calculateValuesFromCSV($csvPath);

                    $formDate = $form->getData()['date'];
                    $dataSetRepository = $this->container->get('pro_data_set_repository');
                    $dataSetRepository->persistproDataSet(
                        $pro,
                        $accuracyValues,
                        $efficiencyValues,
                        $formDate
                    );

                    $this->addFlash(
                        'success',
                        'Data Accepted.  Generating Heatmap.'
                    );

                    return $this->render('map_generator/show_heatmap.html.twig', array(
                        'accuracyValues' => $accuracyValues,
                        'efficiencyValues' => $efficiencyValues,
                        'positionsMap' => $heatmapRepository->positionsMap($this->getDoctrine()->getManager()),
                        'playerName' => $pro->getName()
                    ));
                } else {
                    $this->addFlash(
                        'error',
                        'No CSV file detected for upload'
                    );
                }
            } catch(\Exception $e) {
                $this->addFlash(
                    'error',
                    'There was an issue uploading the CSV, please make sure that it is formatted correctly. ie: position,makes,misses'
                );
            }
            
        }

        return $this->render('login/pro_stats_input_form.html.twig', [
            'newProForm' => $form->createView()
        ]);
    }

}