<template>
  <v-container fluid>
    <div>
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-header>
            <template>
              <div>
                <span>
                  <inertia-link href="/admin/pages" as="button">
                    <v-icon>mdi-backburger</v-icon>
                  </inertia-link>
                </span>
                <span>{{ page.title }}</span>


                <span>


                  <a target="blank" :href="`/${page.link}`" class="text-decoration-none">
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
            <!--            <pre>{{ page }}</pre>-->

            <v-tabs v-model="pageTab">
              <v-tab>
                <span>Meta</span>
              </v-tab>
              <v-tab>
                <span>SEO</span>
              </v-tab>
            </v-tabs>


            <v-tabs-items v-model="pageTab">
              <v-tab-item title="Meta" class="mt-3">
                <v-row>
                  <v-col md="6">
                    <v-text-field
                      v-model="form.title"
                      label="Title"/>
                  </v-col>
                  <v-col md="6">
                    <v-text-field
                      v-model="form.link"
                      label="Link"/>
                  </v-col>
                </v-row>
              </v-tab-item>
              <v-tab-item title="SEO">
                <v-row>
                  <v-col>
                    SEO
                  </v-col>
                </v-row>
              </v-tab-item>
            </v-tabs-items>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </div>


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
        pageTab: null,
        form: this.$inertia.form({
          id: this.page.id,
          title: this.page?.title,
          link: this.page.link,
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
