<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Task::create([
                'title' => "Task Title $i",
                'description' => "Description for Task $i",
                'status' => $i % 2 == 0 ? 'DONE' : 'NEW' // To produce diferent statuses
            ]);
        }
    }
}
