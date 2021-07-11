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
      <template #top>
        <v-text-field
          v-model="searchPages"
          label="Search"
          class="mx-4"/>
      </template>
    </v-data-table>
    <!--    <pre>{{ selectedPages }}</pre>-->
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
            text: 'created_at',
            align: 'start',
            sortable: true,
            value: 'created_at'
          }


        ]
      };
    }

  };
</script>

<style scoped>

</style>
