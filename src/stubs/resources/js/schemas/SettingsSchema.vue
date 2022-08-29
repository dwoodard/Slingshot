<template>
  <v-form v-model="valid" @submit.prevent="submit">
    <v-toolbar color="primary" class="d-flex justify-end">
      <v-btn type="submit">Save</v-btn>
    </v-toolbar>

    <v-jsf v-model="modelLocal" :schema="schemaLocal" :options="optionsLocal"/>
    <v-snackbar v-model="snackbar" :timeout="1000" bottom>
      {{ snackbarMessage }}
    </v-snackbar>
  </v-form>
</template>
<script>
  import axios from 'axios';

  export default {
    props: {
      schema: {
        type: Object,
        required: true
      }

    },
    data() {
      return {
        snackbar: false,
        snackbarMessage: '',

        valid: false,
        modelLocal: this.schema.model,
        optionsLocal: this.schema.options,
        schemaLocal: this.schema.schema
      };
    },
    methods: {
      submit() {
        axios.post(`/admin/schema/${this.schema.id}`, {
          _method: 'PUT',
          id: this.schema.id,
          model: this.modelLocal,
          options: this.optionsLocal,
          schema: this.schemaLocal
        })
          .then((response) => {
            this.snackbar = true;
            this.snackbarMessage = 'Settings saved';
          });
      }
    }
  };
</script>
