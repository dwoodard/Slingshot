<template>
  <v-container fluid>
    <v-app-bar>
      <v-toolbar-title>Pages</v-toolbar-title>
      <v-spacer/>
      <v-tooltip bottom>
        <template #activator="{ on, attrs }">
          <v-icon v-bind="attrs"
                  v-on="on"
                  @click.stop="showCreatePage=true">
            mdi-text-box-plus
          </v-icon>
        </template>
        <span>Add Page</span>
      </v-tooltip>

      <ShowCreatePage v-model="showCreatePage"/>
    </v-app-bar>

    <v-data-table
      v-model="selectedPages"
      :search="searchPages"
      :headers="headers"
      :items="pages"
      item-key="email"
      dense
      show-select
      class="elevation-1">
      <template #item.title="props">
        <v-edit-dialog
          :return-value.sync="props.item.title">
          {{ props.item.title }}
          <template #input>
            <v-text-field
              v-model="props.item.title"
              label="Title"/>
          </template>
        </v-edit-dialog>
      </template>

      <template #top>
        <v-text-field
          v-model="searchPages"
          label="Search"
          class="mx-4"/>
      </template>

      <template #item.actions="{ item }">
        <a target="_blank" :href="`/${item.slug}`" class="text-decoration-none">
          <v-icon small class="mr-2">
            mdi-file-find-outline
          </v-icon>
        </a>
        <inertia-link :href="`/admin/pages/${item.slug}`" as="button">
          <v-icon small class="mr-2">
            mdi-pencil
          </v-icon>
        </inertia-link>
        <v-icon
          small
          @click="deleteItem()">
          mdi-delete
        </v-icon>

        <v-dialog
          v-model="showDeleteConfirm"
          max-width="290">
          <v-card>
            <v-card-title class="text-h5">
              Delete Page?
            </v-card-title>

            <v-card-text>
              Are you sure you and to delete this page?
            </v-card-text>

            <v-card-actions>
              <v-spacer/>

              <v-btn
                text
                @click="showDeleteConfirm = false">
                Disagree
              </v-btn>

              <v-btn
                color="red darken-1 white--text"
                @click="deleteItemConfirm(item);">
                Delete
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';
  import ShowCreatePage from '@/pages/Admin/Pages/create';

  export default {
    layout: Admin,
    props: ['pages'],
    data() {
      return {
        selectedPages: [],
        searchPages: '',
        showDeleteConfirm: false,
        showCreatePage: false,
        headers: [
          {
            text: 'Title',
            align: 'start',
            sortable: true,
            value: 'title'
          },
          {
            text: 'Slug',
            align: 'start',
            sortable: true,
            value: 'slug'
          },
          {
            text: 'Is Active',
            align: 'start',
            sortable: true,
            value: 'is_active'
          },
          {
            text: 'Actions',
            value: 'actions',
            sortable: false
          }
        ]
      };
    },
    methods: {
      deleteItem() {
        this.showDeleteConfirm = true;
      },

      deleteItemConfirm(item) {
        this.$inertia.delete(route('admin.page.delete', item), {
          onSuccess: (data) => {
            this.editedIndex = this.pages.indexOf(item);
            this.pages.splice(this.editedIndex, 1);
            this.showDeleteConfirm = false;
          },

          onFinish: () => {}
        });
      }


    },
    components: {
      ShowCreatePage
    }

  };
</script>
