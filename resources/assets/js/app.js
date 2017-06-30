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

Vue.component('users',                          require('./pages/Users.vue'));
Vue.component('roles',                          require('./components/settings/Roles.vue'));
Vue.component('modal',                          require('./components/shared/Modal.vue'));
Vue.component('modalCard',                      require('./components/shared/modalCard.vue'));
Vue.component('datePicker',                     require('./components/shared/DatePicker.vue'));
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