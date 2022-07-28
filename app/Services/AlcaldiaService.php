<?php

namespace App\Services;

use App\Models\Alcaldia;

class AlcaldiaService
{

  public $type = [
    1 => 'Áreas verdes',
    2 => 'Centro de barrio',
    3 => 'Equipamiento',
    4 => 'Habitacional',
    5 => 'Habitacional y comercial',
    6 => 'Industrial',
    7 => 'Sin Zonificación'
  ];

  public function getData($zipcode, $construction_type)
  {

    return Alcaldia::where('codigo_postal', $zipcode)
      ->where('uso_construccion', $this->type[$construction_type])
      ->get();
  }

  public function calculateUnite($alcaldias)
  {
    $array_unit = [];
    foreach ($alcaldias as $item) {
      $div = $item->valor_suelo - $item->subsidio;
      if($div > 0)
        $array_unit[] = $item->superficie_terreno / $div ;
    }

    return $array_unit;

  }

  public function calculateConstruction($alcaldias)
  {
    $array_construction = [];
    foreach ($alcaldias as $item) {
      $div = $item->valor_suelo - $item->subsidio;
      if($div > 0)
        $array_construction[] = $item->superficie_construccion / $div;
    }

    return $array_construction;
  }

  public function average($array)
  {
    $average = 0;
    if (count($array) > 0) {
      $average = array_sum($array) / count($array);
    }

    return $average;
  }

  public function results($type_calc, $alcaldias)
  {
    $price_unit = 0;
    $price_unit_construction = 0;

    switch ($type_calc) {
      case 'min' :
        if (count($alcaldias) > 0) {
          $price_unit = min($this->calculateUnite($alcaldias));
          $price_unit_construction = min($this->calculateConstruction($alcaldias));
        }
        break;
      case 'max' :
        if (count($alcaldias) > 0) {
          $price_unit = max($this->calculateUnite($alcaldias));
          $price_unit_construction = max($this->calculateConstruction($alcaldias));
        }
        break;
      case 'avg' :
        if (count($alcaldias) > 0) {
          $price_unit = $this->average($this->calculateUnite($alcaldias));
          $price_unit_construction = $this->average($this->calculateConstruction($alcaldias));
        }
    }

    return [
      $price_unit,
      $price_unit_construction
    ];
  }


}