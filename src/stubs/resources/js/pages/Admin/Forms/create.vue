<template>
  <v-dialog v-model="show" max-width="500px" class="pa-3">
    <v-card>
      <form @submit.prevent="submit">
        <v-card-title class="text-h5">
          Add Form
        </v-card-title>
        <v-card-text>
          <v-checkbox
            v-if="hasPermission"
            v-model="form.system" label="System"/>
          <v-text-field
            v-model="form.name"
            :error-messages="form.errors.name"
            label="Name"
            required/>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" text @click.stop="show=false">Close</v-btn>
          <v-spacer/>
          <v-btn type="submit" color="primary">Create</v-btn>
        </v-card-actions>
      </form>
    </v-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      value: Boolean
    },
    data() {
      return {
        form: this.$inertia.form({
          name: '',
          system: false,
          model: {},
          options: {},
          schema: {}
        })
      };
    },
    computed: {
      hasPermission() {
        return this.$page.props.auth.user.data.roles.includes('superadmin');
      },
      show: {
        get() {
          return this.value;
        },
        set(value) {
          this.$emit('input', value);
        }
      },
      title() {
        return this.form.title;
      }
    },
    methods: {
      submit() {
        this.form
          .post(`/admin/schemas`, {
            onSuccess: (response) => {
              console.log('forms create', response);
              this.$emit('submit', response.data);
              this.form.reset();
              this.show = false;
            },
            onFinish: () => {}
          });
      }
    }

  };
</script>
