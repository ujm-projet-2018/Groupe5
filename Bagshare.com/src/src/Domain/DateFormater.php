<?php

namespace Bagshare\Domain;

class DateFormater {
    
    private function __construct(){}
    
    /* date setter */
    public function setDate($date){
        return strtotime($date);
    }
    /* date formater */
     public static function formaterDate($date_tmstmp){
        $dateFormat = "Le ";
        $mois = "Janvier";
        $date = getdate($date_tmstmp);
        $dateFormat .= $date['mday'];
        switch($date['mon']){
            case 2:
                $mois = " Fevrier ";break;
            case 3:
                $mois = " Mars ";break;
            case 4:
                $mois = " Avril ";break;
            case 5:
                $mois = " Mai ";break;
            case 6:
                $mois = " Juin ";break;
            case 7:
                $mois = " Juillet ";break;
            case 8:
                $mois = " Aout ";break;
            case 9:
                $mois = " Septembre "; break;
            case 10:
                $mois = " Octobre ";break;
            case 11:
                $mois = " Novembre ";break;
            case 12:
                $mois = " Decembre";break;
            default:
                break;
        }
        $dateFormat .= $mois;
        $dateFormat .= $date['year'];
        $dateFormat .= " à ";
        $dateFormat .= $date['hours'];
        $dateFormat .= " h ";
        $dateFormat .= $date['minutes'];
        $dateFormat .= " min ";
        
        
        return $dateFormat;
    }
}