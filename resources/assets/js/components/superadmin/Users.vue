<template lang="html">
  <div>
    <!-- Title -->
    <v-layout class="grey--text mt-2 mb-2">
      <h1>Usuarios <span class="hidden-sm-and-down">registrados</span></h1>
      <v-spacer></v-spacer>
      <v-btn class="ma-0" color="blue-grey" @click="modal.open('create', 'Crear')">
        nueva
      </v-btn>
    </v-layout>

    <v-divider class="mt-3 mb-3"></v-divider>

    <!-- Subtoolbar -->
    <v-layout>
      <v-btn-toggle class="elevation-0 transparent" v-model="toggleViewOptions" flat>
        <v-btn flat small>
          <v-icon class="subheading">fa-th-large</v-icon>
        </v-btn>
        <v-btn flat small>
          <v-icon class="subheading">fa-th-list</v-icon>
        </v-btn>
      </v-btn-toggle>
      <v-spacer></v-spacer>
      <v-text-field
        append-icon="search"
        class="ma-0 pa-0"
        color='cyan'
        name="searchbox"
        placeholder="Buscar..."
        v-model="search"
      ></v-text-field>
      </v-btn>
    </v-layout>

    <!-- Loading Screen -->
    <loading-screen v-if="isLoading"></loading-screen>

    <!-- Users Card View -->
    <!-- <section v-if="toggleViewOptions == 0 && isLoading == false">
      <v-container class="mt-3 grid-list-sm" fluid>
        <v-layout row wrap>
          <user-card v-for="user in filteredItems" :user="user" :key="user.id" :modal="modal" :form="form"></user-card>
        </v-layout>
      </v-container>
    </section> -->

    <section v-if="toggleViewOptions == 0 && isLoading == false">
      <v-container class="mt-3 grid-list-sm" fluid>
        <paginate class="layout row wrap" name="users" :list="filteredItems" :per="15">
          <user-card v-for="user in paginated('users')" :user="user" :key="user.id" :modal="modal" :form="form"></user-card>
        </paginate>
      </v-container>
      <!-- Pagination -->
      <div class="text-xs-center mt-5 mb-3">
        <paginate-links
        for="users"
        :limit="5"
        show-step-links
        async
        :classes="{
          'ul': 'pagination',
          'a': 'pagination__item',
          '.left-arrow > a': ['material-icons','md-36'],
          '.right-arrow > a': ['material-icons','md-36'],
        }"
        :step-links="{
          next: 'chevron_right',
          prev: 'chevron_left'
        }"
        ></paginate-links>
      </div>
    </section>


    <!-- Users Table View -->
    <section v-if="toggleViewOptions == 1 && isLoading == false">
      <v-container class="mt-3 grid-list-sm" fluid>
        <v-layout row wrap>
          <users-table :table="table" :search="search"></users-table>
        </v-layout>
      </v-container>
    </section>

    <!-- No Search Result -->
    <no-result v-if="filteredItems.length <= 0 && !isLoading"></no-result>

    <!-- No Data Result -->
    <no-data v-if="isLoading == false && table.items.length <= 0"></no-data>

    <!-- MODALS -->
    <modal-user-create v-if="modal.create" :modal="modal" :form="form"></modal-user-create>
    <modal-user-change-password v-if="modal.changePassword" :modal="modal" :form="form"></modal-user-change-password>
    <modal-user-delete v-if="modal.delete" :modal="modal" :form="form"></modal-user-delete>
    <modal-user-edit v-if="modal.edit" :modal="modal" :form="form"></modal-user-edit>

    <!-- SNACKBAR -->
    <form-snackbar :form="form"></form-snackbar>

  </div>

</template>

<script>

import { Modal, Table,} from '../../classes.js'
import { Form } from '../../form-handler.js'

export default {
  data() {
    return {
      page: 2,
      form: new Form({
        id: '',
        avatar: '',
        avatar_bg_color: '',
        name: '',
        lastname: '',
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
        account_id: '',
        role_id: ''
      }),
      isLoading: true,
      modal: new Modal([
        'create',
        'changePassword',
        'edit',
        'delete',
        'view'
      ]),
      search: '',
      table: new Table([
          { text: 'Id', align: 'left', value: 'id' },
          { text: 'Usuario', align: 'left', value: 'username' },
          { text: 'Nombre', align: 'left', value: 'name' },
          { text: 'Apellidos', align: 'left', value: 'lastname' },
          { text: 'Email', align: 'left', value: 'email' },
          { text: 'Cuenta', align: 'left', value: 'account' },
          { text: 'Acciones', align: 'right', value: 'actions', sortable: false }
      ]),
      toggleViewOptions: 0,
      paginate: ['users']
    }
  },
  computed: {
    filteredItems() {
      if (this.search && this.toggleViewOptions == 0) {
        let items = this.table.items
        let result = [];

        for (var i = 0; i < items.length; i++) {
          let verified = false
          Object.keys(items[i]).some(prop => {
            let item = items[i][prop]
            if (item) {
              let content = item.toString().toLowerCase()
              if (content.includes(this.search.toLowerCase())) {
                verified = true
              }
            }
          })
          if (verified == true) {
            result.push(items[i])
          }
        }

        return result
      }

      return this.table.items
    }
  },
  methods: {
    loadUsers() {
      this.table.loadData('/usuarios')
        .then(res => {
          this.isLoading = false
        })
    }
  },
  beforeMount() {
    this.loadUsers()
  }
}
</script>

<style lang="scss">
.pagination {
  .active a{
    background-color: rgb(25, 118, 210);
  }
}
</style>
