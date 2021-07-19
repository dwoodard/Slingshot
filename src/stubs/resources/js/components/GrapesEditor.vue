<template>
  <v-container fluid class="pa-0">
    <div id="gjs">
      <slot></slot>
    </div>
  </v-container>
</template>

<script>
  import 'grapesjs/dist/css/grapes.min.css';
  import grapes from 'grapesjs';
  import pluginBlocks from 'grapesjs-blocks-basic';
  import pluginCustomCode from 'grapesjs-custom-code';
  import pluginCountdown from 'grapesjs-component-countdown';
  import pluginExport from 'grapesjs-plugin-export';

  export default {
    name: 'GrapesEditor',
    data() {
      return {
        editor: null
      };
    },
    methods: {
      save() {
        let html =  this.editor.getHtml()
        let css = this.editor.getCss()
        let js = this.editor.getJs()
        let content =  `${html} <style>${css}</style>`

        this.$emit('save', content)
      }
    },
    mounted() {

      this.editor = grapes.init({
        container: '#gjs',
        fromElement: true,

        storageManager: {
          id: 'gjs-', // Prefix identifier that will be used inside storing and loading
          type: 'remote',
          autosave: false,
          autoload: true, // Autoload stored data on init
          stepsBeforeSave: 1, // If autosave enabled, indicates how many changes are necessary before store method is triggered
          storeComponents: true, // Enable/Disable storing of components in JSON format
          storeStyles: true, // Enable/Disable storing of rules in JSON format
          storeHtml: true, // Enable/Disable storing of components as HTML string
          storeCss: true // Enable/Disable storing of rules as CSS string
        },

        plugins: [
          pluginCountdown,
          pluginCustomCode,
          pluginBlocks,
          pluginExport
        ],


        canvas: {
          // styles: ['https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css']
        }

      });


      this.editor.Panels.addButton('options', {
        id: 'gjs-save-btn',
        className: 'fa fa-save',
        attributes: {title: 'Save'},
        active: false,
        command: this.save
      });
    }
  };
</script>

<style lang="css" scoped>

</style>
