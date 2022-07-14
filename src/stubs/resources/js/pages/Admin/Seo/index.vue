<template>
  <v-container fluid>
    <v-app-bar>
      <v-toolbar-title>
        SEO Builder
      </v-toolbar-title>
    </v-app-bar>
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';

  export default {
    layout: Admin,
    props: {
      menus: {
        type: Array
      },
      pages: {
        type: Array
      }
    },
    data() {
      return {};
    },
    computed: {

    },
    methods: {},
    components: {}
  };
</script>

<style scoped>

</style>
