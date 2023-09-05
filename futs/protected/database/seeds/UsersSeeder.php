<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->delete();

      $new = User::create([
          'nom' => 'Cardinaels',
          'prenom' => 'Axel',
          'email' => 'axel.cardinaels@icloud.com',
          'password' => bcrypt("M@cbook215"),
          'is_admin' => '1',
          'is_responsable' => '1',
          'comite_id' => null,
          'validate' => 1,
          'emails' => 1
      ]);

      $new = User::create([
          'nom' => 'Nouara',
          'prenom' => 'Taha',
          'email' => 'nouarataha@gmail.com',
          'password' => bcrypt("Lololaplusbelle69."),
          'is_admin' => '1',
          'is_responsable' => '1',
          'comite_id' => null,
          'validate' => 1,
          'emails' => 1
      ]);

      $new = User::create([
          'nom' => 'Devet',
          'prenom' => 'Bastien',
          'email' => 'Bastien.devet@gmail.com',
          'password' => bcrypt("yolo"),
          'is_admin' => '1',
          'is_responsable' => '1',
          'comite_id' => null,
          'validate' => 1,
          'emails' => 0
      ]);

      $new = User::create([
          'nom' => 'Lentz',
          'prenom' => 'Charles',
          'email' => 'charles.lentz3@gmail.com',
          'password' => bcrypt("yolo"),
          'is_admin' => '1',
          'is_responsable' => '1',
          'comite_id' => null,
          'validate' => 1,
          'emails' => 0
      ]);

      $new = User::create([
          'nom' => 'Marenne',
          'prenom' => 'Pierre',
          'email' => 'pierre.maren@hotmail.com',
          'password' => bcrypt("yolo"),
          'is_admin' => '1',
          'is_responsable' => '1',
          'comite_id' => null,
          'validate' => 1,
          'emails' => 0
      ]);

      $new = User::create([
          'nom' => 'Deschamps',
          'prenom' => 'Florian',
          'email' => 'florian.deschamps@gmail.com',
          'password' => bcrypt("yolo"),
          'is_admin' => '1',
          'is_responsable' => '1',
          'comite_id' => null,
          'validate' => 1,
          'emails' => 0
      ]);

      $new = User::create([
          'nom' => 'Josse',
          'prenom' => 'Olivier',
          'email' => 'olivier-josse@hotmail.com',
          'password' => bcrypt("yolo"),
          'is_admin' => '1',
          'is_responsable' => '1',
          'comite_id' => null,
          'validate' => 1,
          'emails' => 0
      ]);
    }
}
