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
        // $this->call(UsersTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserUserTableSeeder::class);
        $this->call(MessageTableSeeder::class);
        $this->call(MessageUserTableSeeder::class);
        $this->call(PublicationsTableSeeder::class);
        $this->command->info('Publication table Seeder!' );
    }
}
