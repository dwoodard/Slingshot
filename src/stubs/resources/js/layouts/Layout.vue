<template>
  <div>
    <v-app>
      <v-navigation-drawer v-model="sidebarDrawer" app right temporary class="pa-3">
        <!-- SIDEBAR -->
        <div>PROJECT</div>

        <v-divider/>

        <div v-if="hasAuthUser" class="d-block">
          <inertia-link v-if="isAdmin" :href="route('admin.index')" as="span">
            <v-btn block text> Admin</v-btn>
          </inertia-link>

          <inertia-link text :href="route('dashboard')">
            <v-btn block text left class="text-right">
              <v-icon class="mr-3">mdi-view-dashboard</v-icon>
              Dashboard
            </v-btn>
          </inertia-link>
        </div>
        <div v-else>
          <v-list>
            <v-list-item href="/">
              <v-icon>mdi-home</v-icon>
              Home
            </v-list-item>
          </v-list>
        </div>

        <v-divider/>

        <v-list v-if="hasAuthUser">
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

        <inertia-link v-if="isAdmin" :href="route('admin.index')" as="span">
          <v-btn text> Admin</v-btn>
        </inertia-link>

        <inertia-link :href="route('dashboard')" as="span">
          <v-btn text> Dashboard</v-btn>
        </inertia-link>


        <v-spacer/>


        <ProfileMenu/>

        <v-app-bar-nav-icon @click="sidebarDrawer = !sidebarDrawer"/>
      </v-app-bar>

      <v-main class="warm">
        <slot></slot>
      </v-main>

      <v-bottom-navigation v-model="bottomDrawer" app>
        <inertia-link href="/dashboard" as="v-btn">
          <template #default>
            <span>Home</span>
            <v-icon>mdi-home</v-icon>
          </template>
        </inertia-link>
      </v-bottom-navigation>
    </v-app>

    <!-- Modal Portal -->
    <portal-target name="modals" multiple/>
  </div>
</template>

<script>
  import ProfileMenu from '@/layouts/nav/ProfileMenu';

  export default {
    data() {
      return {
        sidebarDrawer: null,
        bottomDrawer: null
      };
    },
    computed: {
      hasAuthUser() {
        return this.$page.props?.auth.user;
      },
      isAdmin() {
        return this.$page.props?.auth.user?.data?.isAdmin;
      }
    },

    methods: {
      route,
      logout() {
        this.$inertia.post(this.route('logout'));
      }
    },
    components: {
      ProfileMenu
    }
  };
</script>

<style scoped>
.v-navigation-drawer{
  height: calc(100% - 72px);
  z-index: 9999;
  top: 56px;
}
</style>
