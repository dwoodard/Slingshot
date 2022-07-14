<template>
  <v-container fluid>
    <div class="d-flex">
      <div class="flex-grow-1">
      </div>
      <div class="flex-grow-1">
        <div>
          Old Page: {{ oldPageIndex }}
        </div>
        <div>
          New Page: {{ newPageIndex }}
        </div>
      </div>
    </div>

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
      <v-col cols="12" md="6">
        <v-card>
          <v-card-title>Pages</v-card-title>
          <v-card-text>
            <draggable v-model="pagesLocal" ghost-class="ghost" @end="onEnd">
              <transition-group key="" name="fade" tag="div">
                <div v-for="page in pagesLocal" :id="page.id" :key="page.id" class="sortable">
                  {{ page.title }}
                </div>
              </transition-group>
            </draggable>
          </v-card-text>
        </v-card>

        <pre>{{ pagesLocal }}</pre>
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
        oldPageIndex: '',
        newPageIndex: '',
        pageSearch: '',
        itemSearch: '',
        selectedMenu: null,
        pagesLocal: this.pages,
        menusLocal: this.menus

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
      onEnd(e) {
        console.log(e);
        this.oldPageIndex = e.oldIndex;
        this.newPageIndex = e.newIndex;
      }
    },

    components: {
      draggable
    }
  };
</script>

<style scoped>

</style>
