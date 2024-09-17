<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * Test storing a new task.
     *
     * @return void
     */
    public function test_store_new_task()
    {
        $response = $this->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Task created successfully.');

        $this->assertCount(1, Task::all());
        $this->assertEquals('Test Task', Task::first()->title);
    }

    /**
     * Test deleting a task.
     *
     * @return void
     */
    public function test_delete_task()
    {
        $task = Task::create([
            'title' => 'Task to Delete',
            'description' => 'This task will be deleted.',
        ]);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertJson(['message' => 'Task deleted successfully.']);
        $this->assertCount(0, Task::all());
    }

    /**
     * Test updating a task.
     *
     * @return void
     */
    public function test_edit_task()
    {
        $task = Task::create([
            'title' => 'Old Task',
            'description' => 'This task will be updated.',
            'status' => 'NEW',
        ]);

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Updated Task',
            'description' => 'This task has been updated.',
            'status' => 'DONE',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Task updated successfully.');

        $task->refresh(); // Refresh the task instance to get updated values
        $this->assertEquals('Updated Task', $task->title);
        $this->assertEquals('DONE', $task->status);
    }
}
