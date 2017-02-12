<?php
/**
 * Created by PhpStorm.
 * User: zacharyolson
 * Date: 2/11/17
 * Time: 7:43 PM
 */

namespace AppBundle\Repositories;


use Symfony\Component\HttpFoundation\Session\Session;

class HeatmapRepository
{
    const POINTS_MAP = [
        '1' => 2,
        '2' => 2,
        '3' => 2,
        '4' => 2,
        '5' => 2,
        '6' => 2,
        '7' => 2,
        '8' => 2,
        '9' => 2,
        '10' => 3,
        '11' => 3,
        '12' => 3,
        '13' => 3,
        '14' => 3,
    ];

    public function calculateValues($formData)
    {
        $accuracyValues = [];
        $efficiencyValues = [];
        foreach (self::POINTS_MAP as $position => $pointsPerShot) {
            $shotsMade = $formData["makes".$position];
            $shotsAttempted = $formData["attempts".$position];
            $accuracyValues[$position] = $this->calculateAccuracy($shotsMade, $shotsAttempted);
            $efficiencyValues[$position] = $this->calculateEfficiency($shotsMade, $pointsPerShot, $shotsAttempted);
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