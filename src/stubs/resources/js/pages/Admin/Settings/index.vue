<template>
  <v-container fluid>
    <v-row>
      <v-col sm="12">
        <v-card>
          <v-card-title class="primary white--text text-h5">
            Site Settings
          </v-card-title>
          <v-row
            class="pa-4"
            justify="space-between">
            <v-col cols="5">
              <v-row justify="center">
                <v-expansion-panels accordion>
                  <v-expansion-panel
                    v-for="(item,i) in 5"
                    :key="i">
                    <v-expansion-panel-header>Item</v-expansion-panel-header>
                    <v-expansion-panel-content>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </v-expansion-panel-content>
                  </v-expansion-panel>
                </v-expansion-panels>
              </v-row>
            </v-col>

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
