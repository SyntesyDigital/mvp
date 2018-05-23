
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

// Material kit (https://www.creative-tim.com/product/material-kit)
require('./material-kit/jquery.min');
require('./material-kit/bootstrap.min');
require('./material-kit/material.min');
require('./material-kit/nouislider.min');
require('./material-kit/bootstrap-datepicker');
require('./material-kit/material-kit');

require('./libs/tweenMax/tweenmax.js');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//var _ = require('lodash');

require('./components/Example');

require('./components/Typology/TypologyForm');
