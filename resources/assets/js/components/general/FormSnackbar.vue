<template lang="html">
  <v-snackbar v-model="form.snackbar.show" :color="form.snackbar.color" bottom>
    <v-icon class="mr-3 subheading">{{ form.snackbar.icon }}</v-icon>
    {{ form.snackbar.message }}
  </v-snackbar>
</template>

<script>
export default {
  props: ['form']
}
</script>

<style lang="css">
</style>
