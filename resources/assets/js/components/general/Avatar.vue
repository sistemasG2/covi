<template lang="html">
  <div
    class="custom-avatar"
    :class="(square) ? 'custom-avatar--square' : ''"
    :style=" 'height:'+size+'px; width:'+size+'px; background-image: url('+src+');' "
  >
  </div>
</template>

<script>
export default {
  props: {
    src: String,
    size: Number,
    square: {
      type: Boolean,
      default: false
    }
  }
}
</script>

<style lang="scss">
.custom-avatar {

  background-color: #fefefe;
  border-radius: 50%;
  overflow: hidden;

  &--square{
    border-radius: 0!important;
  }
}
</style>
