<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="sidebarDrawer"
      app>
      <!--  -->
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="sidebarDrawer = !sidebarDrawer"/>

      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <slot></slot>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    data() {
      return {
        sidebarDrawer: null,
        bottomDrawer: null
      };
    }
  };
</script>

<style scoped>

</style>
