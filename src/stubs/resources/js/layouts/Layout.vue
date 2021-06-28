<template>
  <v-app>
    <v-navigation-drawer v-model="sidebarDrawer" app right temporary class="pa-3">
      <div>PROJECT</div>

      <v-divider/>

      <div v-if="$page.props.user" class="d-block">
        <div class="flex items-center">
          <v-list-item text :href="route('dashboard')" :active="route().current('dashboard')">
            <v-icon class="mr-3">mdi-view-dashboard</v-icon> Dashboard
          </v-list-item>
        </div>
      </div>
      <div v-else>
        <v-list>
          <v-list-item href="/">
            <v-icon>mdi-home</v-icon> Home
          </v-list-item>
        </v-list>
      </div>

      <v-divider/>

      <v-list v-if="$page.props.user">
        <v-list-item href="/logout">Logout</v-list-item>
      </v-list>
      <v-list v-else>
        <v-list-item href="/login">Login</v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app max-height="72px">
      <inertia-link :href="route('home')">
        PROJECT
      </inertia-link>

      <inertia-link :href="route('dashboard')">
        dashboard
      </inertia-link>


      <v-spacer/>

      <div v-if="$page.props.user" class="d-none d-md-block">
        <div class="flex items-center">
          <inertia-link :href="route('dashboard')">
            <v-btn text>
              Dashboard
            </v-btn>
          </inertia-link>
        </div>
      </div>


      <v-spacer/>


      <!--      <ProfileMenu/>-->
      <span>ProfileMenu</span>

      <v-app-bar-nav-icon @click="sidebarDrawer = !sidebarDrawer"/>
    </v-app-bar>

    <v-main class="warm">
      <slot></slot>
    </v-main>

    <v-bottom-navigation v-model="bottomDrawer" app>
      <inertia-link href="/Home" as="v-btn">
        <template #default>
          <span>Home</span>
          <v-icon>mdi-home</v-icon>
        </template>
      </inertia-link>
    </v-bottom-navigation>
  </v-app>
</template>

<script>

  export default {
    data() {
      return {
        sidebarDrawer: null,
        bottomDrawer: null
      };
    },

    methods: {
      route,
      logout() {
        this.$inertia.post(this.route('logout'));
      }
    },
    components: {}
  };
</script>

<style scoped>
.v-navigation-drawer{
  height: calc(100% - 72px);
  z-index: 9999;
  top: 56px;
}
</style>
