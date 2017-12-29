<template lang="html">
  <v-dialog
    v-model='modal.show'
    max-width="600px"
    persistent
  >
    <v-card v-if="modal.delete == true">
      <!-- Heading -->
      <v-layout class="pa-1 pl-3 align-center">
        <h3 class="subheading grey--text">{{ modal.text }} usuario {{ '@'+form.username }}</h3>
        <v-spacer></v-spacer>
        <v-btn color='grey' flat icon @click.prevent='modal.show = !modal.show'>
          <v-icon>close</v-icon>
        </v-btn>
      </v-layout>
      <v-divider></v-divider>
      <v-card-text>
        <span class="subheading error--text">AVISO IMPORTANTE:</span> Al eliminar una cuenta de usuario es probable que se pierda información importante relacionada a la misma.
      </v-card-text>
      <v-divider></v-divider>
      <v-layout class="pa-1 pr-3 pl-3">
        <v-spacer></v-spacer>
        <v-btn class="red--text text--lighten-3" flat @click="form.reset(), modal.show = false">
          <v-icon class="subheading red--text text--lighten-3 mr-2">fa-close</v-icon>
          Cancelar
        </v-btn>
        <v-btn class="green--text text--lighten-3" flat @click.prevent="submit">
          <v-icon class="subheading green--text text--lighten-3 mr-2">fa-trash-o</v-icon>
          Estoy seguro, eliminar.
        </v-btn>
      </v-layout>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ['form', 'modal'],
  methods: {
    submit() {
      this.form.submit('delete', '/usuarios/'+this.form.id)
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
