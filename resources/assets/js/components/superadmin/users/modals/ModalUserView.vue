<template lang="html">
<v-dialog
    v-model="show"
    fullscreen
    transition="dialog-bottom-transition"
    :overlay=false
    scrollable
  >
    <v-card>
      <v-toolbar style="flex: 0 0 auto;">
        <v-btn icon @click.native="show = false">
          <v-icon>close</v-icon>
        </v-btn>
        <v-toolbar-title>Perfil de @noson</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
          <v-btn flat small>
            <v-icon class="b1">fa-send-o</v-icon>
          </v-btn>
        </v-toolbar-items>
      </v-toolbar>
      <v-card-text>
        <v-layout row wrap>
          <v-flex xs12 sm6>
            <!-- <label for="name">
              Nombre:
              <input type="text" value="Eduardo" readonly>
              <v-btn flat icon small>
                <v-icon class="subheading">fa-lock</v-icon>
              </v-btn>
            </label> -->
            <v-text-field
              label="Nombre"
              append-icon="fa-lock"
              v-model="name"
              
            >
            </v-text-field>
          </v-flex>
          <v-flex xs12 sm6>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus itaque molestiae quis nam sapiente veritatis est! Cumque ea assumenda voluptatem ipsum, iusto maxime consectetur doloremque ex dolores, voluptatum recusandae sequi?
          </v-flex>
        </v-layout>
      </v-card-text>
    </v-card>
</v-dialog>
</template>

<script>
export default {
  data() {
    return {
      name: 'Eduardo',
      show: true,
      avatar: 'https://s3.amazonaws.com/coviweb/images/users/avatars/1801091515528793GlHVSbD0Je.jpg'
    }
  }
}
</script>

<style lang="scss">


</style>
