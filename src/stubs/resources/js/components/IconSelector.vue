<template>
  <div>
    <v-autocomplete
      v-model="icon"
      :items="iconList"
      label="Icon"
      hide-details>
      <template #item="{ item }">
        <v-icon>{{ item }}</v-icon> {{ item }}
      </template>
    </v-autocomplete>
  </div>
</template>

<script>


  export default {
    name: 'IconSelector',
    data() {
      return {
        icon: '',
        iconList: []

      };
    }
  };
</script>

<style scoped>

</style>
