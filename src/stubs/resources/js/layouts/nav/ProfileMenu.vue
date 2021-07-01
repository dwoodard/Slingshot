<template>
  <v-menu v-if="$page.props.auth.user"
          offset-y>
    <template #activator="{ on, attrs }">
      <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on">
        {{ usernameFromEmail }}
      </v-btn>
    </template>
    <v-list class="pa-3">
      <v-list-item-title>Manage Account</v-list-item-title>

      <v-list-item
          v-for="(item, index) in items"
          :key="index"
          link
          :href="item.link">
        <v-list-item-title>{{ item.title }}</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-menu>
</template>
<script>
export default {
  name: 'ProfileMenu',
  computed: {
    usernameFromEmail(){
      return this.$page.props.auth.user.email.split('@')[0].toLowerCase();
    }
  },
  data() {
    return {
      items: [
        {title: 'Profile', link: this.route('profile.show')},
        {title: 'Settings', link: this.route('settings.show')},
        // {title: 'API Tokens', link: this.route('api-tokens.index')},
        {title: 'Logout', link: this.route('logout')}
      ]
    };
  }
};
</script>
