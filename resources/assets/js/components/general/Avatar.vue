<template lang="html">
  <div
    class="custom-avatar"
    :class="cssClasses"
    :style=" 'height:'+size+'px; width:'+size+'px; background-image: url('+src+');' "
  >
  </div>
</template>

<script>
export default {
  props: {
    hoverable: Boolean,
    src: String,
    size: String,
    square: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    cssClasses() {
      let css = ''

      if (this.hoverable) {
        css = css + 'custom-avatar--hoverable '
      }

      if (this.square) {
        css = css + 'custom-avatar--square'
      }

      return css
    }
  }
}
</script>

<style lang="scss">

.custom-avatar {
  background-color: #fefefe;
  background-size: cover;
  background-position: center;
  border-radius: 50%;
  overflow: hidden;
  transition: 0.2s ease-in-out;
  &--square{
    border-radius: 0!important;
  }
  &--hoverable:hover {
    transform: scale(1.1) rotate(-10deg);
    box-shadow: 0 3px 15px rgba(0,0,0,0.3);
  }
}
</style>
