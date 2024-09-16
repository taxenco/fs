<template>
    <!-- Fullscreen grey overlay -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 flex items-center justify-center">
      <!-- Centered loader content -->
      <div class="flex flex-col items-center">
        <!-- Loader Spinner -->
        <div class="loader bg-transparent border-4 border-t-4 border-gray-200 rounded-full w-16 h-16 mb-4"></div>
        <!-- Loader Text -->
        <p class="text-gray-100 text-lg font-semibold">Loading tasks, please wait...</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Loader',
  };
  </script>
  
  <style scoped>
  .loader {
    border-top-color: #3490dc;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
  </style>
  