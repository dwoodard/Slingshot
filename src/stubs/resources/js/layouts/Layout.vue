<template>
  <div>
    <v-app>
      <v-app-bar app clipped-right max-height="72px">
        <MainNav/>
        <v-spacer/>
        <ProfileMenu/>
        <v-app-bar-nav-icon @click="sidebarDrawer = !sidebarDrawer"/>
      </v-app-bar>

      <v-navigation-drawer v-model="sidebarDrawer" app right temporary clipped class="pa-3">
        <!-- SIDEBAR -->
        <div class="d-block">
          <inertia-link v-if="isAdmin" :href="route('admin.index')" as="span">
            <v-btn block text> Admin</v-btn>
          </inertia-link>
          <inertia-link text :href="route('home')">
            <v-btn block text left class="text-right">
              <v-icon class="mr-3">mdi-home</v-icon>
              Home
            </v-btn>
          </inertia-link>
        </div>
        <v-divider/>

        <v-list v-if="hasAuthUser">
          <v-list-item href="/logout">Logout</v-list-item>
        </v-list>
        <v-list v-else>
          <v-list-item href="/login">Login</v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-main class="warm">
        <slot></slot>
      </v-main>

      <v-bottom-navigation v-model="bottomDrawer" app>
        <inertia-link href="/home" as="v-btn">
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
  import MainNav from './nav/MainNav';

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
      logout() {
        this.$inertia.post(this.route('logout'));
      }
    },
    components: {
      MainNav,
      ProfileMenu
    }
  };
</script>

<style scoped>

</style>
