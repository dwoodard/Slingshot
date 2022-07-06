<template>
  <v-container fluid>
    <!--    <pre>{{ form }}</pre>-->
    <v-app-bar>
      <inertia-link href="/admin/users" as="button">
        <v-icon>mdi-menu-left</v-icon>
      </inertia-link>
      <v-toolbar-title>{{ form.email }}</v-toolbar-title>
    </v-app-bar>

    <v-layout row wrap class="pa-3 mt-3">
      <v-flex xs12 sm6>
        <h3>User Information</h3>
        <h5>Update User's profile information and email address.</h5>
      </v-flex>
      <v-flex xs12 sm6>
        <v-card>
          <v-card-text>
            <form @submit.prevent="submit">
              <v-text-field
                v-model="form.first_name"
                dense
                :error-messages="form.errors.first_name"
                label="First name"
                required/>
              <v-text-field
                v-model="form.last_name"
                dense
                :error-messages="form.errors.last_name"
                label="Last name"
                required/>
              <v-text-field
                v-model="form.username"
                dense
                :error-messages="form.errors.username"
                label="Username"
                required/>
              <v-text-field
                v-model="form.email"
                dense
                :error-messages="form.errors.email"
                label="Email"
                required/>
              <v-text-field
                v-model="form.phone"
                dense
                :error-messages="form.errors.phone"
                label="Phone"
                counter
                required/>
              <v-text-field
                v-model="form.address"
                dense
                :error-messages="form.errors.address"
                label="Address"
                required/>
              <v-text-field
                v-model="form.city"
                dense
                :error-messages="form.errors.city"
                label="City"
                required/>
              <v-text-field
                v-model="form.state"
                dense
                :error-messages="form.errors.state"
                label="State"
                required/>
              <v-text-field
                v-model="form.zip"
                dense
                :error-messages="form.errors.zip"
                label="Zip"
                required/>
            </form>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="submit">Save</v-btn>

            <ActionMessage :on="form.recentlySuccessful" class="ml-3">
              Saved.
            </ActionMessage>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>

    <v-layout row wrap class="pa-3">
      <v-flex xs12 sm6>
        <h3>Roles</h3>
        <h5>
          Roles are used to determine what permissions a user has.
        </h5>
      </v-flex>

      <v-flex xs12 sm6>
        <v-card>
          <v-card-text>
            <v-select
              v-model="form.roles"
              chips
              clearable
              clear-icon="mdi-close"
              :error-messages="form.errors.roles"
              :items="roles"
              multiple
              label="Roles"/>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="submit">Save</v-btn>
            <ActionMessage :on="form.recentlySuccessful" class="ml-3">
              Saved Role.
            </ActionMessage>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import Layout from '@/layouts/Admin/Layout';
  import ActionMessage from '@/components/ActionMessage';

  export default {
    props: ['user'],
    data() {
      return {
        roles: ['admin', 'user'],
        form: this.$inertia.form({...this.user.data})

      };
    },
    methods: {
      submit() {
        this.form
          .transform((data) => {
            if (typeof data.roles === 'string') {
              data.roles = [data.roles];
            }
            return data;
          })
          .put(this.route('admin.users.update', this.form), {
            onSuccess: (data) => {
              // console.log(data);
            }
          });
      }
    },
    components: {ActionMessage},
    layout: Layout

  };
</script>

<style scoped>

</style>
