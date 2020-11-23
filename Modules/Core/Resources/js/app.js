require('./bootstrap');
require('./v-mixins');

Vue.component('address-input', () => import('./components/Address/Input.vue'));
Vue.component('base-layout', () => import('./components/BaseLayout.vue'));
Vue.component('table-component', () => import('./components/TableComponent.vue'));
Vue.component('maps-component', require('./components/Maps/Form.vue').default);
