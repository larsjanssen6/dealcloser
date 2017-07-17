import TurbolinksAdapter from 'vue-turbolinks'
import "babel-polyfill";
import swal from 'sweetalert2'

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.swal = swal;

window.Vue = require('vue');

/**
 * Create a vue instance where we'll listen for events.
 */

window.Event = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Components
 */

Vue.component('Product',                        require('./components/product/Product.vue'));
Vue.component('UpdateProduct',                  require('./components/product/UpdateProduct.vue'));

Vue.component('User',                           require('./components/user/User.vue'));
Vue.component('UpdateUser',                     require('./components/user/UpdateUser.vue'));

Vue.component('Relation',                       require('./components/relation/Relation.vue'));
Vue.component('UpdateRelation',                 require('./components/relation/UpdateRelation.vue'));

Vue.component('Roles',                          require('./components/settings/Roles.vue'));
Vue.component('Departments',                    require('./components/settings/Departments.vue'));
Vue.component('ForgotPassword',                 require('./components/authentication/ForgotPassword.vue'));

/**
 * pages
 */

Vue.component('Users',                          require('./pages/Users.vue'));
Vue.component('Products',                       require('./pages/Products.vue'));
Vue.component('Relations',                      require('./pages/Relations.vue'));

/**
 * bars
 */

Vue.component('BarChart',                       require('./charts/BarChart.vue'));
Vue.component('PieChart',                       require('./charts/PieChart.vue'));

/**
 * Shared
 */

Vue.component('CountryState',                   require('./components/shared/CountryState.vue'));
// Vue.component('DatePicker',                     require('./components/shared/DatePicker.vue'));
Vue.component('Modal',                          require('./components/shared/Modal.vue'));
Vue.component('ModalCard',                      require('./components/shared/ModalCard.vue'));
Vue.component('Destroy',                        require('./components/shared/Destroy.vue'));

/**
 * Directives
 */

Vue.directive('focus', {
    inserted: function (el) {
        el.focus()
    }
});

/**
 * Filters
 */

Vue.filter('currency', function (value) {
    return '€ ' + parseFloat(value).toFixed(2);
});



document.addEventListener('turbolinks:load', () => {
    let app = new Vue({
        el: '#app',
        mixins: [TurbolinksAdapter],
        data() {
            return {
                showModal: false
            }
        }
    });
});

$("form").submit(() => {
    $("#submit").addClass("is-loading");
    return true;
});

setTimeout(() => {
    $('#is-popUp').fadeOut('fast');
}, 3500);