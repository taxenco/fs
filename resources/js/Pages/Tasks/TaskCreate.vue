<template>
  <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-semibold mb-6 text-gray-900 text-center">Create Task</h1>

    <!-- Show loader when creating task -->
    <Loader v-if="isLoading" />

    <!-- Form for creating a new task -->
    <form v-if="!isLoading" @submit.prevent="createTask">
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
      <div class="flex justify-between">
        <button
          type="button"
          @click="goBack"
          class="bg-gray-500 text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50"
        >
          Go Back
        </button>
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
import Loader from '../../Components/Loader.vue';

export default {
  name: 'CreateTask',
  components: { Loader },
  data() {
    return {
      title: '',
      description: '',
      isLoading: false, // Track loading state
    };
  },
  methods: {
    async createTask() {
      this.isLoading = true; // Show loader
      try {
        // Make POST request to create the task
        const response = await axios.post('/create-task', {
          title: this.title,
          description: this.description,
        });
        this.$inertia.visit('/');
      } catch (error) {
        console.error('Error creating task:', error);
      }
    },
    goBack() {
      // Redirect back to the home page
      this.$inertia.visit('/');
    },
  },
};
</script>
