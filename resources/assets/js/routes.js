import VueRouter from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'CourseCatalog',
    component: require('./views/CourseCatalog')
  },
  {
    path: '/courses/:id',
    name: 'CoursePage',
    component: require('./views/CoursePage')
  }
];

export default new VueRouter({
  routes
});