<template>
  <div class="d-flex row">
    <v-tabs background-color="transparent">
      <inertia-link v-if="isAdmin" :href="route('admin.index')" as="v-tab">
        Admin
      </inertia-link>


      <template v-for="(item,n) in items">
        <inertia-link v-if="!item.hide_link ||!item.admin" :key="n" :href="item.link" as="v-tab">
          <v-icon v-if="item.show_icon" class="mr-2">{{ item.icon }}</v-icon>
          {{ item.title }}
        </inertia-link>
      </template>
    </v-tabs>
  </div>
</template>
<script>
  export default {
    name: 'MainNav',
    computed: {
      items() {
        return this.$page.props?.menus?.find((menu) => menu.location === 'header')?.items;
      },
      hasAuthUser() {
        return this.$page.props?.auth.user;
      },
      isAdmin() {
        return this.$page.props?.auth.user?.data?.isAdmin;
      }

    }
  };
</script>
