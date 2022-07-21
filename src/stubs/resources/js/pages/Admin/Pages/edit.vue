<template>
  <v-container fluid>
    <v-expansion-panels>
      <v-expansion-panel>
        <v-expansion-panel-header>
          <template>
            <div>
              <span>
                <inertia-link href="/admin/pages" as="button">
                  <v-icon>mdi-menu-left</v-icon>
                </inertia-link>
              </span>
              <span>{{ page.title }}</span>


              <span>
                <a target="blank" :href="`/${page.id}`" class="text-decoration-none">
                  <v-icon>mdi-open-in-new</v-icon>
                </a>
              </span>
            </div>
          </template>
          <template #actions>
            <v-icon>mdi-pencil</v-icon>
          </template>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <pre>{{ page }}</pre>

          <v-text-field
            v-model="page.title"
            label="Title"/>
          <v-text-field
            v-model="page.slug"
            label="Slug"/>
          <v-text-field
            v-model="page.meta_title"
            label="Meta Title"/>
          <v-text-field
            v-model="page.meta_description"
            label="Meta Description"/>
          <v-text-field
            v-model="page.meta_keywords"
            label="Meta Keywords"/>
          <v-text-field
            v-model="page.content"
            label="Content"/>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>


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
          title: this.page?.title,
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
      onSave(content) {
        this.form.content = content;
        this.submit();
        this.savedSnackBar = true;
      },
      submit() {
        console.log(this.form);
        this.form.put(`/admin/pages/${this.form.id}`, {

          onSuccess: (data) => {
            console.log(`submit${data}`);
          },
          onFinish: () => this.form.reset()
        });
      }
    },
    components: {
      GrapesEditor,
      ActionMessage
    },
    layout: Layout

  };
</script>
