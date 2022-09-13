<template>
  <v-container fluid>
    <v-toolbar color="primary">
      <v-toolbar-title>Forms</v-toolbar-title>
      <v-spacer/>
      <v-tooltip bottom>
        <template #activator="{ on, attrs }">
          <v-icon v-bind="attrs"
                  v-on="on"
                  @click.stop="showCreateForm=true">
            mdi-text-box-plus
          </v-icon>
        </template>
        <span>Add Form</span>
      </v-tooltip>

      <ShowCreateForm v-model="showCreateForm" @submit="updateForms"/>
    </v-toolbar>
    <v-sheet>
      <v-row no-gutters>
        <v-col sm="12" md="2">
          <v-text-field v-model="search"
                        clearable
                        label="Search Forms"
                        append-icon="mdi-magnify"
                        class="mx-4"/>

          <v-list dense>
            <v-list-item-group v-model="selectedForm">
              <v-list-item v-for="(form, i) in formsLocalFilter" :key="i">
                <v-icon>{{ form.system ? 'mdi-shield-check' : 'mdi-text-box-outline' }}</v-icon>
                <v-list-item-title>{{ toTitleCase(form.name) }}</v-list-item-title>
              </v-list-item>
            </v-list-item-group>
          </v-list>
        </v-col>
        <v-divider vertical/>

        <v-col sm="12" md="10">
          <VjsfEditor v-if="formsLocalFilter[selectedForm]" :schema="formsLocalFilter[selectedForm]"/>
        </v-col>
      </v-row>
    </v-sheet>
  </v-container>
</template>

<script>

  import {toTitleCase} from '@/helper';
  import Admin from '@/layouts/Admin/Layout';
  import ShowCreateForm from '@/pages/Admin/Forms/create';
  import VjsfEditor from '@/components/VjsfEditor/VjsfEditor';

  export default {
    props: {
      schemas: {
        type: Array,
        default: () => []
      }
    },
    data() {
      return {
        showCreateForm: false,
        formsLocal: this.schemas,
        search: '',
        selectedForm: 0
      };
    },
    computed: {
      formsLocalFilter() {
        if (this.search === '' || this.search === null) {
          return this.formsLocal;
        }

        return this.formsLocal.filter((form) => {
          return form.name.toLowerCase().includes(this.search.toLowerCase());
        });
      }
    },
    methods: {
      toTitleCase,
      updateForms() {
        this.formsLocal = this.schemas;
      }
    },
    layout: Admin,
    components: {
      VjsfEditor,
      ShowCreateForm
    }
  };
</script>
