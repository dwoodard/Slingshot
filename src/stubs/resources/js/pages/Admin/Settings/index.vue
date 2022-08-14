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
            <v-col sm="12" md="6">
              <v-row justify="center">
                <v-expansion-panels accordion>
                  <v-expansion-panel v-for="(group, index) in Object.keys(settingsLocal)" :key="index">
                    <v-expansion-panel-header>{{ group }}</v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <v-row>
                        <v-col cols="12">
                          <keep-alive v-for="(setting, index) in settingsLocal[group]" :key="index">
                            <component
                              :is="typeMap(setting).tag"
                              v-model="setting.value"
                              v-bind="typeMap(setting).attributes"
                              @input.native="typeMap(setting).attributes.input"
                              @click.native="typeMap(setting).attributes.click"/>
                          </keep-alive>
                        </v-col>
                      </v-row>
                    </v-expansion-panel-content>
                  </v-expansion-panel>
                </v-expansion-panels>
              </v-row>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>

    <!--    <JsonEditor :obj-data="settingsLocal" :json="settingsLocal" @update="updateSettingsLocal"/>-->
  </v-container>
</template>

<script>
  import JsonEditor from 'vue-json-edit';
  import Vue from 'vue';
  import axios from 'axios';
  import Admin from '@/layouts/Admin/Layout';
  import TypeInput from '@/components/TypeInput';

  Vue.use(JsonEditor);

  export default {
    layout: Admin,
    props: ['siteSettings'],
    data() {
      return {
        settingsLocal: this.siteSettings
      };
    },
    methods: {
      typeMap(setting) {
        switch (setting.type) {
          case 'bool':
            return {
              tag: 'v-switch',
              attributes: {
                label: setting.name,
                input(value) {
                  this.updateSetting(setting);
                },
                click() {
                  this.updateSettings(setting);
                }
              }
            };
          default: // text
            return {
              tag: 'v-text-field',
              attributes: {
                label: setting.name.toTitleCase().underscoreToSpaces(),
                hint: 'Enter text',
                input(value) {
                  this.updateSetting(setting);
                },
                click() {
                  this.updateSettings(setting);
                }
              }

            };
        }
      },
      valueMap(type, value) {
        switch (type) {
          case 'json':
            return JSON.parse(value);
          default:
            return value;
        }
      },
      updateSetting(siteSetting) {
        console.log(siteSetting);
        axios.post(`/admin/site-settings/${siteSetting.id}`, {
          _method: 'PUT',
          siteSetting
        });
      },
      updateSettingsLocal(json) {
        this.settingsLocal = json;
      },
      onSave() {

      },
      onJsonChange(json) {
        this.settingsLocal = json;
      }
    },
    beforeMount() {
      // eslint-disable-next-line no-extend-native
      String.prototype.toTitleCase = function () {
        return this.split(' ')
          .map((word) => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
          .join(' ');
      };

      // eslint-disable-next-line no-extend-native
      String.prototype.underscoreToSpaces = function () {
        return this.replace(/_/g, ' ');
      };
    },

    components: {
      TypeInput
    }

  };
</script>

<style scoped>

</style>
