// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import VueTouch from 'vue-touch';
import store from './store';
import router from './Routes';
import App from './App';
import Widget from './components/Widget/Widget';
import axios from 'axios';
import { moneyfiltro } from '@/filters'
import { VueSpinners } from '@saeris/vue-spinners'
const $ = require('jquery')
// Lo declaramos globalmente
window.$ = $

Vue.use(BootstrapVue);
Vue.use(VueSpinners)
Vue.use(VueTouch);
Vue.use(BootstrapVueIcons)
Vue.component('Widget', Widget);
Vue.use(require('vue-moment'));
Vue.filter('moneyfiltro', moneyfiltro)



Vue.config.productionTip = false;


axios.defaults.baseURL='https://localhost:44323/'
/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App),
});
