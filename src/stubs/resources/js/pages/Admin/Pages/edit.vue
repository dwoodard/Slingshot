<template>
  <v-container fluid>
    <v-app-bar>
      <inertia-link href="/admin/pages" as="button">
        <v-icon>mdi-menu-left</v-icon>
      </inertia-link>
      <v-toolbar-title>
        {{ page.title }} (<a target="_blank" :href="`/${page.slug}`">{{ page.slug }}</a>)
      </v-toolbar-title>
    </v-app-bar>
    <!--    <pre>{{ page }}</pre>-->
    <GrapesEditor :source="page.source" @save="onSave"/>

    <v-snackbar v-model="savedSnackBar">
      Page Saved
      <template #action="{ attrs }">
        <v-btn text v-bind="attrs" @click="savedSnackBar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </v-container>
</template>

<script>
  import Layout from '@/layouts/Admin/Layout';
  import ActionMessage from '@/components/ActionMessage';
  import GrapesEditor from '@/components/GrapesEditor';

  export default {
    props: ['page'],
    data() {
      return {
        savedSnackBar: false,
        form: this.$inertia.form({
          id: this.page.id,
          title: this.page.title,
          slug: this.page.slug,
          content: this.page.content,
          middleware: this.page.middleware,
          sort_order: this.page.sort_order,
          is_active: this.page.is_active,
          is_published: this.page.is_published
        })
      };
    },
    methods: {
      onSave(data) {
        console.log(data);
        this.savedSnackBar = true;
      },

    },
    components: {
      GrapesEditor,
      ActionMessage
    },
    layout: Layout

  };
</script>
