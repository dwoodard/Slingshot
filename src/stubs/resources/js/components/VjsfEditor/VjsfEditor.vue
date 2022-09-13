<template>
  <v-container fluid>
    <v-toolbar color="primary" class="mb-3">
      <v-toolbar-title>{{ schemaName }}</v-toolbar-title>
      <v-spacer/>
      <v-tooltip bottom>
        <template #activator="{ on, attrs }">
          <v-icon v-bind="attrs"
                  v-on="on"
                  @click.stop="saveForm">
            mdi-content-save
          </v-icon>
        </template>
        <span>Save Form</span>
      </v-tooltip>
    </v-toolbar>

    <v-row no-gutters>
      <v-col sm="6">
        <v-tabs v-model="selectedTab" grow>
          <v-tab>Schema</v-tab>
          <v-tab>Options</v-tab>

          <v-tab-item>
            <editor
              v-model="schemaLocal"
              highlight-active-line
              lang="javascript"
              theme="monokai"
              height="600"
              @input="updateEditor"
              @init="editorInit"/>
          </v-tab-item>

          <v-tab-item>
            <editor
              v-model="optionsLocal"
              lang="javascript"
              theme="monokai"
              height="600"
              @input="updateEditor"
              @init="editorInit"/>
          </v-tab-item>
        </v-tabs>
      </v-col>
      <v-col sm="6">
        <v-tabs>
          <v-tab>preview</v-tab>


          <v-tab-item>
            <v-card outlined>
              <v-card-title>
                Preview
              </v-card-title>
              <v-card-text>
                <v-form v-if="schemaLocalParsed && optionsLocalParsed" v-model="valid">
                  <v-jsf v-model="nullModel" :schema="schemaLocalParsed" :options="optionsLocalParsed"/>
                </v-form>
              </v-card-text>
            </v-card>

            <details>
              <summary>
                <span>Model</span>
              </summary>
              <pre>{{ JSON.stringify(nullModel, null, 2) }}</pre>
            </details>
          </v-tab-item>
        </v-tabs>
      </v-col>
    </v-row>

    <v-snackbar v-model="snackbar" :timeout="1000">
      {{ snackbarMessage }}
      <template #action="{ attrs }">
        <v-btn text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </v-container>
</template>
<script>
  import axios from 'axios';
  import {isValidJson} from '@/helper';

  export default {
    props: {
      schema: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        selectedTab: null,
        valid: false,

        schemaLocal: JSON.stringify(this.schema.schema, null, 2),
        optionsLocal: JSON.stringify(this.schema.options, null, 2),
        nullModel: {},
        snackbar: false,
        snackbarMessage: ''
      };
    },
    computed: {
      schemaName() {
        return this.schema.name;
      },
      schemaLocalParsed() {
        return JSON.parse(this.schemaLocal);
      },
      optionsLocalParsed() {
        return JSON.parse(this.optionsLocal);
      }
    },
    methods: {
      isValidJson,
      editorInit() {
        // eslint-disable-next-line global-require,import/no-extraneous-dependencies
        require('brace/ext/language_tools');
        // eslint-disable-next-line global-require,import/no-extraneous-dependencies
        // eslint-disable-next-line global-require,import/no-extraneous-dependencies
        require('brace/mode/javascript');
        // eslint-disable-next-line global-require,import/no-extraneous-dependencies
        require('brace/mode/less');
        // eslint-disable-next-line global-require,import/no-extraneous-dependencies
        require('brace/theme/monokai');
        // eslint-disable-next-line global-require,import/no-extraneous-dependencies
        require('brace/snippets/javascript');
      },
      saveForm() {
        // format schema and options as JSON with pretty print
        this.formatJson();

        axios
          .post(`/admin/schemas/${this.schema.id}`, {
            _method: 'PUT',
            id: this.schema.id,
            model: null,
            schema: JSON.parse(this.schemaLocal),
            options: JSON.parse(this.optionsLocal)
          })
          .then((response) => {
            this.snackbar = true;
            this.snackbarMessage = 'Schema saved';
          });
      },
      formatJson() {
        if (isValidJson(this.schemaLocal)) {
          this.schemaLocal = JSON.stringify(JSON.parse(this.schemaLocal), null, 2);
        }
        if (isValidJson(this.optionsLocal)) {
          this.optionsLocal = JSON.stringify(JSON.parse(this.optionsLocal), null, 2);
        }
      },
      updateEditor(value) {
        this.formatJson();
        this.valid = isValidJson(this.schemaLocal) && isValidJson(this.optionsLocal);
      }

    },
    watch: {
      schema(newVal, oldVal) {
        if (!newVal.schema) {
          return;
        }

        this.schemaLocal = JSON.stringify(newVal.schema, null, 2) || {};
        this.optionsLocal = JSON.stringify(newVal.options, null, 2) || {};
      }
    },
    components: {
      // eslint-disable-next-line global-require
      editor: require('vue2-ace-editor')
    }
  };
</script>
