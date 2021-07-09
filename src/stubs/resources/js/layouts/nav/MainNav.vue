<template>
  <div class="d-flex row">
    <inertia-link :href="route('home')" as="span">
      <v-app-bar-title class="primary--text pointer">
        PROJECT
      </v-app-bar-title>
    </inertia-link>
    <inertia-link v-if="isAdmin" :href="route('admin.index')" as="span">
      <v-btn text>Admin</v-btn>
    </inertia-link>
    <inertia-link :href="route('dashboard')" as="span">
      <v-btn text> Dashboard</v-btn>
    </inertia-link>
  </div>
</template>
<script>
  export default {
    name: 'MainNav',
    computed: {
      hasAuthUser() {
        return this.$page.props?.auth.user;
      },
      isAdmin() {
        return this.$page.props?.auth.user?.data?.isAdmin;
      }
    }
  };
</script>
