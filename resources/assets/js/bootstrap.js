import Vue from 'vue';
import VueRouter from 'vue-router';
import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.css';
import VueYouTubeEmbed from 'vue-youtube-embed';
import VueScrollTo from 'vue-scrollto';
import VueMoment from 'vue-moment';
import moment from 'moment-timezone';

import axios from 'axios';

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(VueMaterial);
Vue.use(VueYouTubeEmbed);
Vue.use(VueScrollTo);
Vue.use(VueMoment, {
  moment
});

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};