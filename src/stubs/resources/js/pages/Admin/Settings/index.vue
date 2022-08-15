<template>
  <v-container fluid>
    <v-row>
      <v-col sm="12">
        <v-card>
          <v-card-title class="primary white--text text-h5">
            Site Settings
          </v-card-title>

          <v-row class="pa-4">
            <v-col sm="12" md="6">
              <SettingsSchema :schema="schema"/>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>


  import Admin from "@/layouts/Admin/Layout";
  import SettingsSchema from "@/schemas/SettingsSchema";


  export default {
    "components": {SettingsSchema},
    "layout": Admin,
    props: {
      schema: Object,
    },
  };
</script>
