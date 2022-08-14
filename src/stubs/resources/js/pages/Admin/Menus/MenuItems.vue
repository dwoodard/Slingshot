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

          <div class="text-right">
            <v-menu
              v-show="!readonly"
              v-model="menu"
              :nudge-width="200"
              offset-x
              :close-on-content-click="false">
              <template #activator="{on, attrs}">
                <v-tooltip
                  v-show="!readonly"
                  right
                  v-bind="attrs"
                  v-on="on">
                  <template #activator="{ on:menu, tooltip }">
                    <v-icon
                      v-show="!readonly"
                      v-bind="attrs"
                      v-on="on">
                      mdi-dots-horizontal
                    </v-icon>
                  </template>
                  <span>More</span>
                </v-tooltip>
              </template>
              <v-list dense>
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
            hint="Title of the menu"
            label="Title"/>
        </v-col>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="itemLocal.icon"
            hint="Icon is MDI icon name, use the finder link to find more icons"
            :prepend-icon="itemLocal.icon"
            label="Icon">
            <template #append-outer>
              <v-tooltip bottom>
                <template #activator="{ on }">
                  <a href="https://pictogrammers.github.io/@mdi/font/5.9.55/" target="_blank">
                    <v-icon v-on="on">mdi-open-in-new</v-icon>
                  </a>
                </template>
                <span>Find Icons</span>
              </v-tooltip>
            </template>
          </v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="10">
          <v-text-field
            v-if="itemLocal.type === 'internal'"
            v-model="itemLocal.link"
            hint="relative path to the page (ex: /about)"
            label="Internal Link"/>
          <v-text-field
            v-if="itemLocal.type === 'external'"
            v-model="itemLocal.link"
            hint="External link start with https://"
            label="External Link"/>
        </v-col>
        <v-col cols="12" md="2">
          <v-switch
            v-model="itemLocal.type"
            :true-value="'external'"
            :false-value="'internal'"/>
        </v-col>
      </v-row>
      <v-row v-if="itemLocal.type === 'external'">
        <v-col cols="12" md="6">
          <v-select
            v-model="itemLocal.target"
            :hint="itemLocal.target === '_self' ? 'Open in same tab' : 'Open in new tab'"
            persistent-hint
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
