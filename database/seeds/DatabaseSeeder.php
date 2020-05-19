<?php

use Illuminate\Database\Seeder;
use App\Model\Books;
use App\Model\Authors;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(\App\Model\Books::class, 50)->create();
    }
}
