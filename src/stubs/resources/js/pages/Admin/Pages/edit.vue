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
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
  import Layout from '@/layouts/Admin/Layout';

  export default {
    props: ['page'],
    layout: Layout,
    data() {
      return {
        form: this.$inertia.form({...this.page})
      };
    },
    methods: {
      submit() {
        this.form.post(this.route('admin.page.save'), {
          onSuccess: (data) => {},
          onFinish: () => this.form.reset('password', 'password_confirmation')
        });
      }
    }

  };
</script>

<style scoped>

</style>
