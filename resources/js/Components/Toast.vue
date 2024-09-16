<template>
    <transition name="fade">
      <div
        v-if="visible"
        class="toast fixed top-4 right-4 z-50 max-w-sm w-full bg-white border border-gray-200 shadow-lg rounded-lg p-4 flex items-start space-x-4"
      >
        <div class="icon flex-shrink-0">
          <!-- Success Icon -->
          <svg
            v-if="type === 'success'"
            class="h-6 w-6 text-green-500"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          <!-- Error Icon -->
          <svg
            v-else-if="type === 'error'"
            class="h-6 w-6 text-red-500"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
          <!-- Info Icon -->
          <svg
            v-else-if="type === 'info'"
            class="h-6 w-6 text-blue-500"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 8v.01"></path>
          </svg>
        </div>
        <div class="message flex-1">
          <h3 class="font-semibold text-gray-900">{{ title }}</h3>
          <p class="text-gray-600 text-sm">{{ message }}</p>
        </div>
        <button @click="closeToast" class="text-gray-500 hover:text-gray-700">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="h-5 w-5"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </transition>
  </template>
  
  <script>
  export default {
    props: {
      title: {
        type: String,
        default: "Notification",
      },
      message: {
        type: String,
        default: "",
      },
      type: {
        type: String,
        default: "info", // Can be 'info', 'success', or 'error'
      },
      duration: {
        type: Number,
        default: 3000, // Default duration for the toast to disappear
      },
    },
    data() {
      return {
        visible: true,
      };
    },
    mounted() {
      setTimeout(this.closeToast, this.duration);
    },
    methods: {
      closeToast() {
        this.visible = false;
      },
    },
  };
  </script>
  
  <style scoped>
  .toast {
    animation: fadeInUp 0.3s ease-in-out;
  }
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(10px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }
  </style>
  