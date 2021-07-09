<template>
  <v-navigation-drawer v-model="sidebarDrawer" :mini-variant.sync="mini" app dark permanent stateless clipped>
    <v-list dense flat outlined>
      <v-list-item class="pointer" @click="toggleMini = !toggleMini">
        <v-icon>mdi-menu-open</v-icon>
      </v-list-item>


      <div v-for="item in items" :key="item.title" class="pointer">
        <v-list-group v-if="item.items" v-model="item.active" :prepend-icon="item.icon">
          <template #activator>
            <v-list-item-content>
              <v-list-item-title>
                <inertia-link :href="item.link || ''" as="span">{{ item.title }}</inertia-link>
              </v-list-item-title>
            </v-list-item-content>
          </template>

          <template #default>
            <v-list-item v-for="child in item.items" :key="child.title" class="grey darken-1 ">
              <inertia-link v-if="child.link" as="div" class="" :href="child.link">
                <span>{{ child.title }}</span>
              </inertia-link>
              <v-list-item-content v-else>
                <v-list-item-title v-text="child.title"/>
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-list-group>

        <inertia-link v-else :href="item.link || ''" as="span" class="pointer">
          <v-list-item>
            <v-list-item-icon>
              <v-icon v-text="item.icon"/>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.title }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </inertia-link>
      </div>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
  export default {
    name: 'AdminNav',

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
    computed: {
      mini: {
        get() {
          return this.toggleMini || (this.$vuetify.breakpoint.smAndDown);
        },
        set(value) {
          return value;
        }

      }
    }
  };
</script>
