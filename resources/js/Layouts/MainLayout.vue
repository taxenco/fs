<template>
    <div class="min-h-screen flex flex-col">
      <Header />
      <div class="flex-grow flex items-center justify-center w-3/4 mx-auto">
        <slot>Default</slot>
      </div>
      <Footer />
    </div>
  </template>
  
  <script>
  import Header from '@/components/Header.vue'
  import Footer from '@/components/Footer.vue'
  
  export default {
    components: {
      Header,
      Footer
    }
  }
  </script>
  
