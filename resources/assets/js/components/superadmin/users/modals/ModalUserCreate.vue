<template lang="html">
  <v-card>
    <!-- Heading -->
    <v-layout class="pa-1 pl-3 align-center">
      <h3 class="subheading grey--text">Crear usuario</h3>
      <v-spacer></v-spacer>
      <v-btn color='grey' flat icon @click="close">
        <v-icon>close</v-icon>
      </v-btn>
    </v-layout>
    <v-divider></v-divider>
    <form class="pa-3" @submit.prevent>
      <v-container grid-list-md>
        <v-layout row wrap>

          <v-flex xs12 sm6>
            <v-text-field
              label="Nombre"
              prepend-icon="fa-user-o"
              v-model="form.name"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
              label="Apellidos"
              prepend-icon="fa-user-o"
              v-model="form.lastname"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
              label="Nombre de usuario"
              prepend-icon="face"
              v-model="form.username"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
              label="Contraseña"
              prepend-icon="vpn_key"
              v-model="form.password"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-text-field
              label="Email"
              prepend-icon="fa-envelope-o"
              v-model="form.email"
            ></v-text-field>
          </v-flex>

          <v-flex xs12 sm6>
            <v-select
              label="Cuenta"
              :items="accounts"
              item-value="id"
              item-text="name"
              prepend-icon="domain"
              v-model="form.account_id"
              autocomplete
            ></v-select>
          </v-flex>

          <v-flex xs12 sm6>
            <v-select
              label="Rol"
              :items="roles"
              item-value="id"
              item-text="name"
              prepend-icon="grade"
              v-model="form.role_id"
              autocomplete
            ></v-select>
          </v-flex>

        </v-layout>
      </v-container>
    </form>
    <v-divider></v-divider>
    <v-layout class="pa-1 pr-3 pl-3">
      <v-btn color='grey' flat icon>
        <v-icon>refresh</v-icon>
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn class="red--text text--lighten-3" flat @click="close">
        <v-icon class="subheading red--text text--lighten-3 mr-2">fa-close</v-icon>
        Cancelar
      </v-btn>
      <v-btn class="green--text text--lighten-3" flat @click="submit">
        <v-icon class="subheading green--text text--lighten-3 mr-2">fa-save</v-icon>
        Guardar
      </v-btn>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  props: ['modal', 'form'],
  data() {
    return {
      accounts: [],
      roles: [
        { id: 1, name: 'Usuario' },
        { id: 2, name: 'Seguridad' },
        { id: 3, name: 'Asistente de Admin.' },
        { id: 4, name: 'Administrador' },
        { id: 5, name: 'Superadmin' }
      ]
    }
  },
  methods: {
    close() {
      this.modal.close()
    },
    loadAccounts() {
      axios.get('/cuentas')
        .then(res => {
          this.accounts = res.data
        })
    },
    submit() {
      this.form.submit('post', '/usuarios')
        .then(res => {
          this.modal.show = false
        })
    }
  },
  beforeMount() {
    this.loadAccounts()
  }
}
</script>

<style lang="css">
</style>
