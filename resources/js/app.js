import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ZiggyVue } from 'ziggy';
import { InertiaProgress } from '@inertiajs/progress';
import '../css/app.scss';
import VueClickAway from 'vue3-click-away';
import mitt from 'mitt';
import '@fortawesome/fontawesome-free/css/all.css'; // Import FontAwesome icons

import axios from 'axios';

// Fetch the CSRF token from the HTML meta tag and set it as a common Axios header for security
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Import page components
import TaskIndex from './Pages/Tasks/TaskIndex.vue';
import TaskCreate from './Pages/Tasks/TaskCreate.vue';
import TaskEdit from './Pages/Tasks/TaskEdit.vue';

// Initialize Inertia.js progress bar with custom settings
InertiaProgress.init({
  delay: 0, // Delay before showing the progress bar
  color: '#29d', // Progress bar color
  includeCSS: true, // Automatically include CSS
  showSpinner: true, // Show a spinner with the progress bar
});

// Map route names to their corresponding components
const pageComponents = {
  'TaskIndex': TaskIndex,
  'TaskCreate': TaskCreate,
  'TaskEdit': TaskEdit,
};

// Function to map route names to component names for dynamic routing
function resolvePageName(routeName) {
  const nameMap = {
    'create-task-view': 'TaskCreate', // Route for task creation
    'edit-task-view': 'TaskEdit',     // Route for task editing
    '': 'TaskIndex',                  // Default or root route
  };
  return nameMap[routeName] || routeName; // Return mapped name or fallback to route name
}

// Initialize Inertia.js application
createInertiaApp({
  resolve: (name) => {
    // Use the resolvePageName function to get the component name dynamically
    const pageName = resolvePageName(name);
    const pageComponent = pageComponents[pageName];

    if (!pageComponent) {
      // Error handling if the page component is not found
      throw new Error(`Page component for "${name}" not found`);
    }

    // Set default layout if not provided by the page component
    pageComponent.layout = pageComponent.layout || MainLayout;
    return pageComponent;
  },
  // Setup the Vue.js application with Inertia.js
  setup({ el, App, props, plugin }) {
    const appInstance = createApp({ render: () => h(App, props) })
      .use(plugin)           // Inertia plugin
      .use(ZiggyVue)         // Ziggy plugin for routing
      .use(VueClickAway)     // Plugin to handle click outside events
      .component('Link', Link); // Register the Inertia Link component globally

    // Use mitt as an event bus for inter-component communication
    const emitter = mitt();
    appInstance.provide('emitter', emitter); // Provide the event bus to the application

    // Mount the Vue.js application to the DOM element
    appInstance.mount(el);
  },
});
