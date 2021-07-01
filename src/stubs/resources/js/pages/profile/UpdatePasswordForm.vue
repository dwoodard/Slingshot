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
              ref="password"
              v-model="form.password"
              :error-messages="form.errors.password"
              label="New Password"
              type="password"
              autocomplete="current-password"/>
          </div>

          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.password_confirmation"
              :error-messages="form.errors.password_confirmation"
              label="Confirm Password"
              type="password"
              autocomplete="new-password"/>
          </div>
          <jet-action-message :on="form.recentlySuccessful" class="mr-3">
            Saved.
          </jet-action-message>
          <v-btn type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Save
          </v-btn>
        </form>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
  import JetActionMessage from '@/vendor/Jetstream/ActionMessage';
  import JetButton from '@/vendor/Jetstream/Button';
  import JetFormSection from '@/vendor/Jetstream/FormSection';
  import JetInput from '@/vendor/Jetstream/Input';
  import JetInputError from '@/vendor/Jetstream/InputError';
  import JetLabel from '@/vendor/Jetstream/Label';

  export default {

    data() {
      return {
        form: this.$inertia.form({
          current_password: '',
          password: '',
          password_confirmation: ''
        })
      };
    },

    methods: {
      updatePassword() {
        this.form.put(route('user-password.update'), {
          errorBag: 'updatePassword',
          preserveScroll: true,
          onSuccess: () => this.form.reset(),
          onError: (errors) => {
            this.form.errors = errors;
            if (this.form.errors.password) {
              this.form.reset('password', 'password_confirmation');
              this.$refs.password.focus();
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
      JetActionMessage
    }
  };
</script>
