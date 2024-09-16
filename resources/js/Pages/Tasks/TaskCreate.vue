<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Create Task</h1>
    <!-- Form for creating a new task -->
    <form @submit.prevent="createTask">
      <div class="mb-4">
        <label class="block text-gray-700">Title</label>
        <input
          v-model="title"
          type="text"
          class="w-full px-3 py-2 border rounded"
          required
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Description</label>
        <textarea
          v-model="description"
          class="w-full px-3 py-2 border rounded"
          required
        ></textarea>
      </div>
      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Create Task
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'CreateTask',
  data() {
    return {
      title: '',
      description: '',
    };
  },
  methods: {
    createTask() {
      // Implement the logic to create a new task
      // For now, we'll just log the new task
      const newTask = {
        id: Date.now(),
        title: this.title,
        description: this.description,
        status: 'IN_PROGRESS',
      };
      console.log('New Task:', newTask);
      // Navigate to the task list after creation using Inertia
      this.$inertia.visit('/');
    },
  },
};
</script>

<style scoped>
/* Add any additional styles if needed */
</style>
