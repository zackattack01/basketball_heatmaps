<?php

namespace AppBundle\Repository;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class HeatmapRepository
{
    // for each position as key, value is [pointValue, xCoord, yCoord]
    const POINTS_MAP = [
        '1' => [2, 426, 515],
        '2' => [2, 270, 525],
        '3' => [2, 426, 370],
        '4' => [2, 582, 525],
        '5' => [2, 702, 520],
        '6' => [2, 625, 330],
        '7' => [2, 426, 290],
        '8' => [2, 225, 330],
        '9' => [2, 150, 520],
        '10' => [3, 45, 475],
        '11' => [3, 135, 260],
        '12' => [3, 426, 180],
        '13' => [3, 715, 260],
        '14' => [3, 800, 475]
    ];

    const POSITIONS_MAP = [
        1 => 'Point Guard', 
        2 =>'Shooting Guard',
        3 => 'Small Forward',
        4 => 'Power Forward',
        5 => 'Center'
    ];

    public function calculateValues($formData)
    {
        $accuracyValues = [];
        $efficiencyValues = [];
        foreach (self::POINTS_MAP as $position => $positionInformation) {
            $shotsMade = $formData["makes".$position];
            if ($shotsMade == null) {
                $shotsMade = 0;
            }

            $shotsAttempted = $formData["attempts".$position];
            if ($shotsAttempted == null) {
                $shotsAttempted = 10;
            }

            $accuracyValues[$position] = [
                'value' => $this->calculateAccuracy($shotsMade, $shotsAttempted),
                'xCoord' => $positionInformation[1],
                'yCoord' => $positionInformation[2],
            ];
            $efficiencyValues[$position] = [
                'value' => $this->calculateEfficiency($shotsMade, $positionInformation[0], $shotsAttempted),
                'xCoord' => $positionInformation[1],
                'yCoord' => $positionInformation[2]
            ];
        }

        return array(
            $accuracyValues,
            $efficiencyValues
        );
    }

    public function calculateValuesFromCSV($csvFilePath)
    {   
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $stats = $serializer->decode(str_replace(" ", "", file_get_contents($csvFilePath)), 'csv');
        $formData = $this->formDataFromCSV($stats);

        return $this->calculateValues($formData);
    }

    public function formDataFromCSV($stats)
    {   
        $tempFormData = array();
        foreach ($stats as $entry => $dataSet) {
            $pos = $dataSet["position"];
            $tempFormData["makes".$pos] = $dataSet["makes"];
            $tempFormData["attempts".$pos] = $dataSet["attempts"];
        }

        return $tempFormData;
    }

    public function calculateAccuracy($shotsMade, $shotsAttempted = 10)
    {
        return ($shotsMade / $shotsAttempted);
    }

    public function calculateEfficiency($shotsMade, $pointsPerShot, $shotsAttempted = 10)
    {
        $totalPoints = $shotsMade * $pointsPerShot;
        return ($totalPoints / $shotsAttempted);
    }

    public function positionsMap($em)
    {
        $pros = $em->createQueryBuilder()
            ->select('pros.name, pros.position')
            ->from('AppBundle:Pro', 'pros')
            ->getQuery()
            ->getResult();

        $positionsMapValues = array();
        foreach (self::POSITIONS_MAP as $posId => $posLabel) {
            $matchedPositions = array_filter($pros, function($proEntry) use($posId) {
                return $proEntry["position"] == $posId;
            });

            $positionsMapValues[$posLabel] = array_map(function($proData) {
                return $proData["name"];
            }, $matchedPositions);
        };

        return $positionsMapValues;
    }

}