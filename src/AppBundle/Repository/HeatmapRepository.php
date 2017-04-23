<?php

namespace AppBundle\Repository;

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

    public function calculateValues($formData)
    {
        $accuracyValues = [];
        $efficiencyValues = [];
        foreach (self::POINTS_MAP as $position => $positionInformation) {
            $shotsMade = $formData["makes".$position];
            $shotsAttempted = $formData["attempts".$position];
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

    public function calculateAccuracy($shotsMade, $shotsAttempted = 10)
    {
        return ($shotsMade / $shotsAttempted);
    }

    public function calculateEfficiency($shotsMade, $pointsPerShot, $shotsAttempted = 10)
    {
        $totalPoints = $shotsMade * $pointsPerShot;
        return ($totalPoints / $shotsAttempted);
    }
}