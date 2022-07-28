<template>
  <div class="d-flex row">
    <v-tabs background-color="transparent">
      <inertia-link v-if="isAdmin" :href="route('admin.index')" as="v-tab">
        Admin
      </inertia-link>


      <template v-for="(item,n) in filterItems">
        <v-tab
          v-if="item.type === 'external' && !item.hide_link"
          :key="n"
          :href="item.link"
          :target="item.target">
          <template #default>
            <v-icon v-if="item.show_icon" class="mr-2">
              {{ item.icon }}
            </v-icon>
            <span>{{ item.title }}</span>
          </template>
        </v-tab>


        <inertia-link
          v-if="item.type === 'internal' && !item.hide_link"
          :key="n"
          :href="item.link"
          as="v-tab">
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
      filterItems() {
        return this.items?.filter((item) => {
          if (item.admin && !this.isAdmin) {
            return false;
          }

          return !item.hide_link;
        });
      },
      hasAuthUser() {
        return this.$page.props?.auth.user;
      },
      isAdmin() {
        return this.$page.props?.auth.user?.data?.isAdmin;
      }
    },
    methods: {
      showLink(item) {
        return !item.hide_link || !item.admin;
      }
    }
  };
</script>
