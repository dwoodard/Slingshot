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
    props: ['source'],
    data() {
      return {
        editor: null
      };
    },
    computed: {
      components() {
        const source = JSON.parse(this.source);
        return source.components ? JSON.parse(source.components) : '';
      },
      styles() {
        const source = JSON.parse(this.source);
        return source.styles ? JSON.parse(source.styles) : '';
      }
    },
    methods: {
      save() {
        this.$emit('save', this.editor);
      }
    },
    mounted() {
      this.editor = grapes.init({
        container: '#gjs',
        fromElement: false,

        storageManager: {
          id: '', // Prefix identifier that will be used inside storing and loading
          type: 'remote',
          autosave: true,
          autoload: true, // Autoload stored data on init

          stepsBeforeSave: 1, // If autosave enabled, indicates how many changes are necessary before store method is triggered
          storeComponents: true, // Enable/Disable storing of components in JSON format
          storeStyles: true, // Enable/Disable storing of rules in JSON format
          storeHtml: true, // Enable/Disable storing of components as HTML string
          storeCss: true, // Enable/Disable storing of rules as CSS string
          params: {
            _token: this.$page.props.token
          }


        },

        plugins: [
          pluginCountdown,
          pluginCustomCode,
          pluginBlocks,
          pluginExport
        ]


      });

      this.editor.setComponents(this.components);
      this.editor.setStyle(this.styles);

      this.editor.on('storage:start:store', (objectToStore) => {
        console.log('storage:start:store');
        console.log(objectToStore);
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
