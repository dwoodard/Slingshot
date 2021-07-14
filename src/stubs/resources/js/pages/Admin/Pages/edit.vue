<template>
  <v-container fluid>
    <inertia-link href="/admin/pages" as="button">
      <v-icon>mdi-menu-left</v-icon>
    </inertia-link>
    <span>{{ page.title }}</span>
    <v-card>
      <v-textarea v-model="form.content" class="pa-3"/>
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
  import ActionMessage from '../../../components/ActionMessage';

  export default {
    props: ['page'],
    data() {
      return {
        form: this.$inertia.form({...this.page})
      };
    },
    methods: {
      submit() {
        this.form.post(this.route('admin.page.save'), {
          onSuccess: (data) => {
            // console.log(data);
          },
          onFinish: () => this.form.reset('password', 'password_confirmation')
        });
      }
    },
    components: {ActionMessage},
    layout: Layout

  };
</script>

<style scoped>

</style>
