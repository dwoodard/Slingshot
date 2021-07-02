<template>
  <v-layout row wrap class="mt-10">
    <v-flex xs12 sm6>
      <h3>Update Password</h3>
      <h5>Ensure your account is using a long, random password to stay secure.</h5>
    </v-flex>

    <v-flex xs12 sm6>
      <v-card class="pa-3">
        <form @submit.prevent="updatePassword">
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
                ref="current_password"
                v-model="form.current_password"
                :error-messages="form.errors.current_password"
                label="Current Password"
                type="password"
                autocomplete="current-password"/>
          </div>

          <div class="col-span-6 sm:col-span-4">
            <v-text-field
                v-model="form.password"
                :error-messages="form.errors.password"
                label="password"
                required
                autocomplete="password"
                :append-icon="hidepassword ? 'mdi-eye' : 'mdi-eye-off'"
                :type="hidepassword ? 'password' : 'text'"
                @click:append="() => (hidepassword = !hidepassword)"/>
          </div>

          <div class="col-span-6 sm:col-span-4">
            <v-text-field
                v-model="form.password_confirmation"
                :error-messages="form.errors.password_confirmation"
                :append-icon="(form.password === form.password_confirmation) ? 'mdi-check-circle' : 'mdi-alert-circle-outline'"
                label="Confirm Password"
                :type="hidepassword ? 'password' : 'text'"
                required
                autocomplete="new-password"/>
          </div>

          <v-btn type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Save
          </v-btn>

          <ActionMessage :on="form.recentlySuccessful" class="mr-3">
            Saved.
          </ActionMessage>
        </form>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import ActionMessage from '@/components/ActionMessage';

export default {

  data() {
    return {
      hidepassword: true,
      form: this.$inertia.form({
        current_password: '',
        password: '',
        password_confirmation: ''
      })
    };
  },

  methods: {
    updatePassword() {
      this.form.put(route('password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => this.form.reset(),
        onError: (errors) => {
          this.form.errors = errors;
          if (this.form.errors.password) {
            this.form.reset('password', 'password_confirmation');
          }

          if (this.form.errors.current_password) {
            this.form.reset('current_password');
            this.$refs.current_password.focus();
          }
        }
      });
    }
  },
  components: {
    ActionMessage
  }
};
</script>
