<template>
  <v-container fluid>
    <v-app-bar>
      <v-toolbar-title>Users</v-toolbar-title>
      <v-spacer/>
      <v-tooltip bottom>
        <template #activator="{ on, attrs }">
          <v-icon v-bind="attrs"
                  v-on="on"
                  @click.stop="showCreateUser=true">
            mdi-account-plus
          </v-icon>
        </template>
        <span>Add User</span>
      </v-tooltip>

      <ShowCreateUser v-model="showCreateUser"/>
    </v-app-bar>
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

      <template #item.actions="{ item }">
        <inertia-link :href="`/admin/users/${item.id}`" as="button">
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

    <portal to="modals">
      <v-dialog
        v-model="showDeleteConfirm"
        max-width="500">
        <v-card>
          <v-card-title class="text-h5">
            Delete User?
          </v-card-title>

          <v-card-text>
            Are you sure you and to delete this user?
          </v-card-text>

          <v-card-actions>
            <v-btn
              text
              @click="showDeleteConfirm = false">
              Don't Delete
            </v-btn>
            <v-spacer/>
            <v-btn
              color="red darken-1 white--text"
              @click="deleteItemConfirm();">
              Delete
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </portal>


    <!--    <pre>{{ selectedUsers }}</pre>-->
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';
  import ShowCreateUser from '@/pages/Admin/Users/create';

  export default {
    layout: Admin,
    props: ['users'],
    data() {
      return {
        showCreateUser: false,
        selectedUsers: [],
        searchUsers: '',
        showDeleteConfirm: false,
        headers: [
          {
            text: 'Email',
            align: 'start',
            sortable: true,
            value: 'email'
          },
          {
            text: 'username',
            align: 'start',
            sortable: true,
            value: 'username'
          },
          {
            text: 'roles',
            align: 'start',
            sortable: true,
            value: 'roles'
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
      deleteItem(item) {
        this.selectedUser = item;
        this.showDeleteConfirm = true;
      },

      deleteItemConfirm() {
        this.$inertia.delete(route('admin.users.delete', this.selectedUser), {
          onSuccess: (data) => {
            this.showDeleteConfirm = false;
          }
        });
      }
    },
    components: {
      ShowCreateUser
    }

  };
</script>

<style scoped>

</style>
