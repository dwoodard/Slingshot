<template>
  <v-expansion-panel class="sortable" :readonly="readonly" :disabled="readonly">
    <v-expansion-panel-header>
      <template>
        <div>
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
              { text: '_self', value: '_self' },
              { text: '_blank', value: '_blank' },
            ]"
            label="Target"/>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" md="6">
          <v-checkbox
            v-model="itemLocal.admin"
            hide-details
            label="Admin Only "/>

          <v-checkbox
            v-model="itemLocal.hide_link"
            hide-details
            label="Hide Link"/>

          <v-checkbox
            v-model="itemLocal.show_icon"
            hide-details
            label="Show Icon"/>
        </v-col>
      </v-row>


      <v-row>
        <v-col cols="12" md="6">
          <v-btn
            v-if="!readonly"
            color="red"
            text
            class="mar-0"
            @click="deleteItem(item)">
            <v-icon>mdi-delete</v-icon>
            Delete
          </v-btn>
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
          link: '',
          icon: '',
          hide_link: false,
          show_icon: false,
          target: '_self'
        }),

        required: true
      },

      readonly: {type: Boolean}
    },

    data() {
      return {
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

<style scoped>

</style>
