<?php

use Illuminate\Database\Seeder;
use App\Comite;

class ComitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('comites')->delete();

      $new = Comite::create([
          'nom' => 'Archi',
      ]);

      $new = Comite::create([
          'nom' => 'CBA',
      ]);

      $new = Comite::create([
          'nom' => 'Barbou',
      ]);

      $new = Comite::create([
          'nom' => 'Dentisterie',
      ]);

      $new = Comite::create([
          'nom' => 'Droit',
      ]);

      $new = Comite::create([
          'nom' => 'GDL',
      ]);

      $new = Comite::create([
          'nom' => 'Gramme',
      ]);

      $new = Comite::create([
          'nom' => 'HEC',
      ]);

      $new = Comite::create([
          'nom' => 'Ingé',
      ]);

      $new = Comite::create([
          'nom' => 'Info',
      ]);

      $new = Comite::create([
          'nom' => 'ISEPK',
      ]);

      $new = Comite::create([
          'nom' => 'ISIL',
      ]);

      $new = Comite::create([
          'nom' => 'ISIS',
      ]);

      $new = Comite::create([
          'nom' => 'Jonfosse',
      ]);

      $new = Comite::create([
          'nom' => 'Médecine',
      ]);

      $new = Comite::create([
          'nom' => 'Paludia',
      ]);

      $new = Comite::create([
          'nom' => 'Pharma',
      ]);
      $new = Comite::create([
          'nom' => 'Philo',
      ]);
      $new = Comite::create([
          'nom' => 'Psycho',
      ]);
      $new = Comite::create([
          'nom' => 'Rivageois',
      ]);
      $new = Comite::create([
          'nom' => 'Sainte Croix',
      ]);
      $new = Comite::create([
          'nom' => 'Sainte Julienne',
      ]);
      $new = Comite::create([
          'nom' => 'Saint Laurent',
      ]);
      $new = Comite::create([
          'nom' => 'Sciences',
      ]);
      $new = Comite::create([
          'nom' => 'Seraing',
      ]);

      $new = Comite::create([
          'nom' => 'Verviers',
      ]);

    }
}
