<template>
  <v-container fluid v-html="page.content"/>
</template>

<script>
  export default {
    props: ['page']
  };
</script>

<style scoped>

</style>
