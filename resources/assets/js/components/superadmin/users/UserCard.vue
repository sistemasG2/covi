<template lang="html">
  <v-flex v-resize="onResize" xs12 sm6 md4>
    <v-card :class="cardClass" class="user-card pa-3 pr-5">

      <v-menu  transition="slide-x-transition" class="card-menu" bottom left>
        <v-btn icon slot="activator" dark>
          <v-icon class="grey--text">more_vert</v-icon>
        </v-btn>
        <v-list class="pa-0">
          <v-list-tile>
            <v-list-tile-title class="cyan--text text--lighten-2  body-1">
              <v-icon class="cyan--text text--lighten-2 body-1 mr-1">fa-eye</v-icon>
              Ver detalles
            </v-list-tile-title>
          </v-list-tile>

          <v-list-tile @click="modal.open('edit', 'Eliminar'), form.edit('/usuarios/'+user.id)">
            <v-list-tile-title class="green--text text--lighten-2  body-1">
              <v-icon class="green--text text--lighten-2 body-1 mr-1">fa-pencil</v-icon>
              Editar
            </v-list-tile-title>
          </v-list-tile>

          <v-list-tile>
            <v-list-tile-title class="orange--text text--lighten-3  body-1">
              <v-icon class="orange--text text--lighten-3 body-1 mr-1">vpn_key</v-icon>
              Cambiar contraseña
            </v-list-tile-title>
          </v-list-tile>

          <v-list-tile @click="modal.open('delete', 'Eliminar'), form.id = user.id, form.username = user.username">
            <v-list-tile-title class="red--text text--lighten-2  body-1">
              <v-icon class="red--text text--lighten-2 body-1 mr-1">fa-trash-o</v-icon>
              Eliminar
            </v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>

      <v-layout row>
        <avatar :src="user.avatar" size="100" hoverable></avatar>
        <v-layout class="ml-3 mt-0 mb-0 details" column>
          <h1 class="subheading mb-2">{{ '@'+user.username }}</h1>
          <div>
            <v-chip class="ma-0 mb-2 caption" color="orange" label small text-color="white">
              {{ user.role_id }}
            </v-chip>
          </div>
          <small class="caption grey--text">{{ user.name }} {{ user.lastname }}</small>
          <small class="caption green--text text--lighten-3">{{ user.account.name }}</small>
        </v-layout>
      </v-layout>
    </v-card>
  </v-flex>
</template>

<script>
export default {
  props: ['form', 'modal', 'user'],
  data() {
    return {
      windowWidth: 0
    }
  },
  methods: {
    onResize() {
      this.windowWidth = window.innerWidth
    }
  },
  computed: {
    cardClass() {
      if (this.windowWidth < 600) {
        return 'mb-3'
      }

      return 'ma-2'
    }
  }
}
</script>

<style lang="scss">
  .card-menu
  {
    position: absolute;
    right: 0;
    top: .6em;

  }
  .user-card
  {
    align-items: center!important;
    .details
    {
      display: flex;
      justify-content: center;
    }
  }
</style>
