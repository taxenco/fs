import { createApp, h } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { ZiggyVue } from 'ziggy';
import { InertiaProgress } from '@inertiajs/progress';
import '../css/app.scss';
import VueClickAway from 'vue3-click-away';
import mitt from 'mitt';
import '@fortawesome/fontawesome-free/css/all.css';

InertiaProgress.init({
  delay: 0,
  color: '#29d',
  includeCSS: true,
  showSpinner: true,
});

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
  resolve: async (name) => {
    // Use the resolvePageName function to get the correct component name
    const pageName = resolvePageName(name);
    const pages = import.meta.glob('./Pages/Tasks/**/*.vue');
    const page = await pages[`./Pages/Tasks/${pageName}.vue`]();
    if (!page) {
      throw new Error(`Page component for "${name}" not found`);
    }
    page.default.layout = page.default.layout || MainLayout;
    return page;
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
