<template lang="html">
  <v-flex xs12 class="avatar-form-uploader pa-0">
    <v-layout>
      <v-icon class="grey--text text--lighten-2">face</v-icon>
      <label class="grey--text text--lighten-2 subheading ml-3">Avatar</label>
    </v-layout>
    <div class="avatar-container">
      <div class="blur-bg" :style="'background-image: url('+file+')'"></div>
      <!-- <figure class="avatar"></figure> -->
      <figure class="avatar" :style="'background-image: url('+ preview +'); background-color:'+form.avatar_bg_color">
        <div class="letters_preview" v-if="this.file.length <= 0" >

          {{ (form.name) ? form.name[0].toUpperCase() : '' }}{{ (form.lastname) ? form.lastname[0].toUpperCase() : '' }}
        </div>
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
      :max="progress.max"
      :value="progress.value"
    >
    </progress>

    <div v-if="form.avatar.length <= 0" class="pt-3 pb-3 color_selection">
      <span class="grey--text mr-2">Fondo: </span>
      <div class="color_selection__items">
        <div v-for="color in colors" @click="selectColor(color.id)" :id="'color_'+color.id" class="color_selection__items__item" :class="(selectedColor == color.id) ? 'active' : ''" :style="'background-color:'+color.hex+';'"></div>
      </div>
    </div>

  </v-flex>
</template>

<script>
export default {
  props: ['file', 'form'],
  data() {
    return {
      progress: {
        max: 100,
        value: 0
      },
      selectedColor: '',
      colors:  [
          {id: 1, hex: '#f44336'},
          {id: 2, hex: '#E91E63'},
          {id: 3, hex: '#9C27B0'},
          {id: 4, hex: '#673AB7'},
          {id: 5, hex: '#3F51B5'},
          {id: 6, hex: '#2196F3'},
          {id: 7, hex: '#03A9F4'},
          {id: 8, hex: '#00BCD4'},
          {id: 9, hex: '#009688'},
          {id: 10, hex: '#4CAF50'},
          {id: 11, hex: '#8BC34A'},
          {id: 12, hex: '#CDDC39'},
          {id: 13, hex: '#FFC107'},
          {id: 14, hex: '#FF9800'},
          {id: 15, hex: '#FF5722'},
      ]
    }
  },
  mounted() {
    this.randomColor()
  },
  methods: {
    onFileChange(ev) {
      const fileReader = new FileReader()

      fileReader.readAsDataURL(ev.target.files[0])

      fileReader.onprogress = (e) => {
        if (e.lengthComputable) {
          this.progress.max = e.total
          this.progress.value = e.loaded
        }
      }

      fileReader.onload = (ev) => {
        this.$emit('update:file', ev.target.result)
      }
    },
    open() {
      document.getElementById('fileInput').click()
    },
    randomColor() {
      function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
      }

      let colorId = getRandomInt(1, 15);

      this.selectedColor = colorId
      this.form.avatar_bg_color = this.colors[colorId-1].hex
    },
    resetFile() {
      this.$emit('update:file', '')
    },
    selectColor(colorId){
      this.selectedColor = colorId
      this.form.avatar_bg_color = this.colors[colorId-1].hex
    }
  },
  computed: {
    preview() {
      if (this.file.length <= 0) {
        return ''
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
    .letters_preview
    {
      font-family: 'open-sans', sans-serif;
      font-size: 48px;
      font-weight: 600;
    }
  }

  .color_selection
  {
    background-color: white;
    display: flex;
    justify-content: center;
    padding: 1em;

    &__items
    {
      display: flex;
      flex-wrap: wrap;
      &__item
      {
        border-radius: 50%;
        cursor: pointer;
        margin: 0.2em;
        height: 16px;
        width: 16px;
        opacity: .3;
        transition: 0.3s ease-in-out;

        &.active
        {
          opacity: 1;
          transform: scale(1.3);
        }

        &:hover
        {
          opacity: 1;
          //transform: scale(1.2);
        }
      }
    }
  }
</style>
