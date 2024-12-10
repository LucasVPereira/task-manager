Gerenciamento de Tarefas - API REST

Descrição

Este projeto é uma API REST desenvolvida em PHP utilizando o framework Laravel, projetada para gerenciar uma lista de tarefas. A API implementa um CRUD completo com funcionalidades adicionais como validação de dados, filtros, e testes automatizados.

Funcionalidades

Criar uma tarefa.

Listar todas as tarefas, com suporte a filtros por status.

Visualizar os detalhes de uma tarefa específica.

Atualizar uma tarefa existente.

Excluir uma tarefa.

Requisitos

PHP >= 8.1

Composer

Laravel >= 10

Banco de Dados (MySQL, PostgreSQL, etc.) configurado

Setup do Projeto

Clone o repositório:

git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio

Instale as dependências:

composer install

Configure o arquivo .env:

Copie o arquivo de exemplo:

cp .env.example .env

Atualize as variáveis de ambiente para conectar ao seu banco de dados.

Gere a chave da aplicação:

php artisan key:generate

Execute as migrações:

php artisan migrate

Execute o servidor local:

php artisan serve

A API estará disponível em http://localhost:8000.

Endpoints da API

1. Criar Tarefa

POST /api/tasks

Corpo da Requisição:

{
  "title": "Nova Tarefa",
  "description": "Detalhes da tarefa (opcional)",
  "status": "pending"
}

Resposta:

201 Created:

{
  "id": "uuid",
  "title": "Nova Tarefa",
  "description": "Detalhes da tarefa",
  "status": "pending",
  "created_at": "2024-12-06T12:00:00Z",
  "updated_at": "2024-12-06T12:00:00Z"
}

2. Listar Tarefas

GET /api/tasks

Filtros:

/api/tasks?status=pending

Resposta:

200 OK:

[
  {
    "id": "uuid",
    "title": "Tarefa 1",
    "description": "",
    "status": "pending",
    "created_at": "2024-12-06T12:00:00Z",
    "updated_at": "2024-12-06T12:00:00Z"
  },
  {
    "id": "uuid",
    "title": "Tarefa 2",
    "description": "",
    "status": "in_progress",
    "created_at": "2024-12-06T12:00:00Z",
    "updated_at": "2024-12-06T12:00:00Z"
  }
]

3. Obter Detalhes de uma Tarefa

GET /api/tasks/{id}

Resposta:

200 OK:

{
  "id": "uuid",
  "title": "Tarefa 1",
  "description": "Detalhes da tarefa",
  "status": "pending",
  "created_at": "2024-12-06T12:00:00Z",
  "updated_at": "2024-12-06T12:00:00Z"
}

404 Not Found:

{
  "error": "Task not found"
}

4. Atualizar uma Tarefa

PUT /api/tasks/{id}

Corpo da Requisição:

{
  "title": "Tarefa Atualizada",
  "description": "Nova descrição",
  "status": "completed"
}

Resposta:

200 OK:

{
  "id": "uuid",
  "title": "Tarefa Atualizada",
  "description": "Nova descrição",
  "status": "completed",
  "created_at": "2024-12-06T12:00:00Z",
  "updated_at": "2024-12-06T14:00:00Z"
}

404 Not Found:

{
  "error": "Task not found"
}

5. Excluir uma Tarefa

DELETE /api/tasks/{id}

Resposta:

204 No Content

404 Not Found:

{
  "error": "Task not found"
}

Testes Automatizados

Execute os testes automatizados para validar a API:

php artisan test

Os testes incluem:

Criação de tarefa.

Listagem de tarefas.

Obtenção de detalhes de uma tarefa.

Atualização de tarefa.

Exclusão de tarefa.

Estrutura do Projeto

Models: Contém a lógica de negócio (ex.: Task.php).

Controllers: Controladores que gerenciam as requisições (ex.: TaskController.php).

Requests: Validações de entrada (ex.: StoreTaskRequest, UpdateTaskRequest).

Tests: Testes de integração e unidade para a API.

Considerações

Este projeto segue boas práticas como validação de dados, tratamento de erros e uso de UUIDs para maior segurança. Testes automatizados foram implementados para garantir a estabilidade das funcionalidades principais.