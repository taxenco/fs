<template>
    <div class="p-4">
      <h1 class="text-2xl font-bold mb-4 text-gray-800">Edit Task</h1>
      <!-- Form for editing an existing task -->
      <form v-if="task" @submit.prevent="updateTask">
        <div class="mb-4">
          <label class="block text-gray-700">Title</label>
          <input
            v-model="task.title"
            type="text"
            class="w-full px-3 py-2 border rounded"
            required
          />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Description</label>
          <textarea
            v-model="task.description"
            class="w-full px-3 py-2 border rounded"
            required
          ></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Status</label>
          <select v-model="task.status" class="w-full px-3 py-2 border rounded">
            <option value="IN_PROGRESS">In Progress</option>
            <option value="DONE">Done</option>
          </select>
        </div>
        <button
          type="submit"
          class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
        >
          Update Task
        </button>
      </form>
      <p v-else>Loading task...</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'EditTask',
    props: {
      id: {
        type: [String, Number],
        required: true,
      },
    },
    data() {
      return {
        task: null,
      };
    },
    created() {
      this.fetchTask();
    },
    methods: {
      fetchTask() {
        // Get the task ID from the props
        const taskId = this.id;
        // Fetch the task data based on the ID
        // Replace this with actual data fetching logic
        const taskList = [
          {
            id: 1,
            title: 'Task 1',
            description: 'Description for Task 1',
            status: 'IN_PROGRESS',
          },
          {
            id: 2,
            title: 'Task 2',
            description: 'Description for Task 2',
            status: 'DONE',
          },
          {
            id: 3,
            title: 'Task 3',
            description: 'Description for Task 3',
            status: 'IN_PROGRESS',
          },
        ];
        this.task = taskList.find((task) => task.id === parseInt(taskId));
      },
      updateTask() {
        // Implement the logic to update the task
        // For now, we'll just log the updated task
        console.log('Updated Task:', this.task);
        // Navigate to the task list after updating using Inertia
        this.$inertia.visit('/');
      },
    },
  };
  </script>

  