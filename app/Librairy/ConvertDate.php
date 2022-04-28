<?php

namespace Librairy;

class ConvertDate
{

    /**
     * @param $year
     * @param $month
     * @param $day
     * @return string
     */
    public function getJourLettre($day): string
    {
        $tabjourLettre = [1 => 'Lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi', 6 => 'Samedi', 7 => 'Dimanche'];
        return $tabjourLettre[$day];
    }

    /**
     * @return array
     */
    public function getTabjourlettre(): array
    {
        return [0 => 'Lundi', 1 => 'Mardi', 2 => 'Mercredi', 3 => 'Jeudi', 4 => 'Vendredi', 5 => 'Samedi', 6 => 'Dimanche'];
    }

    /**
     * @param $month
     * @return string
     */
    public function getMoisLettre($month): string
    {
        $tabMois = [1 => 'Janvier', 2 => "Février", 3 => "Mars", 4 => "Avril", 5 => "Mai", 6 => "Juin", 7 => "Juillet", 8 => "Août", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Décembre"];
        return $tabMois[$month];
    }

    /**
     * @param $week
     * @param $year
     * @return string
     */
    public function getLundi($week, $year): string
    {
        $timestamp = $this->getTimetamp($year, $week);
        $jour = date('Y-m-d', $timestamp);
        return date('Y-m-d', strtotime($jour));
    }

    /**
     * @param $week
     * @param $year
     * @return string
     */
    public function getLundilettre($week, $year): string
    {
        return date('d', strtotime($this->getLundi($week, $year))) . ' ' . $this->getMoisLettre((int)date('m', strtotime($this->getLundi($week, $year))));
    }

    public function getVendredi($week, $year)
    {
        return date('Y-m-d', strtotime("+6 day", strtotime($this->getLundi($week, $year))));

    }

    /**
     * @param $week
     * @param $year
     * @return string
     */
    public function getVendredilettre($week, $year): string
    {
        return date('d', strtotime($this->getVendredi($week, $year))) . ' ' . $this->getMoisLettre((int)date('m', strtotime($this->getVendredi($week, $year))));

    }

    /**
     * @param $week
     * @param $year
     * @return array
     */
    public function getWeek($week, $year): array
    {
        $jour = date('Y-m-d', $this->getTimetamp($year, $week));
        $tabjour = array();
        for ($i = 0; $i < 7; $i++) {
            $tabjour[] = $jour;
            $jour = date('Y-m-d', strtotime("+1 day", strtotime($jour)));

        }
        return $tabjour;
    }

    /**
     * @param $year
     * @param $week
     * @return float|int
     */
    public function getTimetamp($year, $week)
    {
        $firstDayInYear = date("N", mktime(0, 0, 0, 1, 1, $year));
        if ($firstDayInYear < 5)
            $shift = -($firstDayInYear - 1) * 86400;
        else
            $shift = (8 - $firstDayInYear) * 86400;
        if ($week > 1) $weekInSeconds = ($week - 1) * 604800; else $weekInSeconds = 0;
        $timestamp = mktime(0, 0, 0, 1, 1, $year) + $weekInSeconds + $shift;
        return $timestamp;
    }


}