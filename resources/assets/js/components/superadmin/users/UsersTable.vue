<template lang="html">

  <v-data-table
    class="mt-3"
    :headers="table.headers"
    :items="table.items"
    :search="search"
    :rows-per-page-items="[10,25,50,100, {text: 'Todos', value: -1}]"
    :rows-per-page-text="'Resultados por página'"
    item-key="name"
  >
    <template slot="items" slot-scope="props">
      <tr>


        <td>{{ props.item.id }}</td>
        <td>{{ props.item.username }}</td>
        <td>{{ props.item.name }}</td>
        <td>{{ props.item.lastname }}</td>
        <td>{{ props.item.email }}</td>
        <td>{{ props.item.account.name }}</td>

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
    <template slot="pageText" slot-scope="{ pageStart, pageStop }">
      {{ pageStart }}-{{ pageStop }} de {{ table.items.length }}
    </template>
  </v-data-table>

</template>



<script>
export default {
  props: ['table', 'search'],
}
</script>

<style lang="css">
</style>
