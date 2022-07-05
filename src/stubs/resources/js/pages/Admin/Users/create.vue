<template>
  <v-dialog v-model="show" max-width="500px" class="pa-3">
    <v-card>
      <form @submit.prevent="submit">
        <v-card-text>
          <v-text-field
            v-model="form.email"
            counter
            :error-messages="form.errors.email"
            label="Email"
            required/>
          <v-text-field
            v-model="form.username"
            :error-messages="form.errors.username"
            label="Username"
            required/>
          <v-text-field
            v-model="form.password"
            :error-messages="form.errors.password"
            label="Password"
            counter
            required
            :append-icon="hidepassword ? 'mdi-eye' : 'mdi-eye-off'"
            :type="hidepassword ? 'password' : 'text'"
            @click:append="() => (hidepassword = !hidepassword)"/>

          <v-select
            v-model="form.role"
            :error-messages="form.errors.password"
            :items="roles"
            label="Role"
            item-text="name"
            item-value="name"/>
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
        hidepassword: true,
        roles: [{name: 'admin'}, {name: 'user'}],
        form: this.$inertia.form({
          username: '',
          email: '',
          password: '',
          role: 'user'
        })
      };
    },
    computed: {
      show: {
        get() {
          return this.value;
        },
        set(value) {
          this.$emit('input', value);
        }
      }

    },
    methods: {
      submit() {
        this.form.post(route('admin.users.store'), {
          onSuccess: (data) => {
            this.form.reset();
            this.show = false;
          },
          onFinish: () => {}
        });
      }
    }

  };
</script>
