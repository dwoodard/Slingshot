<template>
  <div class="bg-white overflow-hidden shadow rounded-lg p-2">
    <div class="px-4 py-5 sm:p-6">
      <h1>Login</h1>
      <form @submit.prevent="submit">
        <v-text-field
            v-model="form.email"
            :error-messages="form.errors.email"
            label="Username/Email"
            required
            autofocus
            autocomplete=""/>
        <v-text-field
            v-model="form.password"
            :error-messages="form.errors.password"
            label="Password"
            required
            autocomplete="current-password"
            :append-icon="hidePassword ? 'mdi-eye' : 'mdi-eye-off'"
            :type="hidePassword ? 'password' : 'text'"
            @click:append="() => (hidePassword = !hidePassword)"/>
        <v-btn color="secondary" type="submit" block>
          Login
        </v-btn>
      </form>
    </div>

    <hr/>

    <div class="px-4 py-5 sm:p-6">
      <v-btn block color="primary" @click="showRegister = !showRegister">
        Create Account
      </v-btn>

      <portal to="modals">
        <v-dialog
            v-model="showRegister">
          <Register/>
        </v-dialog>
      </portal>
    </div>
  </div>
</template>

<script>
import Register from '@/components/Register';

export default {
  props: {},
  data() {
    return {
      showRegister: false,
      hidePassword: true,
      form: this.$inertia.form({
        email: '',
        password: ''
      })
    };
  },
  methods: {
    showModal() {
      this.showRegister = true;
    },
    closeModal() {
      this.showRegister = false;
    },
    submit() {
      this.form
          .transform((data) => ({
            ...data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(route('login'), {
            onFinish: () => {
              this.form.reset('password');
            }
          });
    }
  },
  components: {
    Register
  }
};
</script>

<style scoped>

</style>
