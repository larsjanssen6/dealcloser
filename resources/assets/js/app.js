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

Vue.component('Users',                          require('./pages/Users.vue'));
Vue.component('User',                           require('./components/user/User.vue'));
Vue.component('UpdateUser',                     require('./components/user/UpdateUser.vue'));

Vue.component('Roles',                          require('./components/settings/Roles.vue'));
Vue.component('Departments',                    require('./components/settings/Departments.vue'));
Vue.component('CountryState',                   require('./components/shared/CountryState.vue'));
Vue.component('Modal',                          require('./components/shared/Modal.vue'));
Vue.component('ModalCard',                      require('./components/shared/ModalCard.vue'));
Vue.component('DatePicker',                     require('./components/shared/DatePicker.vue'));
Vue.component('ForgotPassword',                 require('./components/authentication/ForgotPassword.vue'));

Vue.directive('focus', {
    inserted: function (el) {
        el.focus()
    }
});

const app = new Vue({
    el: '#app',
    data() {
        return {
            showModal: false
        }
    }
});

$("form").submit(() => {
    $("#submit").addClass("is-loading");
    return true;
});

setTimeout(() => {
    $('#is-popUp').fadeOut('fast');
}, 3500);