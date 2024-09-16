import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ZiggyVue } from 'ziggy';
import { InertiaProgress } from '@inertiajs/progress';
import '../css/app.scss';
import VueClickAway from 'vue3-click-away';
import mitt from 'mitt';
import '@fortawesome/fontawesome-free/css/all.css';

import axios from 'axios';

// Fetch the CSRF token from the HTML meta tag and set it as a common Axios header
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


// Import page components at the top
import TaskIndex from './Pages/Tasks/TaskIndex.vue';
import TaskCreate from './Pages/Tasks/TaskCreate.vue';
import TaskEdit from './Pages/Tasks/TaskEdit.vue';

InertiaProgress.init({
  delay: 0,
  color: '#29d',
  includeCSS: true,
  showSpinner: true,
});

// Map route names to components
const pageComponents = {
  'TaskIndex': TaskIndex,
  'TaskCreate': TaskCreate,
  'TaskEdit': TaskEdit,
};

// Function to map route names to component names
function resolvePageName(routeName) {
  const nameMap = {
    'create-task': 'TaskCreate',
    'edit-task': 'TaskEdit',
    '': 'TaskIndex', // Default or root route
  };
  return nameMap[routeName] || routeName;
}

createInertiaApp({
  resolve: (name) => {
    // Use the resolvePageName function to get the component name
    const pageName = resolvePageName(name);
    const pageComponent = pageComponents[pageName];

    if (!pageComponent) {
      throw new Error(`Page component for "${name}" not found`);
    }

    pageComponent.layout = pageComponent.layout || MainLayout;
    return pageComponent;
  },
  setup({ el, App, props, plugin }) {
    const appInstance = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(VueClickAway)
      .component('Link', Link);

    const emitter = mitt();
    appInstance.provide('emitter', emitter);
    appInstance.mount(el);
  },
});
