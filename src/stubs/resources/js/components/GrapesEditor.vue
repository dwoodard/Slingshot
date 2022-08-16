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
        return source?.components == null ? {} : JSON.parse(source?.components);
      },
      styles() {
        const source = JSON.parse(this.source);
        return source?.styles ? JSON.parse(source.styles) : '';
      }
    },
    methods: {
      save(data) {
        this.$emit('save', data);
      }
    },
    mounted() {
      this.editor = grapes.init({
        container: '#gjs',
        fromElement: false,

        commands: {
          defaults: [
            {
              id: 'undo',
              run(editor, sender) {
                sender.set('active', false);
                editor.UndoManager.undo(1);
              }
            },
            {
              id: 'redo',
              run(editor, sender) {
                sender.set('active', false);
                editor.UndoManager.redo(1);
              }
            },
            {
              id: 'clean-all',
              run(editor, sender) {
                sender.set('active', false);
                if (confirm('Are you sure to clean the canvas?')) {
                  const comps = editor.DomComponents.clear();
                }
              }
            },
            {
              id: 'save',
              run(editor, senderBtn) {
                sender.set('active', false);
                saveHtmlToList(editor);
              },
              stop(editor, senderBtn) {}
            }
          ]
        },

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

      const pnm = this.editor.Panels;
      pnm.addButton('options', [
        {
          id: 'undo',
          className: 'fa fa-undo icon-undo',
          command: function command(editor, sender) {
            sender.set('active', 0);
            editor.UndoManager.undo(1);
          },
          attributes: {
            title: 'Undo (CTRL/CMD + Z)'
          }
        },
        {
          id: 'redo',
          className: 'fa fa-repeat icon-redo',
          command: function command(editor, sender) {
            sender.set('active', 0);
            editor.UndoManager.redo(1);
          },
          attributes: {
            title: 'Redo (CTRL/CMD + Y)'
          }
        }
      ]);

      this.editor.setComponents(this.components || {});
      this.editor.setStyle(this.styles);

      this.editor.on('storage:start:store', (objectToStore) => {
        this.save(objectToStore);
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
