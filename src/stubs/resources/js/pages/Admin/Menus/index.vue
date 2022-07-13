<template>
  <v-container fluid>
    <v-app-bar>
      <v-toolbar-title>
        Menu Builder
      </v-toolbar-title>
    </v-app-bar>

    <div>
      <v-select
        v-model="selectedMenu"
        :items="menus"
        label="Menu"
        item-text="title"
        :item-value="(value) => value"/>
    </div>


    <v-row>
      <v-col cols="12" md="6">
        <v-card>
          <v-card-title>Pages</v-card-title>
          <v-card-text>
            <draggable
              tag="ul"
              class="dragArea list-group"
              :list="pages"


              item-key="id">
              <template #item="{ element }">
                <li class="list-group-item">
                  {{ element.title }}
                </li>
              </template>
            </draggable>
          </v-card-text>
        </v-card>

        <pre>{{ pages }}</pre>
      </v-col>


      <v-col cols="12" md="6">
        <v-card>
          <v-card-title>Menu <span v-if="selectedMenu"> ({{ selectedMenu?.title }})</span></v-card-title>
          <v-card-text>
            <draggable
              class="dragArea list-group"
              :list="selectedMenu?.items"

              item-key="id">
              <template #item="{ element }">
                <div class="list-group-item">
                  {{ element.name }}
                </div>
              </template>
            </draggable>
          </v-card-text>
        </v-card>


        <pre>{{ selectedMenu }}</pre>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import draggable from 'vuedraggable';
  import Admin from '@/layouts/Admin/Layout';

  export default {
    layout: Admin,
    props: {
      menus: {
        type: Array
      },
      pages: {
        type: Array
      }
    },
    data() {
      return {
        pageSearch: '',
        itemSearch: '',
        selectedMenu: null

      };
    },
    computed: {
      selectedItems: {
        get() {
          return this.selectedMenu?.items;
        },
        set(items) {
          this.selectedMenu.items = items;
        }
      }

    },
    methods: {
      dragStart() {
        console.log('dragStart');
      },
      dragEnd() {
        console.log('dragEnd');
      },
      dragClone({id}) {
        console.log('dragClone', `Clone ${id}`);
        return {
          title: `Clone ${id}`

        };
      }
    },

    components: {
      draggable
    }
  };
</script>

<style scoped>

</style>
