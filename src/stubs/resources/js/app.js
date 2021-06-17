import Vue from 'vue'
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress'
import { VueMaskDirective } from 'v-mask'
import PortalVue from 'portal-vue';
import VueMeta from 'vue-meta';
import vuetify from '@/plugins/vuetify'
import Layout from '@/layouts/Layout';


require('./bootstrap');
require('@/plugins/filters');

Vue.mixin({methods: {route}});

Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(VueMeta);
Vue.directive('mask', VueMaskDirective);


InertiaProgress.init()

const app = document.getElementById('app');

new Vue({
  vuetify,
  metaInfo: {
    titleTemplate: (title) => (title ? ` - PROJECT` : 'PROJECT')
  },
  render: (h) => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: (name) => import(`./pages/${name}`)
        .then(({default: page}) => {
          if (page.layout === undefined) {
            page.layout = Layout;
          }
          return page;
        })
    }
  })
}).$mount(app);
