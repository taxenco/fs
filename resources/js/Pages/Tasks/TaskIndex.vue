<template>
  <div class="flex flex-col md:flex-row p-4">
    <div class="w-full">
      <!-- Header with Create Task Button -->
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">List of Tasks</h1>
        <!-- Create Task Button -->
        <Link
          href="/create-task"
          class="text-blue-600 hover:underline flex items-center"
          prefetch
        >
          <i class="fas fa-plus mr-2"></i> Create Task
        </Link>
      </div>

      <!-- Filter Buttons -->
      <div class="mb-4">
        <button
          @click="setFilter('ALL')"
          :class="filterStatus === 'ALL' ? 'font-bold underline text-blue-700' : 'text-gray-600'"
          class="mr-4"
        >
          All
        </button>
        <button
          @click="setFilter('NEW')"
          :class="filterStatus === 'NEW' ? 'font-bold underline text-blue-700' : 'text-gray-600'"
          class="mr-4"
        >
          New
        </button>
        <button
          @click="setFilter('DONE')"
          :class="filterStatus === 'DONE' ? 'font-bold underline text-blue-700' : 'text-gray-600'"
        >
          Done
        </button>
      </div>

      <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
          <tr style="background-color: #E6F2FA;" class="border-b">
            <th class="px-4 py-2 text-left text-gray-800">Title</th>
            <th class="px-4 py-2 text-left text-gray-800">Description</th>
            <th class="px-4 py-2 text-left text-gray-800">Status</th>
            <th class="px-4 py-2 text-left text-gray-800">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="task in filteredTasks"
            :key="task.id"
            class="border-b hover:bg-blue-50"
          >
            <td
              class="px-4 py-2"
              :class="{ 'line-through text-gray-500': task.status === 'DONE' }"
            >
              {{ task.title }}
            </td>
            <td
              class="px-4 py-2"
              :class="{ 'line-through text-gray-500': task.status === 'DONE' }"
            >
              {{ task.description }}
            </td>
            <td class="px-4 py-2">
              <span
                class="inline-flex items-center px-2 py-1 text-xs font-medium leading-4 rounded-full"
                :class="{
                  'bg-orange-100 text-orange-800': task.status === 'IN_PROGRESS',
                  'bg-green-100 text-green-800': task.status === 'DONE',
                  'bg-red-100 text-red-800': task.status === 'DELETED',
                }"
              >
                {{ task.status }}
              </span>
            </td>
            <td class="px-4 py-2">
              <div class="flex items-center">
                <!-- Edit Task Link -->
                <Link
                  :href="`/edit-task/${task.id}`"
                  class="text-blue-600 hover:underline mr-2 flex items-center"
                  prefetch
                >
                  <i class="fas fa-edit mr-1"></i> Edit
                </Link>
                <!-- Show action buttons if the task is not 'DONE' -->
                <div v-if="task.status !== 'DONE'" class="flex items-center">
                  <button
                    @click="openModal(task, 'done')"
                    class="text-green-600 hover:underline ml-2 flex items-center"
                  >
                    <i class="fas fa-check mr-1"></i> Mark as Done
                  </button>
                  <button
                    @click="openModal(task, 'delete')"
                    class="text-red-600 hover:underline ml-2 flex items-center"
                  >
                    <i class="fas fa-trash mr-1"></i> Delete
                  </button>
                </div>
                <!-- Display message when no actions are available -->
                <span v-else class="text-gray-500 ml-2">No actions available</span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Confirmation Modal -->
    <ConfirmationModal
      :visible="isModalVisible"
      :title="modalTitle"
      :message="modalMessage"
      :actionType="modalActionType"
      @confirm="confirmAction"
      @cancel="isModalVisible = false"
    />
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import ConfirmationModal from '../../Components/ConfirmationModal.vue';

export default {
  components: {
    ConfirmationModal,
    Link,
  },
  props: {
    tasks: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      // Initialize taskList from the tasks prop
      taskList: [...this.tasks],
      // Current filter status ('ALL', 'NEW', 'DONE')
      filterStatus: 'ALL',
      // Modal state
      isModalVisible: false,
      modalTitle: '',
      modalMessage: '',
      modalActionType: '', // 'done' or 'delete'
      selectedTask: null,
    };
  },
  computed: {
    /**
     * Returns a filtered list of tasks based on the selected filter.
     *
     * @returns {Array} - The filtered list of tasks.
     */
    filteredTasks() {
      if (this.filterStatus === 'ALL') {
        return this.taskList;
      } else if (this.filterStatus === 'NEW') {
        return this.taskList.filter((task) => task.status !== 'DONE');
      } else if (this.filterStatus === 'DONE') {
        return this.taskList.filter((task) => task.status === 'DONE');
      }
      return this.taskList;
    },
  },
  methods: {
    /**
     * Opens the confirmation modal for a specific action.
     *
     * @param {Object} task - The task object.
     * @param {string} actionType - The action type ('done' or 'delete').
     */
    openModal(task, actionType) {
      this.selectedTask = task;
      this.modalActionType = actionType;
      this.modalTitle =
        actionType === 'delete' ? 'Delete Task' : 'Complete Task';
      this.modalMessage =
        actionType === 'delete'
          ? `Are you sure you want to delete "${task.title}"?`
          : `Are you sure you want to mark "${task.title}" as done?`;
      this.isModalVisible = true;
    },
    /**
     * Confirms the action after modal confirmation.
     */
    confirmAction() {
      if (this.modalActionType === 'delete') {
        this.deleteTask(this.selectedTask);
      } else if (this.modalActionType === 'done') {
        this.markTaskAsDone(this.selectedTask);
      }
      this.isModalVisible = false;
    },
    /**
     * Sends a request to delete the task.
     *
     * @param {Object} task - The task object to delete.
     */
    deleteTask(task) {
      this.$inertia
        .delete(`/tasks/${task.id}`)
        .then(() => {
          // Remove the task from the local taskList
          this.taskList = this.taskList.filter((t) => t.id !== task.id);
        })
        .catch((error) => {
          // Handle error
          console.error('Error deleting task:', error);
        });
    },
    /**
     * Sends a request to mark the task as done.
     *
     * @param {Object} task - The task object to update.
     */
    markTaskAsDone(task) {
      this.$inertia
        .put(`/tasks/${task.id}/mark-as-done`)
        .then(() => {
          // Update the task status locally
          const index = this.taskList.findIndex((t) => t.id === task.id);
          if (index !== -1) {
            this.taskList[index].status = 'DONE';
          }
        })
        .catch((error) => {
          // Handle error
          console.error('Error marking task as done:', error);
        });
    },
    /**
     * Sets the current filter status.
     *
     * @param {string} status - The filter status to set ('ALL', 'NEW', 'DONE').
     */
    setFilter(status) {
      this.filterStatus = status;
    },
  },
};
</script>
