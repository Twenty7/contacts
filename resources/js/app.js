
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import $ from 'jquery';
import dt from 'datatables.net-bs4';

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });


$(document).ready(function() {
  $('#contacts-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: '/api/contacts'
    },
    columns: [
      {data: 'id', name: 'id'},
      {data: 'first_name', name: 'first_name'},
      {data: 'last_name', name: 'last_name'},
      {data: 'email', name: 'email'},
      {data: 'phone', name: 'phone'},
      {data: 'address', name: 'address'},
      {data: 'city', name: 'city'},
      {data: 'state', name: 'state'},
      {data: 'zip', name: 'zip'}
    ]
  });
});
