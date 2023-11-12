<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $faker = Faker\Factory::create('ro_RO');
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'firstname'    => $faker->firstName(),
                'lastname'    => $faker->lastName(),
                'username'    => $faker->userName(),
                'email'    => $faker->email(),
                'password'    => password_hash($faker->password(),PASSWORD_DEFAULT),
            ];
        }


        $users = $this->table('users');
        $users->truncate();

        $users->insert($data)
            ->saveData();
    }
}
