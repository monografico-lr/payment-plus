import Vue from 'vue';
import jquery from 'jquery';
import App from './App.vue';
import router from './router';
import store from './store';
import './bootstrap';
import './sass/app.scss';
import Login from './views/login/Login.vue';

window.jQuery = jquery;
window.$ = jquery;
Vue.config.productionTip = false;

const isLogin = window.location.href.includes('/login');
const component = isLogin ? Login : App;

new Vue({
  router,
  store,
  render: h => h(component),
}).$mount('#app');
