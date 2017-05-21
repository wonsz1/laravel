<?php

use Illuminate\Database\Seeder;
//use App\Database\Seeds\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call(UserTableSeeder::class);
      	//$this->call('UserTableSeeder');
    }
}
