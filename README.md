# Task Manager - Laravel, Vue 3 & Inertia.js

This project is a simple task management application using Laravel, Vue 3, and Inertia.js. It allows users to create, update, and delete tasks, with filtering options based on task status.

## Requirements

- PHP 8.0+
- Composer
- Node.js & npm
- MySQL or any compatible database

## Installation

### 1. Clone the repository

```bash
git clone <repository-url>
cd <repository-folder>
```

### 2. Install dependencies

Install PHP dependencies via Composer:

```bash
composer install
```

Install JavaScript dependencies via npm:

```bash
npm install
```

### 3. Set up environment variables

Create a `.env` file by copying the example file:

```bash
cp .env.example .env
```

Update the `.env` file to match your local database and other environment configurations:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Run migrations

Create the database structure by running the migrations:

```bash
php artisan migrate
```

You can also run the optional seeder to populate the database with initial data:

```bash
php artisan db:seed
```

### 6. Compile assets

Use the following command to compile Vue.js and Inertia.js assets:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 7. Start the application

Run the Laravel development server:

```bash
php artisan serve
```

### 8. Access the application

Open your browser and navigate to:

```
http://localhost:8000
```

## Features

1. **Task List**: View a list of all tasks with the ability to filter by `ALL`, `NEW`, or `DONE` statuses.
2. **Create Task**: Add a new task with a title and description.
3. **Edit Task**: Update the task's title, description, or mark its status as `DONE`.
4. **Delete Task**: Tasks with status `NEW` can be deleted. `DONE` tasks cannot be deleted.
5. **Task Status**: Change a task's status to `DONE` directly from the task list. 
6. **Task Styling**: Completed (`DONE`) tasks are styled with a strikethrough.
7. **Modal Confirmation**: Display a confirmation modal for actions such as marking a task as `DONE`, deleting a task, or editing.
8. **Seeder**: Optionally seed the database with initial tasks for testing.
9. **Modal confirmations**: important actions like marking tasks as done, editing, or deleting.
10. **Seeder**: populate the database with sample tasks.

## Routes and Pages

- `/tasks` (Task List): Lists all tasks and allows filtering by `ALL`, `NEW`, `DONE`.
- `/tasks/create` (Create Task): Page for adding a new task.
- `/tasks/{id}/edit` (Edit Task): Page for updating task details.
- From the task list, tasks can be marked as `DONE` or deleted.

### Additional Information

#### Code Quality:
- The code emphasizes both functionality and structure.
- It features a basic but responsive, user-friendly interface.

#### Further Development:
- Potential future improvements include:
  - Enhancing error handling to improve robustness.
  - Increasing the number of unit tests for higher code coverage.

### Contact
For any questions regarding this project or the task, please contact Carlos at [carlos.beltran.exposito@gmail.com](mailto:carlos.beltran.exposito@gmail.com).

