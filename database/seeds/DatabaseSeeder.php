<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('PRAGMA foreign_keys = OFF;');

        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);

        DB::statement('PRAGMA foreign_keys = ON;');
    }
}
