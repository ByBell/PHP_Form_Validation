<?php
/**
 * Created by PhpStorm.
 * User: gaetan
 * Date: 09/02/2018
 * Time: 12:17
 */

namespace App\Service;

class Bleech
{
    /**
     * isCorrect\Date()
     */
    protected $date;

    public function getAge(\DateTime $dateTime){
        $today = new \DateTime();
        $interval = $dateTime->diff($today);
        return $interval->y;
        //$dateConverted = date_create_from_format('Y/m/d', $date);
        //$dateConverted->getTimestamp();
        //return $diff->format('%Y an(s), %m mois et %d jours');
    }
}