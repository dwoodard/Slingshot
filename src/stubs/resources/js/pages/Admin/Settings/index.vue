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
                <v-form v-model="valid">
                  <v-jsf v-model="model" :schema="schema" :options="options"/>
                </v-form>
              </v-row>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <pre>{{ model }}</pre>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>


  import Admin from '@/layouts/Admin/Layout';


  export default {
    layout: Admin,
    props: ['siteSettings'],
    data() {
      return {
        valid: false,
        model: {},
        options: {
          editMode: 'inline'
        },
        schema: {
          type: 'object',
          required: [
            'requiredStringProp'
          ],
          properties: {
            requiredStringProp: {
              type: 'string',
              title: "I'm a required string"
            },
            patternStringProp: {
              type: 'string',
              title: "I'm a string with a pattern (letters only)",
              pattern: '^[a-zA-Z]*$',
              examples: [
                'valid',
                'not-valid',
                'something-else'
              ],
              'x-options': {
                messages: {
                  pattern: 'Only letters are accepted'
                }
              }
            },
            ruleStringProp: {
              type: 'number',
              title: "I'm a number with a custom rule (even numbers only)",
              'x-rules': [
                'even'
              ]
            },
            limitedInteger: {
              type: 'integer',
              title: "I'm a integer with min/max value and bad initial value",
              minimum: 0,
              maximum: 100
            },
            limitedString: {
              type: 'string',
              title: "I'm a string with min/max length and bad initial value",
              minLength: 10,
              maxLength: 100
            },
            limitedArray: {
              type: 'array',
              title: "I'm an array with min/max items",
              items: {
                type: 'string'
              },
              minItems: 1,
              maxItems: 100
            },
            patternStringArray: {
              type: 'array',
              title: "I'm an array whose items have a pattern",
              items: {
                type: 'string',
                pattern: '^[a-zA-Z]*$',
                'x-options': {
                  messages: {
                    pattern: 'Only letters are accepted'
                  }
                }
              }
            },
            limitedObjectsArray: {
              type: 'array',
              title: "I'm an array of objects with min/max items",
              items: {
                type: 'object',
                properties: {
                  stringProp: {
                    type: 'string'
                  }
                }
              },
              minItems: 2,
              maxItems: 100
            }
          }
        }
      };
    }


  };
</script>

<style scoped>

</style>
