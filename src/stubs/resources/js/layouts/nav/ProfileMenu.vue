<template>
  <v-menu v-if="$page.props.user"
          offset-y>
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        color="primary"
        dark
        v-bind="attrs"
        v-on="on">
        {{ $page.props.user.username }}
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

    data() {
      return {
        items: [
          {title: 'Profile', link: this.route('profile.show')},
          {title: 'Settings', link: this.route('settings')},
          // {title: 'API Tokens', link: this.route('api-tokens.index')},
          {title: 'Logout', link: this.route('logout')}
        ]
      };
    }
  };
</script>
