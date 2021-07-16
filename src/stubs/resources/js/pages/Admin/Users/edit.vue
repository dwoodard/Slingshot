<template>
  <v-container fluid>
    <pre>{{ user }}</pre>

    <inertia-link href="/admin/users" as="button">
      <v-icon>mdi-menu-left</v-icon>
    </inertia-link>
    <span>{{ user.email }}</span>
    <v-card>
      <v-text-field
        v-model="form.id"
        :error-messages="form.errors.id"
        label="Id"
        required/>

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
        form: this.$inertia.form({...this.user})
      };
    },
    methods: {
      submit() {
        this.form.put(this.route('admin.users.save'), {
          onSuccess: (data) => {
            // console.log(data);
          },
          onFinish: () => this.form.reset()
        });
      }
    },
    components: {ActionMessage},
    layout: Layout

  };
</script>

<style scoped>

</style>
