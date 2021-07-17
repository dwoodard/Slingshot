<template>
  <v-container fluid>
    <!--    <pre>{{ form }}</pre>-->

    <v-app-bar>
      <inertia-link href="/admin/users" as="button">
        <v-icon>mdi-menu-left</v-icon>
      </inertia-link>
      <v-toolbar-title>{{ form.email }}</v-toolbar-title>
    </v-app-bar>

    <v-card class="pa-4">
      <v-card-text>
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
      </v-card-text>


      <v-card-actions>
        <v-btn @click="submit">Save</v-btn>

        <ActionMessage :on="form.recentlySuccessful" class="ml-3">
          Saved.
        </ActionMessage>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
  import Layout from '@/layouts/Admin/Layout';
  import ActionMessage from '@/components/ActionMessage';

  export default {
    props: ['user'],
    data() {
      return {
        form: this.$inertia.form({...this.user.data})
      };
    },
    methods: {
      submit() {
        this.form.put(this.route('admin.users.save'), {
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
