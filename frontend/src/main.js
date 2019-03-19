import './bootstrap';
import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import Login from './views/login/Login.vue';
import './sass/app.scss';
import './plugins/element.js'

Vue.config.productionTip = false;

const isLogin = window.location.href.includes('/login');
const component = isLogin ? Login : App;

new Vue({
  router,
  store,
  render: h => h(component),
}).$mount('#app');
