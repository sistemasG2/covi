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

    <section v-if="toggleViewOptions == 0">
      <v-container class="mt-3 grid-list-sm" fluid>
        <v-layout row wrap>
          <user-card></user-card>
        </v-layout>
      </v-container>
    </section>

    <!-- MODAL -->
    <v-dialog
      v-model='modal.show'
      max-width="600px"
      persistent
    >
      <modal-user-create :modal="modal" :form="form"></modal-user-create>
      <!-- <modal-user-edit></modal-user-edit>
      <modal-user-delete></modal-user-delete> -->
    </v-dialog>

    <!-- SNACKBAR -->
    <form-snackbar :form="form"></form-snackbar>

  </div>

</template>

<script>

import {CrudModal, Table} from '../../classes.js'
import {Form} from '../../form-handler.js'

export default {
  data() {
    return {
      form: new Form({
        avatar: '',
        name: '',
        lastname: '',
        username: '',
        email: '',
        password: '',
        account_id: '',
        role_id: ''
      }),
      modal: new CrudModal(),
      search: '',
      toggleViewOptions: 0,
      users: []
    }
  },
  methods: {
    loadUsers() {
      axios.get('/usuarios')
        .then(res => {
          this.users = res.data
        })
    }
  },
  beforeMount() {
    this.loadUsers()
  }
}
</script>

<style lang="css">
</style>
