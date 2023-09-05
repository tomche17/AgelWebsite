<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('app.env') == 'local')
        {
            if (!App\User::where('email', 'test@test.com')->first())
            {
                $user = new App\User();
                $user->name = 'Bolland';
                $user->surname = 'Julien';
                $user->email = 'test@test.com';
                $user->password = bcrypt('test'); //password
                $user->droit = 1;
                $user->comite = 'agel';
                $user->phone = '0472440515';
                $user->fonction = "tréso";
                $user->adresse = "Boulevard Piercot, 28 0011, 4000 Liège";
                $user->save();
            }

            if (!App\User::where('email', 'test@user.com')->first())
            {
                $user = new App\User();
                $user->name = 'Bledard';
                $user->surname = 'Enculé';
                $user->email = 'test@user.com';
                $user->password = bcrypt('test'); //password
                $user->droit = 2;
                $user->comite = 'ingé';
                $user->phone = '0472440515';
                $user->fonction = "prési";
                $user->adresse = "Rue du trou du cul, 10, 4000 Liège";
                $user->save();
            }

        }
    }
}
