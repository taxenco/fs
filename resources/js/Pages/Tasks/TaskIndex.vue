<template>
  <div class="flex flex-col md:flex-row p-4">
    <div class="w-full">
      <h1 class="text-2xl font-bold mb-4">List of Tasks</h1>
      <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
          <tr class="bg-gray-100 border-b">
            <th class="px-4 py-2 text-left text-gray-600">Title</th>
            <th class="px-4 py-2 text-left text-gray-600">Description</th>
            <th class="px-4 py-2 text-left text-gray-600">Status</th>
          </tr>
        </thead>
        <tbody>
          <!-- Example Task Row -->
          <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">Task 1</td>
            <td class="px-4 py-2">Description for Task 1</td>
            <td class="px-4 py-2">
              <span class="inline-flex items-center px-2 py-1 text-xs font-medium leading-4 rounded-full bg-green-100 text-green-800">
                COMPLETED
              </span>
            </td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</template>


