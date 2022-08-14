import Vue from 'vue'
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress'
import { VueMaskDirective } from 'v-mask'
import PortalVue from 'portal-vue';
import VueMeta from 'vue-meta';
import vuetify from '@/plugins/vuetify'
import Layout from '@/layouts/Layout';

import VJsf from '@koumoul/vjsf';
import '@koumoul/vjsf/dist/main.css';
// load third-party dependencies (markdown-it, vuedraggable)
// you can also load them separately based on your needs
//import '@koumoul/vjsf/dist/third-party.js'
import Draggable from 'vuedraggable'
const _global = (typeof window !== 'undefined' && window) || (typeof global !== 'undefined' && global) || {}
_global.markdownit = require('markdown-it')

require('./bootstrap');
require('@/plugins/filters');

Vue.mixin({methods: {route}});
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(VueMeta);
Vue.directive('mask', VueMaskDirective);
Vue.component('VJsf', VJsf);
Vue.component('draggable', Draggable)


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
