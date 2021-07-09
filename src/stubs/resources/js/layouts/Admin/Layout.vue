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
  import MainNav from '../nav/MainNav';
  import AdminNav from './AdminNav';

  export default {
    data() {
      return {
        sidebarDrawer: true,
        toggleMini: false,
        items: [
          {
            title: 'Dashboard',
            // active: true,
            link: '/admin/dashboard',
            icon: 'mdi-view-dashboard'
          },
          {
            title: 'Users',
            header: 'Users',
            link: '/admin/users',
            icon: 'mdi-account'
          },
          {
            title: 'Pages',
            link: '/admin/pages',
            icon: 'mdi-file-document-multiple-outline'
          },


          {
            title: 'Posts',
            icon: 'mdi-post-outline',
            link: '/admin/posts'
            // items: [
            //   {title: 'Comments'}
            // ]
          }


        ]
      };
    },


    methods: {
      logout() {
        this.$inertia.post(this.route('logout'));
      }
    },
    components: {
      AdminNav,
      MainNav,
      ProfileMenu
    }
  };
</script>
