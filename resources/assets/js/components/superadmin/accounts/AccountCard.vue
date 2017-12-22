<template lang="html">
<v-flex v-resize="onResize" xs12 sm6 md4 >
  <v-card :class="cardClass">
    <v-card-title class="pt-4">
      <v-layout class="" row>
        <v-avatar tile class="mr-3 grey lighten-2" size="120px">
          <img :src="imagesurl+item.avatar" :alt="'Logo de '+item.name">
        </v-avatar>
        <v-layout class="mr-1 ma-0" column>

          <h1 class="mb-2 pr-4 title grey--text text--lighten-1">{{ item.name }}</h1>

          <div>
            <v-chip label class="ml-0 caption" :color="typeColor(item.type)" text-color="white" small>{{typeName(item.type)}}</v-chip>
          </div>
          <div>
            <v-divider class="mt-1 mb-1"></v-divider>
          </div>

          <h3 class="body-2 grey--text">Empresa: <b class="grey--text text--lighten-1">{{ item.company }}</b></h3>
          <h3 class="body-2 grey--text">Clave: <b class="grey--text text--lighten-1">{{ item.key }}</b></h3>
        </v-layout>
      </v-layout>
    </v-card-title>

    <v-menu  transition="slide-x-transition" class="card-menu" bottom left>
      <v-btn icon slot="activator" dark>
        <v-icon class="grey--text">more_vert</v-icon>
      </v-btn>
      <v-list class="pa-0">

        <v-list-tile @click="parentViewItem(item)">
          <v-list-tile-title class="cyan--text text--lighten-2  body-1">
            <v-icon class="cyan--text text--lighten-2 body-1 mr-1">fa-eye</v-icon>
            Ver detalles
          </v-list-tile-title>
        </v-list-tile>

        <v-list-tile @click="parentModal('edit', item)">
          <v-list-tile-title class="green--text text--lighten-2  body-1">
            <v-icon class="green--text text--lighten-2 body-1 mr-1">fa-pencil</v-icon>
            Editar
          </v-list-tile-title>
        </v-list-tile>

        <v-list-tile @click="parentModal('delete', item)">
          <v-list-tile-title class="red--text text--lighten-2  body-1">
            <v-icon class="red--text text--lighten-2 body-1 mr-1">fa-trash-o</v-icon>
            Eliminar
          </v-list-tile-title>
        </v-list-tile>

      </v-list>
    </v-menu>
  </v-card>
</v-flex>

</template>

<script>
export default {
  props: ['item', 'imagesurl'],
  data() {
    return {
      windowWidth: 0
    }
  },
  methods: {
    typeColor(type) {
      switch(type) {
        case 1:
            return 'teal'
            break
        case 2:
            return 'blue'
            break
        case 3:
            return 'orange'
            break
        default:
            return 'grey'
      }
    },
    typeName(type) {
      switch(type) {
        case 1:
            return 'Básica'
            break
        case 2:
            return 'Normal'
            break
        case 3:
            return 'Premium'
            break
        default:
            return 'N/A'
      }
    },
    parentModal(action, item = null) {
      this.$parent.openModal(action, item)
    },
    parentViewItem(item) {
      this.$parent.openItem(item)
    },
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

<style lang="css">
  .card-menu
  {
    position: absolute;
    right: 0;
    top: .6em;
  }
</style>
