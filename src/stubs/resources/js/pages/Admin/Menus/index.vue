<template>
  <v-container fluid>
    <v-toolbar color="primary">
      <v-toolbar-title>Menus</v-toolbar-title>
    </v-toolbar>

    <v-toolbar class="mb-3" dense elevation="1">
      <v-toolbar-items>
        <v-select
          v-model="selectedMenu"
          :items="menus"
          label="Menu"
          item-text="title"
          single-line
          :item-value="(menu) => menu"
          @change="changeMenu"/>
      </v-toolbar-items>
    </v-toolbar>

    <v-row>
      <v-col cols="12" md="6">
        <v-card>
          <v-card-title>Menu <span v-if="selectedMenu"> ({{ selectedMenu?.title }})</span></v-card-title>

          <v-card-text>
            <v-toolbar class="mb-2" color="primary" dark>
              <v-toolbar-title>Items</v-toolbar-title>
              <v-spacer/>
              <v-tooltip v-if="!editing" bottom>
                <template #activator="{ on, attrs }">
                  <v-btn v-bind="attrs" icon v-on="on" @click="action('edit')">
                    <v-icon
                      :class="{ 'animate__animated animate__tada animate__infinite animate__slow  ': !menusLocal.isDirty }">
                      mdi-pencil
                    </v-icon>
                  </v-btn>
                </template>
                <span>
                  Edit
                </span>
              </v-tooltip>
              <v-tooltip v-if="editing" bottom>
                <template #activator="{ on, attrs }">
                  <v-btn v-bind="attrs" icon v-on="on" @click="action('save')">
                    <v-icon
                      :class="{ 'mdi-48px animate__animated animate__bounceIn animate__slower': menusLocal.isDirty }">
                      mdi-check
                    </v-icon>
                  </v-btn>
                </template>
                <span>
                  Save
                </span>
              </v-tooltip>
              <v-tooltip v-if="editing" bottom>
                <template #activator="{ on, attrs }">
                  <v-btn v-bind="attrs" icon v-on="on" @click="action('cancel')">
                    <v-icon>mdi-close</v-icon>
                  </v-btn>
                </template>
                <span>
                  Cancel
                </span>
              </v-tooltip>
            </v-toolbar>

            <v-expansion-panels v-model="openedMenuPanels" :disabled="!editing" accordion>
              <template>
                <draggable
                  class="flex-grow-1"
                  :list="selectedMenuItems"
                  group="menuItems"
                  handle=".handle"
                  item-key="id">
                  <MenuItems v-for="(item,n) in selectedMenuItems"
                             :key="`item-${n}`"
                             :item="item"
                             :readonly="!editing"
                             @update-item="updateItem"
                             @delete-item="deleteItem(n)"/>
                </draggable>
              </template>
            </v-expansion-panels>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="6">
        <v-card v-if="editing">
          <v-card-title>Pages</v-card-title>
          <v-card-text>
            <v-text-field
              v-model="pageSearch"
              single-line
              label="Filter Pages"
              clearable
              @input="filterPagesLocal">
              <template #append>
                <v-icon>mdi-magnify</v-icon>
              </template>
            </v-text-field>


            <draggable
              v-model="pagesLocal"
              class="dragArea list-group"
              :group="{ name: 'menuItems', pull: 'clone', put: false }"
              multiple
              ghost-class="ghost"
              selected-class="selected"
              :clone="clonePage"
              @change="log">
              <transition-group
                group="pageList"
                name="flip-list"
                tag="div"
                type="transition">
                <div v-for="page in pagesLocal" :id="page.id" :key="page.id" class="sortable">
                  <span class="handle">
                    <v-icon>mdi-drag-vertical</v-icon>
                  </span>
                  {{ page.title }}
                </div>
              </transition-group>
            </draggable>
          </v-card-text>
        </v-card>

        <!--        <pre>{{ pagesLocal }}</pre>-->
      </v-col>
    </v-row>


    <!--      <pre>{{ before }}</pre>-->
  </v-container>
</template>

<script>
  import draggable from 'vuedraggable';
  import Admin from '@/layouts/Admin/Layout';
  import MenuItems from '@/pages/Admin/Menus/MenuItems';


  export default {
    layout: Admin,
    props: {
      menus: {
        type: Array,
        default: () => []
      },
      pages: {
        type: Array,
        default: () => []
      }
    },
    data() {
      return {
        openedMenuPanels: [],
        before: null,
        editing: false,
        pageSearch: '',
        itemSearch: '',
        selectedMenu: null,
        pagesLocal: this.pages,
        menusLocal: this.$inertia.form({
          ...this.menus
        })

      };
    },
    computed: {
      selectedMenuItems() {
        return this.selectedMenu?.items;
      }

    },
    methods: {
      changeMenu(menu) {
        this.selectedMenu = menu;
      },

      filterPagesLocal() {
        this.pagesLocal = this.pages.filter(
          // if pageSearch is empty or null, return all pages
          (page) => !this.pageSearch || page.title?.toLowerCase().includes(this.pageSearch?.toLowerCase())
        );
      },


      clonePage(e) {
        // console.log('clone', e);
        return {
          icon: '',
          link: `/${e.link}`,
          type: 'internal',
          admin: false,
          order: 0,
          title: e.title,
          target: '_self',
          hide_link: false,
          show_icon: true

        };
      },
      action(e) {
        if (e === 'edit') {
          this.editing = true;
          this.before = JSON.parse(JSON.stringify(this.selectedMenu));
        }
        if (e === 'cancel') {
          this.editing = false;
          this.selectedMenu = this.before;

          // reset before
          this.before = null;
        }
        if (e === 'save') {
          this.editing = false;

          // set the order of all the items
          this.selectedMenu.items.forEach((item, i) => {
            item.order = i;
          });

          this.$inertia.put(`/admin/menus/${this.selectedMenu.id}`, this.selectedMenu, {
            onSuccess: () => this.menusLocal.reset()
          });
        }

        // on cancel or save close all the panels
        if (e === 'cancel' || e === 'save') {
          this.openedMenuPanels = [];
        }
      },


      log(evt) {
        window.console.log(evt);
      },

      updateItem(item) {
        this.selectedMenu.items = this.selectedMenu.items.map((i) => {
          if (i.id === item.id) {
            return item;
          }
          return i;
        });
      },
      deleteItem(index) {
        this.selectedMenu.items.splice(index, 1);
      }
    },
    mounted() {
      this.selectedMenu = this.menusLocal[0];
    },

    components: {
      draggable,
      MenuItems
    }
  };
</script>

<style scoped>
.sortable-drag{}
.ghost{
  border: 1px dashed #ccc;
  background-color: #dedede;
}
.selected{
  background: linear-gradient(to right, #f5f5f5, #f5f5f5);
}
.flip-list-move{
  transition: all .5s;
}
</style>
