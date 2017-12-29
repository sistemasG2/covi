<template lang="html">
  <v-flex xs12 class="avatar-form-uploader pa-0">
    <v-layout>
      <v-icon class="grey--text text--lighten-2">face</v-icon>
      <label class="grey--text text--lighten-2 subheading ml-3">Avatar</label>
    </v-layout>
    <div class="avatar-container">
      <div class="blur-bg" :style="'background-image: url('+file+')'"></div>
      <!-- <figure class="avatar"></figure> -->
      <figure class="avatar" :style="'background-image: url('+ preview +')'">
        <div class="reset-overlay" v-if="file.length > 0" @click="resetFile"><v-icon>close</v-icon></div>
      </figure>
      <v-btn class="b-1" color="teal" small @click="open">
        Subir imagen
      </v-btn>
      <input id="fileInput" class="file-input" type="file" accept="image/*" @change="onFileChange">
    </div>
    <progress
      id="progress-bar"
      class="progress-bar"
      max="100"
      value="60"
    >
    </progress>
  </v-flex>
</template>

<script>
export default {
  props: ['file'],
  methods: {
    onFileChange(ev) {
      const fileReader = new FileReader()

      fileReader.readAsDataURL(ev.target.files[0])

      fileReader.onload = (ev) => {
        this.$emit('update:file', ev.target.result)
      }
    },
    open() {
      document.getElementById('fileInput').click()
    },
    resetFile() {
      this.$emit('update:file', '')
    },
  },
  computed: {
    preview() {
      if (this.file.length <= 0) {
        return '/images/avatars/imagen-no-disponible.png'
      }
      return this.file
    }
  }
}
</script>

<style lang="scss">
  .avatar-form-uploader
  {
    position: relative;
    margin-bottom: 2em;
    .avatar-container
    {
      align-items: center;
      background-color: rgba(0,0,0,.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      margin-top: 1em;
      width: 100%;
      padding: 2em 0;
      position: relative;
      overflow: hidden;
    }
    .avatar
    {
      align-items: center;
      display: flex;
      background-color: #ddd;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 150px;
      justify-content: center;
      width: 150px;
      margin-bottom: 0.8em;
      z-index: 100;
      position: relative;
      transition: 0.3s ease;
      overflow: hidden;

      .reset-overlay {
        align-items: center;
        background-color: black;
        cursor: pointer;
        display: flex;
        height: 160px;
        justify-content: center;
        width: 160px;
        opacity: 0;
        transition: 0.3s ease;

        &:hover
        {
          opacity: 0.6;
        }
      }
    }
    .blur-bg
    {
      background-size: 120%;
      background-position: center;
      height: 100%;
      filter: blur(15px);
      position: absolute;
      width: 100%;
      transition: 0.3s ease;
    }
    .progress-bar
    {
      bottom: 0;
      background-color: grey;
      height: .2em;
      position: absolute;
      width: 100%;

      &::-webkit-progress-value{
        background-color: #81C784 !important;
      }
    }
    .file-input
    {
      display: block;
      height: 0;
      width: 0;
      visibility: hidden;
    }
  }
</style>
