<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\TaskFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        TaskFactory::times(30)->create();
    }
}
