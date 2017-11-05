import VueRouter from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'Courses',
    component: require('./views/CourseCatalog')
  }
];

export default new VueRouter({
  routes
});