/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('toast-component', require('./components/ToastComponent.vue').default);
Vue.component('cart-component', require('./components/CartComponent').default);
Vue.component('notification-component', require('./components/NotificationComponent').default);
Vue.component('check-out-component', require('./components/CheckOutComponent').default);
Vue.component('order-numbers-component', require('./components/OrdersNumbersComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('products-component', require('./components/ProductsComponent.vue').default);
Vue.component('fav-products-component', require('./components/FavouriteProductsComponent.vue').default);
Vue.component('one-products-component', require('./components/OneProductComponent').default);
Vue.component('product-discount', require('./components/ProductDiscountComponent.vue').default);
Vue.component('product-specs', require('./components/ProductSpecsComponent.vue').default);
Vue.component('new-product-specs', require('./components/NewProductSpecsComponent.vue').default);
Vue.component('specs-values', require('./components/SpecsValuesComponent.vue').default);
Vue.component('new-payment-method', require('./components/NewPaymentMethodComponent.vue').default);
Vue.component('default-payment-method', require('./components/defaultPaymentMethodComponent.vue').default);
Vue.component('search-component', require('./components/SearchComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import VueObserveVisibility from 'vue-observe-visibility'
import Vuex from 'vuex'
import storeData from "./store/index"

Vue.use(VueObserveVisibility)
Vue.use(Vuex)



const store = new Vuex.Store(
    storeData
)

const app = new Vue({
    el: '#app',
    store,
});

const footer = new Vue({
    el: '#footer',
    store,
});

const header = new Vue({
    el: '#header',
    store,
});

const navigation = new Vue({
    el: '#navigation',
    store,
});
