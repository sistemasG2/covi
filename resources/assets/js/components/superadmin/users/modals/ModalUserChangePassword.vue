<template lang="html">
  <v-dialog
    v-model='modal.show'
    max-width="400px"
    persistent
  >
    <v-card>
      <!-- Heading -->
      <v-layout class="pa-1 pl-3 align-center">
        <h3 class="subheading grey--text">Cambiar Contraseña de {{ '@'+form.username }}</h3>
        <v-spacer></v-spacer>
        <v-btn color='grey' flat icon @click="close">
          <v-icon>close</v-icon>
        </v-btn>
      </v-layout>
      <v-divider></v-divider>
      <form class="pa-3" @keydown="form.errors.clear($event.target.name)">
        <v-container grid-list-md>
          <v-layout row wrap>

            <v-flex xs12>
              <v-text-field
                name="password"
                label="Contraseña"
                prepend-icon="vpn_key"
                v-model="form.password"
                :error-messages="form.errors.get('password')"
                type="password"
              ></v-text-field>
            </v-flex>

            <v-flex xs12>
              <v-text-field
                name="password_confirmation"
                label="Confirmar Contraseña"
                prepend-icon="vpn_key"
                v-model="form.password_confirmation"
                :error-messages="form.errors.get('password')"
                type="password"
              ></v-text-field>
            </v-flex>

          </v-layout>
        </v-container>
      </form>
      <v-divider></v-divider>
      <v-layout class="pa-1 pr-3 pl-3">
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
  </v-dialog>
</template>

<script>
export default {
  props: ['modal', 'form'],
  methods: {
    close() {
      this.modal.close()
    },
    submit() {
      this.form.submit('put', '/usuarios/cambiar-contrasena/'+this.form.id)
        .then(res => {
          this.modal.show = false
          this.$parent.loadUsers()
        })
    }
  }
}
</script>

<style lang="css">
</style>
