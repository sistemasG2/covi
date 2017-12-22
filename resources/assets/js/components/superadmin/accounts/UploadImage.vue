<template lang="html">
  <div class="image-upload-container mb-3">
    <h1 class="subheading grey--text text--lighten-2 mb-3">
      <v-icon class="grey--text text--lighten-2 mr-2">fa-image</v-icon>
      Logotipo de cuenta
    </h1>
    <v-layout class="align-items--center image-box">
      <div>

        <div class="image-preview mb-3">
          <div v-if="preview">
            <v-avatar class="mb-3" size="130px" tile>
              <img :src="file" alt="">
            </v-avatar>
          </div>
          <div v-else class="image-placeholder">
            Imagen no disponible
          </div>
        </div>

        <v-btn class='ma-0 fit button teal'>
          <input class="uploader" type="file"  @change="onFileChange" accept="image/*">
          <span>subir imagen</span>
        </v-btn>
        <progress id="progress-bar" class="progress-bar" :max="progress.max" :value="progress.value"></progress>
      </div>
    </v-layout>
  </div>
</template>

<script>
export default {
  props: ['file'],
  data() {
    return {
      progress: {
        max: 0,
        value:0
      }
    }
  },
  computed: {
    preview() {
      if (this.file.length > 0) {
        return true
      }
      return false
    }
  },
  methods: {
    onFileChange(e) {

      const fileReader = new FileReader()

      this.resetProgress()

      fileReader.readAsDataURL(e.target.files[0])

      fileReader.onprogress = (e) => {
        if (e.lengthComputable) {
          this.progress.max = e.total
          this.progress.value = e.loaded
        }
      }

      // Save
      fileReader.onload = (e) => {
        this.$emit('update:file', e.target.result)
      }
    },
    resetProgress() {
      this.progress.max = 0
      this.progress.value = 0
    }
  },
  beforeMount() {
    console.log(this.progressBar)
  }
}
</script>

<style lang="scss">

.image-upload-container
{
  width: 100%;

  .image-box {
    //border: 1px dotted grey;
    background-color: rgba(0,0,0,0.1);
    display: flex;
    justify-content: center;
    position: relative;
    padding: 2em;
  }
  .image-preview {
    height: 130px;
    width: 130px;
    overflow: hidden;
    position: relative;

    .uploader-overlay
    {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: red;
    }
  }
  .progress-bar {
    background-color: grey;
    display: flex;
    height: .5em;
    overflow: hidden;
    margin-top: 1em;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;

    &::-webkit-progress-value{
      background-color: #81C784 !important;
    }
  }

  .image-placeholder
  {
    align-items: center;
    background-color: grey;
    color: #ddd;
    display: flex;
    height: 130px;
    justify-content: center;
    text-align: center;
    width: 130px;
  }

  .fit {
    overflow: hidden;
  }
  .fit * {
    display: inline;
  }
  .fit input[type=file] {
    bottom: 0;
    cursor: pointer;
    height: 100%;
    margin: 0;
    opacity: 0;
    padding: 0;
    position: absolute;
    right: 0;
    top: 0;
    -webkit-transform: translate(-300px, 0px) scale(4);
            transform: translate(-300px, 0px) scale(4);
  }

}
</style>
