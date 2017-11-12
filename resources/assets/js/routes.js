import VueRouter from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'CourseCatalog',
    component: require('./views/CourseCatalog')
  },
  {
    path: '/course/:courseId',
    name: 'CoursePage',
    component: require('./views/CoursePage')
  },
  {
    path: '/course/:courseId/lesson/:lessonId',
    name: 'LessonPage',
    component: require('./views/LessonPage')
  }
];

export default new VueRouter({
  routes
});