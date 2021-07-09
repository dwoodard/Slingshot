<template>
  <div class="d-flex row">
    <v-tabs background-color="transparent">
      <inertia-link :href="route('home')" as="v-tab">
        PROJECT
      </inertia-link>

      <inertia-link v-if="isAdmin" :href="route('admin.index')" as="v-tab">
        Admin
      </inertia-link>

      <inertia-link :href="route('dashboard')" as="v-tab">
        Dashboard
      </inertia-link>
    </v-tabs>
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
