<template>
  <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-semibold mb-6 text-gray-900">Create Task</h1>
    <!-- Form for creating a new task -->
    <form @submit.prevent="createTask">
      <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700 mb-2">Title</label>
        <input
          v-model="title"
          type="text"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
          placeholder="Enter task title"
          required
        />
      </div>
      <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700 mb-2">Description</label>
        <textarea
          v-model="description"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
          rows="4"
          placeholder="Enter task description"
          required
        ></textarea>
      </div>
      <div class="flex justify-end">
        <button
          type="submit"
          class="bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
        >
          Create Task
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'CreateTask',
  data() {
    return {
      title: '',
      description: '',
    };
  },
  methods: {
    async createTask() {
      try {
        // Make POST request to create the task
        const response = await axios.post('/create-task', {
          title: this.title,
          description: this.description,
        });

        console.log('Task Created:', response.data);

        // Optionally redirect to another page after the task is created
        this.$inertia.visit('/');
      } catch (error) {
        console.error('Error creating task:', error);
        // Optionally handle errors (e.g., show error messages to the user)
      }
    },
  },
};
</script>

<style scoped>
/* Base styles for the component */
body {
  background-color: #f9f9f9;
  font-family: 'Arial', sans-serif;
}

h1 {
  color: #343a40;
}

/* Input and textarea styling */
input,
textarea {
  transition: all 0.3s ease;
  padding: 0.75rem 1rem;
  font-size: 1rem;
}

input::placeholder,
textarea::placeholder {
  color: #a0a0a0;
}

/* Button styling */
button {
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

button:hover {
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
</style>
