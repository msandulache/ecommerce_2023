<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CategorySeeder extends AbstractSeed
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
        $data = [
            [
                'name'    => 'Popular',
                'status' => 1,
            ],
            [
                'name'    => 'Romanian Night',
                'status' => 1,
            ],
            [
                'name'    => 'Films français',
                'status' => 1,
            ],
            [
                'name'    => 'Now playing',
                'status' => 1,
            ]
        ];

        $categories = $this->table('categories');
        $categories->truncate();

        $categories->insert($data)
            ->saveData();
    }
}
