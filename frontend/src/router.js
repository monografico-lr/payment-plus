import Vue from 'vue';
import Router from 'vue-router';
import Home from './views/home/homeSection.vue';
import Services from './views/service/ServiceSection.vue';
import Routers from './views/router/RouterSection.vue';
import Clients from './views/clients/ClientSection.vue';

Vue.use(Router);

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/servicios',
      name: 'services',
      component: Services,
    },
    {
      path: '/secciones',
      name: 'routers',
      component: Routers,
    },
    {
      path: '/clientes',
      name: 'clients',
      component: Clients,
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () =>
        import(/* webpackChunkName: "about" */ './views/About.vue'),
    },
  ],
});
