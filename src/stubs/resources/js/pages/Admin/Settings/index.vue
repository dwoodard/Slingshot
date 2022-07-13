<template>
  <v-container fluid>
    Site Settings

    <ul>
      <li>Site Title</li>
      <li>Default "home page" for root</li>
      <li></li>
      <li></li>
    </ul>


    <v-row>
      <v-col md="12">
        <v-row no-gutters>
          <v-col md="6">
            1
          </v-col>
          <v-col md="6">
            2
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';

  export default {
    layout: Admin,
    props: ['settings'],
    data() {
      return {

      };
    }

  };
</script>

<style scoped>

</style>
