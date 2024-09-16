<template>
    <div
      v-if="visible"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50"
    >
      <div class="bg-white rounded-lg shadow-md max-w-sm w-full">
        <div class="px-6 py-5">
          <h2 class="text-2xl font-bold text-gray-800">{{ title }}</h2>
          <p class="text-gray-700 mt-3">{{ message }}</p>
        </div>
        <div class="px-6 py-4 flex justify-end border-t border-gray-200">
          <button
            @click="cancel"
            class="px-5 py-2.5 mr-2 text-gray-800 bg-gray-200 hover:bg-gray-300 rounded-lg transition"
          >
            Cancel
          </button>
          <button
            @click="confirm"
            :class="[
              'px-5 py-2.5 rounded-lg text-white transition',
              actionType === 'delete' ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600'
            ]"
          >
            Confirm
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ConfirmationModal',
  
    props: {
      visible: {
        type: Boolean,
        default: false,
      },
      title: {
        type: String,
        default: 'Confirm Action',
      },
      message: {
        type: String,
        default: 'Are you sure you want to proceed?',
      },
      actionType: {
        type: String,
        default: 'confirm', // 'confirm' or 'delete'
      },
    },
  
    methods: {
      confirm() {
        this.$emit('confirm');
      },
  
      cancel() {
        this.$emit('cancel');
      },
    },
  };
  </script>
  