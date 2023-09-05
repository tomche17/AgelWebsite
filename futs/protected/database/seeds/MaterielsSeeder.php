<?php

use Illuminate\Database\Seeder;
use App\Materiel;

class MaterielsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('materiels')->delete();

      $new = Materiel::create([
          'nom' => 'Pompe',

      ]);

      $new = Materiel::create([
          'nom' => 'Bonbonne Co2 10L',
      ]);

      $new = Materiel::create([
          'nom' => 'Table de brasseur',
      ]);

      $new = Materiel::create([
          'nom' => 'Banc de brasseur',
      ]);

    }
}
