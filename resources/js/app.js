import Vue from 'vue';

import Vuetify from 'vuetify';

import wysiwyg from "vue-wysiwyg";

import "vue-wysiwyg/dist/vueWysiwyg.css";

window.Vue = require('vue');

Vue.use(wysiwyg, {}); // config is optional. more below
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