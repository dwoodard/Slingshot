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


          <template v-for="(item,n) in headerItems">
            <inertia-link v-if="!item.admin || !item.hide_link" :href="item.link" as="span">
              <v-btn block text> <v-icon v-if="item.show_icon">{{ item.icon }}</v-icon> {{ item.title }}</v-btn>
            </inertia-link>
          </template>
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

      <v-bottom-navigation v-if="footerItems.length" v-model="bottomDrawer" app>
        <template v-for="(item,n) in footerItems">
          <inertia-link v-if="!item.admin || !item.hide_link" :href="item.link" as="v-btn">
            <template #default>
              <span>{{ item.title }}</span>
              <v-icon v-if="item.show_icon">{{ item.icon }}</v-icon>
            </template>
          </inertia-link>
        </template>
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
      headerItems() {
        return this.$page.props?.menus?.find((menu) => menu.location === 'header')?.items;
      },
      footerItems() {
        return this.$page.props?.menus?.find((menu) => menu.location === 'footer')?.items;
      },
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
