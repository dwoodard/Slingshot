<template>
  <v-expansion-panel class="sortable" :readonly="readonly" :disabled="readonly">
    <v-expansion-panel-header>
      <div>
        <span class="handle">
          <v-icon>mdi-drag-vertical</v-icon>
        </span>

        <span>
          <v-icon>{{ item.icon }}</v-icon>
        </span>

        <span>
          {{ item.title }}
        </span>
      </div>
    </v-expansion-panel-header>
    <v-expansion-panel-content>
      <v-text-field
        v-model="itemLocal.title"
        label="Title"/>

      <v-row>
        <v-col cols="12" md="6">
          <v-text-field
            v-model="itemLocal.link"
            label="Link"/>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            v-model="itemLocal.target"
            :items="[
              { text: '_self', value: '_self' },
              { text: '_blank', value: '_blank' },
              { text: '_parent', value: '_parent' },
              { text: '_top', value: '_top' },
            ]"
            label="Target"/>
        </v-col>
      </v-row>


      <v-text-field
        v-model="itemLocal.icon"
        label="Icon"/>

      <IconSelector :icon="item.icon" @icon-changed="onIconChanged"/>


      <v-checkbox
        v-model="itemLocal.hide_link"
        helper-text="Keep link in menu but hide it"
        :label="`Hide Link: ${item.hide_link.toString()}`"/>

      <v-checkbox
        v-model="itemLocal.show_icon"
        :label="`Show Icon: ${item.show_icon.toString()}`"/>
    </v-expansion-panel-content>
  </v-expansion-panel>
</template>

<script>
  import IconSelector from '@/components/IconSelector.vue';

  export default {
    name: 'MenuItems',
    props: {

      item: {
        type: Object,
        default: () => ({
          title: '',
          link: '',
          icon: '',
          hide_link: false,
          show_icon: false,
          target: '_self'
        }),

        required: true
      },

      readonly: {type: Boolean}
    },

    data() {
      return {
        itemLocal: this.item
      };
    },
    methods: {
      updateItem() {
        this.$emit('update-item', this.itemLocal);
      },
      onIconChanged(icon) {
        this.itemLocal.icon = icon;
      }


    },
    components: {
      IconSelector
    }

  };
</script>

<style scoped>

</style>
