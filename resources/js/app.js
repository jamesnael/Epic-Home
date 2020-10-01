require('./bootstrap');
require('./v-mixins');

import Vue from 'vue';

import Vuetify from 'vuetify';

window.Vue = require('vue');

Vue.use(Vuetify);

require('./../../Modules/Core/Resources/js/app');
require('./../../Modules/MasterData/Resources/js/app');

const vuetify = new Vuetify({
	icons: {
    	iconfont: 'mdi',
  	},
})

const app = new Vue({
    vuetify,
}).$mount('#page-content');