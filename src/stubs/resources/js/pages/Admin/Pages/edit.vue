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
    <GrapesEditor @save="onSave">
      <div v-html="page.content"></div>
    </GrapesEditor>


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
      onSave(content){
        this.form.content = content

        this.submit()
      },
      submit() {
        this.form.put(this.route('admin.page.save'), {
          onSuccess: (data) => {
            // console.log(data);
          },
          onFinish: () => this.form.reset('password', 'password_confirmation')
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
