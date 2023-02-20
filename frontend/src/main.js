import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import router from './router'
import store from './store'

const $ = require('jquery');

global.$ = global.jQuery = $;
window.$ = window.jQuery = $;

import '@/assets/plugins/bootstrap/js/bootstrap.bundle.min'
import '@/assets/plugins/sweetalert2/sweetalert2.min'
import '@/assets/plugins/toastr/toastr.min'
import '@/assets/js/adminlte'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
