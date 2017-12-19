<template lang="html">
  <v-dialog
    v-model='viewItem.show'
    max-width="600px"
    persistent
  >
    <v-card>
      <!-- Heading -->
      <v-layout class="pa-1 pl-3 align-center">
        <v-spacer></v-spacer>
        <v-btn color='grey' flat icon @click.prevent='close'>
          <v-icon>close</v-icon>
        </v-btn>
      </v-layout>
      <v-divider></v-divider>
      <v-card-text class="pa-3">
        <v-layout row wrap>
          <v-flex xs12 sm4>
            <v-avatar
              tile
              size="180px"
              class="grey lighten-4"
            >
              <img :src="viewItem.item.avatar" :alt="'Logo de '+viewItem.item.name">
            </v-avatar>
          </v-flex>
          <v-flex xs12 sm8>
            <v-layout class="mt-3 mb-3">
              <h1 class="display-1">{{ viewItem.item.name }}</h1>
              <v-spacer></v-spacer>
              <v-chip label class="mt-2 ml-3 caption" :color="typeColor(viewItem.item.type)" text-color="white" small>{{typeName(viewItem.item.type)}}</v-chip>
            </v-layout>
            <v-divider></v-divider>
            <v-layout row wrap class="mt-3 grey--text">
              <v-flex class="mb-1" xs12 sm6>
                <strong>Key: </strong>{{viewItem.item.key}}
              </v-flex>
              <v-flex class="mb-1" xs12 sm6>
                <strong>Empresa: </strong>{{viewItem.item.company}}
              </v-flex>
              <v-flex class="mb-1" xs12>
                <strong>Notas: </strong>
                <br>
                <p>{{viewItem.item.note}}</p>
              </v-flex>
            </v-layout>
          </v-flex>

        </v-layout>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ['viewItem'],
  methods: {
    close() {
      this.$parent.closeItem()
    },
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
  }
}
</script>

<style lang="css">
</style>
