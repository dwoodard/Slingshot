<template>
  <v-form v-model="valid" @submit.prevent="submit">
    <div>
      <button type="submit">Submit</button>
    </div>
    <v-jsf v-model="modelLocal" :schema="schemaLocal" :options="optionsLocal"/>

    <v-card class="pa-3">
      <v-card-title>Props</v-card-title>
      <v-card-text>
        <pre>{{ $props }}</pre>
      </v-card-text>
    </v-card>

    <v-card class="pa-3">
      <v-card-title>Data</v-card-title>
      <v-card-text>
        <pre>{{ $data }}</pre>
      </v-card-text>
    </v-card>

  </v-form>
</template>
<script>


  export default {
    props: {
      schema: Object
    },
    data() {
      return {
        valid: false,
        modelLocal: this.schema.model,
        optionsLocal: {
          'context': {
            'items': [],
            'objectItems': []
          },
          'editMode': 'inline',
          'selectAll': true,
          'rootDisplay': 'expansion-panels'
        },
        schemaLocal: {
          type: 'object',
          'x-props': {
            accordion: true,
            focusable: true,
            multiple: !true,
            disable: false,
            'v-model': 'panels'
          },
          properties: {
            general: {
              title: 'General',
              // description: 'The general settings of the site',
              type: 'object',
              properties: {
                siteTitle: {
                  type: 'string',
                  title: 'Site Title',
                  description: 'The title of the site, this will be used in the browser tab',
                  default: 'Project'
                },
                defaultPage: {
                  type: 'string',
                  title: 'Default Page',
                  description: 'The default page that will be loaded when the site is loaded',
                  default: 'home'
                }
              }
            },
            layouts: {
              title: 'Layouts',
              description: 'The general settings of the site',
              type: 'object',
              properties: {
                template: {
                  type: 'string',
                  title: 'Template',
                  description: 'The template that will be used for the site',
                  examples: [
                    'default',
                    'blank',
                    'custom'
                  ],
                  default: 'default'
                }
              }
            },
            notifications: {
              title: 'Notifications',
              description: 'Notify users and admins of events',
              type: 'object',
              properties: {
                enabled: {
                  type: 'boolean',
                  title: 'Enabled',
                  description: 'Enable or disable notifications'
                },
                NotificationSendMethods: {
                  if: {
                    properties: {
                      enabled: {
                        const: true
                      }
                    }
                  },
                  type: 'array',
                  title: 'Send Methods',
                  description: 'The methods that will be used to send notifications',

                  items: {
                    type: 'string',
                    enum: [
                      'sms',
                      'email'
                    ]
                  }
                },

                smsSendMethod: {
                  required: ['smsSendMethod'],
                  type: 'string',
                  title: 'SMS Send Method',
                  if: {
                    required: [
                      'NotificationSendMethods'
                    ],
                    properties: {
                      NotificationSendMethods: {
                        enum: [
                          'sms'
                        ]
                      }

                    }

                  }
                },

                phoneNumber: {
                  'x-directives': [
                    {
                      name: 'mask',
                      value: '###-###-####'
                    }
                  ],
                  pattern: '^\\d{3}-\\d{3}-\\d{4}$',
                  type: 'string',
                  title: 'Phone Number',
                  if: {
                    required: [
                      'smsSendMethod'
                    ],
                    properties: {
                      smsSendMethod: {
                        const: 'sms'
                      }
                    }
                  }
                }
              }
            }
          }
        }
      };
    },
    methods: {
      submit() {
        console.log(this.modelLocal);
        axios.post(`/admin/schema/${this.schema.id}`, {
          _method: 'PUT',
          id: this.schema.id,
          model: this.modelLocal,
          options: this.optionsLocal,
          schema: this.schemaLocal
        });
      }
    }
  };
</script>
