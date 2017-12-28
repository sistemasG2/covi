<template lang="html">
  <div>
    <!-- Title -->
    <v-layout class="grey--text mt-2 mb-2">
      <h1>Usuarios <span class="hidden-sm-and-down">registrados</span></h1>
      <v-spacer></v-spacer>
      <v-btn class="ma-0" color="blue-grey" @click="openModal('create')">
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
          <user-card></user-card>
          <user-card></user-card>
          <user-card></user-card>
        </v-layout>
      </v-container>
    </section>

  </div>

</template>

<script>
export default {
  data() {
    return {
      toggleViewOptions: 0,
      search: '',
    }
  }
}
</script>

<style lang="css">
</style>
