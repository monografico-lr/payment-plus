<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CompanyTableSeeder::class,
            ServicesTableSeeder::class,
            SectionsTableSeeder::class
            ]);
    }
}

// php artisan make:seeder UsersTableSeeder
// php artisan db:seed

//php artisan db:seed --class=UsersTableSeeder


// You may also seed your database using the migrate:refresh command, which will also rollback and re-run all of your migrations. This command is useful for completely re-building your database:

//     php artisan migrate:refresh --seed
