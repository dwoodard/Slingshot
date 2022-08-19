<template>
  <div class="d-flex row">
    <v-tabs background-color="transparent">
      <inertia-link v-if="isAdmin" :href="route('admin.index')" as="v-tab">
        <v-icon class="mr-2">mdi-account-cog</v-icon> Admin
      </inertia-link>


      <template v-for="(item,n) in filterItems">
        <v-tab
          v-if="item.type === 'external' && !item.hide_link"
          :key="n"
          :href="itemLink(item)"
          :target="itemTarget(item)">
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
          :href="itemLink(item)"
          as="v-tab">
          <v-icon v-if="item.show_icon" class="mr-2">{{ item.icon }}</v-icon> {{ item.title }}
        </inertia-link>
      </template>
    </v-tabs>
  </div>
</template>
<script>


  export default {
    name: 'MainNav',
    computed: {
      filterItems() {
        const items = this.$page.props.menus?.find((menu) => menu.location === 'header')?.items;

        return items?.filter((item) => {
          if (item.admin && (!this.isAdmin)) {
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
      itemLink(item) {
        return item.link ? item.link : '';
      },
      itemTarget(item) {
        return item.target ? item.target : '';
      },
      showLink(item) {
        return !item.hide_link || !item.admin;
      }
    }

  };
</script>
