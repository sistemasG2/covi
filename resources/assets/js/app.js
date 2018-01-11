
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./main');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// GENERAL COMPONENTS
Vue.component('avatar', require('./components/general/Avatar.vue'));
Vue.component('loading-screen', require('./components/general/LoadingScreen.vue'));
Vue.component('image-uploader', require('./components/general/ImageUploader.vue'));
Vue.component('form-snackbar', require('./components/general/FormSnackbar.vue'));
Vue.component('table-view', require('./components/general/TableView.vue'));
Vue.component('no-data', require('./components/general/NoData.vue'));
Vue.component('no-result', require('./components/general/NoResult.vue'));

// SUPERADMIN PAGES COMPONENTS
Vue.component('superadmin-users', require('./components/superadmin/Users.vue'));
Vue.component('superadmin-accounts', require('./components/superadmin/Accounts.vue'));

// SUPERADMIN COMPONENTS
// users
Vue.component('user-card', require('./components/superadmin/users/UserCard.vue'));
Vue.component('users-table', require('./components/superadmin/users/UsersTable.vue'));
Vue.component('avatar-form-uploader', require('./components/superadmin/users/AvatarFormUploader.vue'));
Vue.component('modal-user-view', require('./components/superadmin/users/modals/ModalUserView.vue'));
Vue.component('modal-user-create', require('./components/superadmin/users/modals/ModalUserCreate.vue'));
Vue.component('modal-user-delete', require('./components/superadmin/users/modals/ModalUserDelete.vue'));
Vue.component('modal-user-edit', require('./components/superadmin/users/modals/ModalUserEdit.vue'));
Vue.component('modal-user-change-password', require('./components/superadmin/users/modals/ModalUserChangePassword.vue'));

// accounts
Vue.component('account-card', require('./components/superadmin/accounts/AccountCard.vue'));
Vue.component('account-view', require('./components/superadmin/accounts/ViewAccount.vue'));
Vue.component('upload-image', require('./components/superadmin/accounts/UploadImage.vue'));



// const Vuetify = require('vuetify')
// Vue.use(Vuetify, {
//   primary: 'cyan'
// })

import Vuetify from 'vuetify'
Vue.use(Vuetify)

import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate)

const app = new Vue({
    el: '#app',

    data: {
      drawer: false,
      mini: false
    },

    methods: {
      logout() {
        document.getElementById('logout-form').submit();
      },
      showMenu() {
        if (window.innerWidth > 600) {
          this.drawer = true
          this.mini = true
        }
      }
    },

    beforeMount() {
      this.showMenu()
    }
});
