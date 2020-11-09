// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import { BootstrapVue, BootstrapVueIcons,VBHoverPlugin  } from 'bootstrap-vue'
import VueTouch from 'vue-touch';
import store from './store';
import router from './Routes';
import App from './App';
import Widget from './components/Widget/Widget';
import axios from 'axios';
import { moneyfiltro } from '@/filters'
import { VueSpinners } from '@saeris/vue-spinners'
const $ = require('jquery')
import VueSweetalert2 from 'vue-sweetalert2'; 
import 'sweetalert2/dist/sweetalert2.min.css';


// Lo declaramos globalmente

//import VueGoodWizard from '../src'
//import VueGoodWizard from './components/Wizard.vue';
import VueGoodWizard from 'vue-good-wizard';
Vue.use(VueGoodWizard);


window.$ = $
Vue.use(VueSweetalert2);
Vue.use(VBHoverPlugin)
Vue.use(BootstrapVue);
Vue.use(VueSpinners)
Vue.use(VueTouch);
Vue.use(BootstrapVueIcons)
Vue.component('Widget', Widget);
Vue.use(require('vue-moment'));
Vue.filter('moneyfiltro', moneyfiltro)



Vue.config.productionTip = false;
//https://edsyscomp.com/

//axios.defaults.baseURL='https://localhost:44323/'
axios.defaults.baseURL='http://localhost/'
//axios.defaults.baseURL='https://edsyscomp.com/'
/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App),
});
