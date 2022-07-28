<?php

namespace App\Http\Controllers;

use App\Models\Alcaldia;
use App\Services\AlcaldiaService;
use Illuminate\Http\Request;

class AlcaldiaController extends Controller
{

  private $alcaldiaService;

  public function __construct(AlcaldiaService $alcaldiaService)
  {
    $this->alcaldiaService = $alcaldiaService;
  }


  /**
   * Handle the incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @return array[]
   */
  public function __invoke(Request $request, $zipcode, $calc)
  {
    $alcaldias = $this->alcaldiaService->getData($zipcode, $request->construction_type);
    $results = $this->alcaldiaService->results($calc, $alcaldias);

    return [
      'status' => true,
      'payload' => [
        'type' => $calc,
        'price_unit' => $results[0],
        'price_unit_construction' => $results[1],
        'elements' => count($alcaldias),
      ]
    ];
  }
}
