<template>
  <v-container fluid>
    Menus

    <pre>{{ menuItems }}</pre>
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';

  export default {
    layout: Admin,
    props: {
      menus: {
        type: Array
      }
    },
    data() {
      return {};
    },
    computed: {},
    methods: {},
    components: {}
  };
</script>

<style scoped>

</style>
