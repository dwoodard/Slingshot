<template>
  <div>
    <v-app>
      <v-app-bar clipped-left app>
        <MainNav/>
        <v-spacer/>
        <ProfileMenu/>
      </v-app-bar>

      <AdminNav/>


      <v-main class="warm">
        <slot></slot>
      </v-main>
    </v-app>


    <!-- Modal Portal -->
    <portal-target name="modals" multiple/>
  </div>
</template>

<script>
  import ProfileMenu from '@/layouts/nav/ProfileMenu';
  import MainNav from '@/layouts/nav/MainNav';
  import AdminNav from '@/layouts/Admin/nav/AdminNav';

  export default {
    data() {
      return {};
    },
    components: {
      AdminNav,
      MainNav,
      ProfileMenu
    }
  };
</script>
