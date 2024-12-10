<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use Tests\TestCase; // Certifique-se de importar TestCase corretamente

class TaskTest extends TestCase
{
    use RefreshDatabase;

    // Teste para criação de uma tarefa
    public function test_create_task()
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Test Task',
            'status' => 'pending',
        ]);

        // Verifica se a resposta tem o status correto e a estrutura esperada
        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'title', 'status']);
    }

    // Teste para listar todas as tarefas
    public function test_list_tasks()
    {
        // Cria 3 tarefas usando a factory
        Task::factory()->count(3)->create();

        // Envia uma requisição GET para listar as tarefas
        $response = $this->getJson('/api/tasks');

        // Verifica se a resposta tem status 200 e se retornou 3 tarefas
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_get_task_details()
    {
        // Cria uma tarefa
        $task = Task::factory()->create();

        // Envia uma requisição GET para obter os detalhes da tarefa
        $response = $this->getJson("/api/tasks/{$task->id}");

        // Verifica se o status é 200 e se os detalhes da tarefa estão presentes
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $task->id, 'title' => $task->title]);
    }

    // Teste para atualizar uma tarefa
    public function test_update_task()
    {
        $task = Task::factory()->create();

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Task',
            'status' => 'completed',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Task', 'status' => 'completed']);
    }

    // Teste para excluir uma tarefa
    public function test_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
    public function test_filter_tasks_by_status()
    {
        Task::factory()->create(['status' => 'pending']);
        Task::factory()->create(['status' => 'completed']);
    
        $response = $this->getJson('/api/tasks?status=pending');
    
        $response->assertStatus(200)
             ->assertJsonCount(1)
             ->assertJsonFragment(['status' => 'pending']);
    }
}