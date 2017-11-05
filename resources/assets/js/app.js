require('./bootstrap');

import router from './routes';
import PageTitle from './components/PageTitle';

Vue.component('page-title', PageTitle);

const app = new Vue({
  el: '#app',
  data: {
    courses: []
  },
  router
});