<?php
namespace App\Helpers;
class Helpers
{
  public static function hourDifference($date_ini, $date_end){
    $difference = strtotime($date_ini) - strtotime($date_end);
    $hours = abs($difference / (60 * 60));
    return ceil($hours);
  }
}
