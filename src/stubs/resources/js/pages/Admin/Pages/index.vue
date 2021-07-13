<template>
  <v-container fluid>
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
          :return-value.sync="props.item.title"
          @save="save"
          @cancel="cancel"
          @open="open"
          @close="close">
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
          <v-icon small
                  class="mr-2">
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
          @click="deleteItem(item)">
          mdi-delete
        </v-icon>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';

  export default {
    layout: Admin,
    props: ['pages'],
    data() {
      return {
        selectedPages: [],
        searchPages: '',
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
            text: 'sort_order',
            align: 'start',
            sortable: true,
            value: 'sort_order'
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
      previewItem(item) {
        this.editedIndex = this.desserts.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog = true;
      },

      editItem(item) {
        this.editedIndex = this.desserts.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog = true;
      },

      deleteItem(item) {
        this.editedIndex = this.desserts.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialogDelete = true;
      },

      deleteItemConfirm() {
        this.desserts.splice(this.editedIndex, 1);
        this.closeDelete();
      },


      save() {
        this.snack = true;
        this.snackColor = 'success';
        this.snackText = 'Data saved';
      },
      cancel() {
        this.snack = true;
        this.snackColor = 'error';
        this.snackText = 'Canceled';
      },
      open() {
        this.snack = true;
        this.snackColor = 'info';
        this.snackText = 'Dialog opened';
      },
      close() {
        console.log('Dialog closed');
      }
    }

  };
</script>
