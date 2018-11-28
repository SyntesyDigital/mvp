
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

// Material kit (https://www.creative-tim.com/product/material-kit)
require('./material-kit/jquery.min');
require('./material-kit/bootstrap.min');
require('./material-kit/material.min');
require('./material-kit/nouislider.min');
require('./material-kit/bootstrap-datepicker');
require('./material-kit/material-kit');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));


const app = new Vue({
    el: '#app'
});
