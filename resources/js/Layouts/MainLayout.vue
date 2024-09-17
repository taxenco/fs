<template>
  <div class="min-h-screen flex flex-col">
    <!-- Header component at the top of the page -->
    <Header />
    
    <!-- Main content area, centers any slotted content horizontally and vertically -->
    <div class="flex-grow flex items-center justify-center w-3/4 mx-auto">
      <!-- Slot for dynamic content. Displays "No content" if no content is provided -->
      <slot>No content</slot>
    </div>
    
    <!-- Footer component at the bottom of the page -->
    <Footer />
  </div>
</template>

<script>
  // Importing Header and Footer components
  import Header from '@/components/Header.vue'
  import Footer from '@/components/Footer.vue'

  export default {
    // Registering Header and Footer as child components
    components: {
      Header,
      Footer
    }
  }
</script>
