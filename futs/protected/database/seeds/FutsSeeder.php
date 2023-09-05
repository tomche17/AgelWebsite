<?php

use Illuminate\Database\Seeder;

use App\Fut;

class FutsSeeder extends Seeder
{
    public function run()
    {
      DB::table('futs')->delete();

      $new = Fut::create([
          'nom' => 'Jupiler 50L',
          'prix' => 146.05,

      ]);

      $new = Fut::create([
          'nom' => 'Leffe blonde 30L',
          'prix' => 134.64,
      ]);

      $new = Fut::create([
          'nom' => 'Leffe brune 30L',
          'prix' => 134.64,

      ]);

      $new = Fut::create([
          'nom' => 'Leffe Ruby 20L',
          'prix' => 104.24,

      ]);

      $new = Fut::create([
          'nom' => 'Leffe Royale',
          'prix' => 114.31,
      ]);

      $new = Fut::create([
          'nom' => 'Hoegaarden Rosée 20L',
          'prix' => 94.61,
      ]);

      $new = Fut::create([
          'nom' => 'Scotch CTS 30L',
          'prix' => 130.99,
      ]);



    }
}
