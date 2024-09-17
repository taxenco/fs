<template>
  <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-3xl font-semibold mb-6 text-gray-900 text-center">Edit Task</h1>

    <!-- Show loader when submitting changes -->
    <Loader v-if="form.processing" />

    <!-- Form for editing the task -->
    <form v-if="!form.processing" @submit.prevent="submit">
      <!-- Title input -->
      <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700 mb-2" for="title">Title</label>
        <input 
          type="text" 
          v-model="form.title" 
          id="title" 
          class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
          :class="{ 'border-red-500': form.errors.title }"
          placeholder="Enter task title"
          required
        />
        <div v-if="form.errors.title" class="text-red-500 text-sm mt-2">{{ form.errors.title }}</div>
      </div>

      <!-- Description input -->
      <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700 mb-2" for="description">Description</label>
        <textarea 
          v-model="form.description" 
          id="description" 
          class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
          :class="{ 'border-red-500': form.errors.description }"
          rows="4"
          placeholder="Enter task description"
          required
        ></textarea>
        <div v-if="form.errors.description" class="text-red-500 text-sm mt-2">{{ form.errors.description }}</div>
      </div>

      <!-- Status select -->
      <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700 mb-2" for="status">Status</label>
        <select 
          v-model="form.status" 
          id="status" 
          class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
        >
          <option value="NEW">New</option>
          <option value="DONE">Done</option>
        </select>
        <div v-if="form.errors.status" class="text-red-500 text-sm mt-2">{{ form.errors.status }}</div>
      </div>

      <!-- Buttons for saving changes or going back -->
      <div class="flex justify-between space-x-4">
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
          Save Changes
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Loader from '../../Components/Loader.vue';

export default {
  name: 'UpdateTask',
  components: { Loader },
  props: {
    /**
     * The task object to be updated.
     * @type {Object}
     * @required
     */
    task: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    // Initialize the form with useForm
    const form = useForm({
      title: props.task.title || '',
      description: props.task.description || '',
      status: props.task.status || 'NEW',
    });

    /**
     * Submit the form to update the task.
     * Sends a PUT request to the server with the task data.
     * On success, redirects to the task list page.
     * On error, logs the error message to the console.
     */
    const submit = () => {
      form.put(`/edit-task/${props.task.id}`, {
        onSuccess: () => {
          // Redirect to the desired page, e.g., task list
          Inertia.visit('/');
        },
        onError: () => {
          // Optionally handle errors globally
          console.error('There were errors updating the task.');
        },
      });
    };

    /**
     * Navigate back to the previous page.
     * Redirects to the main task list page.
     */
    const goBack = () => {
      Inertia.visit('/');
    };

    return { form, submit, goBack };
  },
};
</script>

<style scoped>
.input-error {
  border-color: red;
}

.text-red-500 {
  color: #f56565;
}

.btn {
  padding: 0.75rem 1.25rem;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0056b3;
}
</style>
