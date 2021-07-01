<template>
  <v-card>
    <v-card-title>Register</v-card-title>
    <v-card-text>
      <form @submit.prevent="submit">
        <v-text-field
          v-model="form.username"
          :error-messages="form.errors.username"
          label="Username"
          required
          autofocus
          autocomplete="username"/>


        <v-text-field
          v-model="form.email"
          type="email"
          :error-messages="form.errors.email"
          label="email"
          required
          autocomplete="email"/>


        <v-text-field
          v-model="form.password"
          :error-messages="form.errors.password"
          label="password"
          required
          autocomplete="password"
          :append-icon="hidepassword ? 'mdi-eye' : 'mdi-eye-off'"
          :type="hidepassword ? 'password' : 'text'"
          @click:append="() => (hidepassword = !hidepassword)"/>


        <v-text-field
          v-model="form.password_confirmation"
          :error-messages="form.errors.password_confirmation"
          :append-icon="(form.password === form.password_confirmation) ? 'mdi-check-circle' : 'mdi-alert-circle-outline'"
          label="Confirm Password"
          :type="hidepassword ? 'password' : 'text'"
          required
          autocomplete="new-password"/>

        <v-text-field
          v-model="form.zip"
          v-mask="'#####'"
          type="number"
          :error-messages="form.errors.zip"
          label="Zip"
          required
          style="-webkit-appearance: none; margin: 0;"/>

        <div class="flex items-center">
          <v-checkbox v-model="form.terms" required>
            <template v-slot:label>
              <div class="ml-2">
                I agree to the <a target="_blank" :href="route('terms.show')"
                                  class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and
                <a target="_blank" :href="route('policy.show')"
                   class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
              </div>
            </template>
          </v-checkbox>
        </div>

        <div class="flex items-center justify-between mt-4">
          <div>
            <v-btn type="submit">Register</v-btn>
          </div>
        </div>
      </form>
    </v-card-text>
  </v-card>
</template>

<script>


  export default {
    data() {
      return {
        hidepassword: true,
        form: this.$inertia.form({
          username: '',
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
          zip: '',
          remember: false,
          terms: false
        })
      };
    },
    methods: {
      submit() {
        this.form.name = this.form.username;

        this.form.post(this.route('register'), {
          onSuccess: (data) => {},
          onFinish: () => this.form.reset('password', 'password_confirmation')
        });
      }
    }
  };
</script>

<style scoped>

</style>
