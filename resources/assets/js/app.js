
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// SUPERADMIN PAGES COMPONENTS
Vue.component('superadmin-users', require('./components/superadmin/Users.vue'));
Vue.component('superadmin-accounts', require('./components/superadmin/Accounts.vue'));

// SUPERADMIN COMPONENTS
//accounts
Vue.component('account-card', require('./components/superadmin/accounts/AccountCard.vue'));


const Vuetify = require('vuetify')
Vue.use(Vuetify, {
  primary: 'cyan'
})

const app = new Vue({
    el: '#app',

    data: {
      drawer: false,
      mini: false
    }
});
