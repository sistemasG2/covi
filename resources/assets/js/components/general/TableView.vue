<template lang="html">

  <v-data-table
    class="mt-3"
    :headers="table.headers"
    :items="table.items"
    :search="search"
    hide-actions
    item-key="name"
  >
    <template slot="items" slot-scope="props">
      <tr>


        <td v-for="property in table.headers" v-if="">{{ getValue(props.item, property.value) }}</td>

        <!-- Item Actions -->
        <td class="text-xs-right">
          <v-tooltip top>
            <v-btn class="ma-0" slot="activator" small flat icon>
              <v-icon class="cyan--text text--lighten-3 subheading">fa-eye</v-icon>
            </v-btn>
            <span>Más detalles</span>
          </v-tooltip>
          <v-tooltip top>
            <v-btn class="ma-0" slot="activator" small flat icon>
              <v-icon class="green--text text--lighten-3 subheading">fa-pencil</v-icon>
            </v-btn>
            <span>Editar</span>
          </v-tooltip>
          <v-tooltip top>
            <v-btn class="ma-0" slot="activator" small flat icon>
              <v-icon class="red--text text--lighten-3 subheading">fa-trash-o</v-icon>
            </v-btn>
            <span>Eliminar</span>
          </v-tooltip>
        </td>
      </tr>
    </template>
  </v-data-table>

</template>

<script>
export default {
  props: ['table', 'search'],
  data() {

  },
  methods: {
    getValue(item, prop) {
      if (typeof item[prop] == 'object') {
        return item[prop].name
      }

      return item[prop]
    }
  }
}
</script>

<style lang="css">
</style>
