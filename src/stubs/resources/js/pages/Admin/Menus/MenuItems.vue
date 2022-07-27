<template>
  <v-expansion-panel class="sortable menu-items" :readonly="readonly" :disabled="readonly">
    <v-expansion-panel-header class="flex">
      <template #default>
        <div class="d-flex justify-space-between">
          <div class="flex-grow-1">
            <span class="handle">
              <v-icon>mdi-drag-vertical</v-icon>
            </span>

            <span>
              <v-icon>{{ item.icon }}</v-icon>
            </span>

            <span>
              {{ item.title }}
            </span>
          </div>
          <div class=" text-right">
            <v-menu
              v-if="!readonly"
              v-model="menu"
              :nudge-width="200"
              offset-x
              :close-on-content-click="false">
              <template #activator="{on:menu, attrs}">
                <v-tooltip right>
                  <template #activator="{ on: tooltip }">
                    <v-icon v-bind="attrs" v-on="{ ...tooltip, ...menu }">
                      mdi-dots-horizontal
                    </v-icon>
                  </template>
                  <span>More</span>
                </v-tooltip>
              </template>
              <v-list>
                <v-list-item>
                  <v-switch v-model="itemLocal.show_icon" label="Show Icon"/>
                </v-list-item>

                <v-list-item>
                  <v-switch v-model="itemLocal.admin" label="Admin Only"/>
                </v-list-item>

                <v-list-item>
                  <v-switch v-model="itemLocal.hide_link" label="Hide Link"/>
                </v-list-item>
                <v-divider/>

                <v-list-item two-line @click="deleteItem(item)">
                  <v-list-item-content>
                    <v-list-item-title>
                      <v-icon>mdi-delete</v-icon>
                      Delete
                    </v-list-item-title>
                    <v-list-item-subtitle>
                      Delete this menu item
                    </v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-menu>
          </div>
        </div>
      </template>
    </v-expansion-panel-header>
    <v-expansion-panel-content>
      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="itemLocal.title"
            hint="Title of the page"
            label="Title"/>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="itemLocal.icon"
            hint="Icon is MDI icon name"
            :prepend-icon="itemLocal.icon"
            label="Icon">
            <template #append-outer>
              <v-tooltip bottom>
                <template #activator="{ on }">
                  <a href="https://pictogrammers.github.io/@mdi/font/6.9.96/" target="_blank">
                    <v-icon v-on="on">mdi-open-in-new</v-icon>
                  </a>
                </template>
                <span>Find Icons</span>
              </v-tooltip>
            </template>
          </v-text-field>
        </v-col>
      </v-row>

      <!-- a header in between the rows titled links-->


      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="itemLocal.slug"
            hint="can be relative to the url with '/' at the beginning"
            label="Slug"/>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            v-model="itemLocal.target"
            hint="Open page in new tab?"
            :items="[
              { text: 'self', value: '_self' },
              { text: 'blank', value: '_blank' },
            ]"
            label="Target"/>
        </v-col>
      </v-row>
    </v-expansion-panel-content>
  </v-expansion-panel>
</template>

<script>

  export default {
    name: 'MenuItems',
    props: {

      item: {
        type: Object,
        default: () => ({
          title: '',
          slug: '',
          icon: '',
          hide_link: false,
          show_icon: false,
          target: '_self' // '_self' or '_blank'
        }),

        required: true
      },

      readonly: {type: Boolean}
    },

    data() {
      return {
        menu: null,
        itemLocal: this.item
      };
    },

    methods: {
      updateItem() {
        this.$emit('update-item', this.itemLocal);
      },
      deleteItem() {
        this.$emit('delete-item', this.itemLocal);
      },
      onIconChanged(icon) {
        this.itemLocal.icon = icon;
      }


    }


  };
</script>

<style>
.menu-items .v-expansion-panel-header__icon{
  order: -1;
  margin-left: -1rem;
  padding-right: 1rem;
  position: relative;
}
.actions{
  order: 1;
}
</style>
