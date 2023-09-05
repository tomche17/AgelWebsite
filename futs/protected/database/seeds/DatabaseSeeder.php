<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('FutsSeeder');
        $this->call('EventsSeeder');
        $this->call("MaterielsSeeder");
        $this->call("UsersSeeder");
        $this->call("ComitesSeeder");
    }
}
