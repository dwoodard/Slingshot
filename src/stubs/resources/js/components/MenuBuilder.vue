<!--
    MenuBuilder is a component that is used to create a menu.
    It is used in the Admin/Menus/index.vue page.
    useing pages and menus as props, the MenuBuilder component
    will create a menu based on the pages and menus that are passed
    useing vuetify as the component library, it will use a drag and drop
    system to create a menu. of the pages to create a menu.
    the menu will have categories, and the categories will have links.
-->
<template>
  <v-container fluid>
    <v-app-bar>
      <v-toolbar-title>
        Menu Builder
      </v-toolbar-title>
    </v-app-bar>
    <v-tabs>
      <template v-for="(menu,i) in mutableMenus">
        <v-tab>
          {{ menu.title }}
        </v-tab>
      </template>
    </v-tabs>

    <br/>

    <draggable
      v-model="mutableMenus"
      @start="drag=true"
      @end="drag=false">
      <transition-group>
        <div v-for="(menu,n) in mutableMenus" :key="n">
          <v-list>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  {{ menu.title }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </div>
      </transition-group>
    </draggable>


    <!--
    create a side by side for the drag and drop system and the menu builder
    left will be the pages and the left with be the menu
    -->
  </v-container>
</template>

<script>
  import draggable from 'vuedraggable';

  export default {
    props: {
      pages: {
        type: Array
      },
      menus: {
        type: Array
      }
    },
    data() {
      return {
        mutableMenus: JSON.parse(JSON.stringify(this.menus)),
        mutablePages: JSON.parse(JSON.stringify(this.pages))
      };
    },

    methods: {},
    components: {
      draggable
    }
  };
</script>

<style scoped>

</style>
