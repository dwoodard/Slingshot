<template>
  <div class="d-flex row">
    <v-tabs background-color="transparent">
      <inertia-link v-if="isAdmin" :href="route('admin.index')" as="v-tab">
        Admin
      </inertia-link>

      <template v-for="(menuItem,n) in menuItems">
        <inertia-link v-if="!menuItem.admin" :href="menuItem.link" as="v-tab">
          {{ menuItem.title }}
        </inertia-link>
      </template>
    </v-tabs>
  </div>
</template>
<script>
  export default {
    name: 'MainNav',
    computed: {
      menuItems() {
        return this.$page.props?.menuItems;
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
