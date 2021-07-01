<template>
  <v-avatar color="primary" size="30" max-width="50">
    <slot> {{ initials }} </slot>
  </v-avatar>
</template>

<script>
  export default {
    props: ['name'],
    computed: {
      initials() {
        return this.name.split(' ').reduce((result, currentWord) => result + currentWord.charAt(0).toUpperCase(), '');
      }
    }
  };
</script>

<style scoped>

</style>
