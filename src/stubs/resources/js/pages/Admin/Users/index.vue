<template>
  <v-container fluid>
    <v-data-table
      v-model="selectedUsers"
      :search="searchUsers"
      :headers="headers"
      :items="users.data"
      item-key="email"
      dense
      show-select
      class="elevation-1">
      <template #top>
        <v-text-field
          v-model="searchUsers"
          label="Search"
          class="mx-4"/>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';

  export default {
    layout: Admin,
    props: ['users'],
    data() {
      return {
        selectedUsers: [],
        searchUsers: '',
        headers: [
          {
            text: 'Email',
            align: 'start',
            sortable: true,
            value: 'email'
          },
          {
            text: 'First Name',
            align: 'start',
            sortable: true,
            value: 'first_name'
          },
          {
            text: 'Last Name',
            align: 'start',
            sortable: true,
            value: 'last_name'
          },
          {
            text: 'username',
            align: 'start',
            sortable: true,
            value: 'username'
          },
          {
            text: 'phone',
            align: 'start',
            sortable: true,
            value: 'phone'
          },
          {
            text: 'address',
            align: 'start',
            sortable: true,
            value: 'address'
          },
          {
            text: 'city',
            align: 'start',
            sortable: true,
            value: 'city'
          },
          {
            text: 'state',
            align: 'start',
            sortable: true,
            value: 'state'
          },
          {
            text: 'zip',
            align: 'start',
            sortable: true,
            value: 'zip'
          }
        ]
      };
    }

  };
</script>

<style scoped>

</style>
