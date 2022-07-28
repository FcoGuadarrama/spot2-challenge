<?php

namespace Database\Seeders;

use App\Models\Alcaldia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlcaldiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Alcaldia::truncate();

      $csvFile = fopen(storage_path("data/sig_cdmx_GUSTAVO A. MADERO_08-2020.csv"), "r");

      $firstline = true;
      while (($data = fgetcsv($csvFile, 4000, ",")) !== FALSE) {
        if (!$firstline) {
          DB::table('alcaldias')->insert([
            "codigo_postal" => $data['0'] == '' ? null : $data[0],
            "superficie_terreno" => $data['1'] == '' ? null : $data[1],
            "superficie_construccion" => $data['2'] == '' ? null : $data[2],
            "uso_construccion" => $data['3'] == '' ? null : $data[3],
            "valor_unitario" => $data['4'] == '' ? null : $data[4],
            "valor_suelo" => $data['5'] == '' ? null : $data[5],
            "subsidio" => $data['6'] == '' ? null : $data[6]
          ]);
        }
        $firstline = false;
      }

      fclose($csvFile);
    }
}
