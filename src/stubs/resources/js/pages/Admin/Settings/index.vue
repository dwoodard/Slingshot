<template>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title class="primary white--text text-h5">
            Site Settings
          </v-card-title>
          <v-row
            class="pa-4"
            justify="space-between">
            <v-col cols="5"/>

            <v-divider vertical/>

            <v-col
              class="d-flex text-center">
              <v-scroll-y-transition mode="out-in">
                <pre class="text-left">{{ settingsLocal }}</pre>
              </v-scroll-y-transition>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import JsonEditor from 'vue-json-edit';
  import Vue from 'vue';
  import Admin from '@/layouts/Admin/Layout';

  Vue.use(JsonEditor);

  export default {
    layout: Admin,
    props: ['settings'],
    data() {
      return {
        settingsLocal: this.settings
      };
    },
    methods: {
      onSave() {

      },
      onJsonChange(json) {
        this.settingsLocal = json;
      }
    },

    components: {

    }

  };
</script>

<style scoped>

</style>
