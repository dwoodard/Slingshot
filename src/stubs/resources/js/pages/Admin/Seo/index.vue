<template>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title class="primary white--text text-h5">
            SEO Builder
          </v-card-title>

          <v-card-text>
            <v-row>
              <v-col>
                <v-tabs v-model="seotab">
                  <v-tabs-slider color="primary"/>
                  <v-tab item-value="home">
                    <v-icon>mdi-key</v-icon>
                    Keywords
                  </v-tab>
                  <v-tab item-value="about">
                    <v-icon>mdi-image</v-icon>
                    Images
                  </v-tab>
                </v-tabs>
              </v-col>
            </v-row>

            <v-tabs-items v-model="seotab">
              <v-tab-item>
                <v-card flat>
                  test1
                </v-card>
              </v-tab-item>
              <v-tab-item>
                <v-card flat>
                  test2
                </v-card>
              </v-tab-item>
            </v-tabs-items>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import Admin from '@/layouts/Admin/Layout';

  export default {
    layout: Admin,
    props: {
      menus: {
        type: Array
      },
      pages: {
        type: Array
      }
    },
    data() {
      return {
        seotab: null

      };
    },
    computed: {

    },
    methods: {},
    components: {}
  };
</script>

<style scoped>

</style>
