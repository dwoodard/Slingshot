<template>
  <v-container fluid>
    <v-card>
      <v-card-title>User Settings</v-card-title>
      <v-card-text>
        <div>
          User Settings:
          <pre>{{ userSettings }}</pre>
        </div>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
  export default {
    props: ['userSettings']
  };
</script>

<style scoped>

</style>
