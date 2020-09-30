require('./bootstrap');
require('./v-mixins');

import Vue from 'vue';

import Vuetify from 'vuetify';

window.Vue = require('vue');

Vue.use(Vuetify);

// ue.component('table-layout', () => import('./components/Table.vue'));

// require('./../../Modules/Core/Resources/js/app');

const vuetify = new Vuetify({
  icons: {
    iconfont: 'mdi',
  },
})

const app = new Vue({
    router,
    vuetify,
}).$mount('#page-content');