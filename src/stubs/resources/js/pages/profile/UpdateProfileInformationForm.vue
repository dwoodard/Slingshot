<template>
  <v-layout row wrap>
    <v-flex xs12 sm6>
      <h3>Profile Information</h3>
      <h5>Update your account's profile information and email address.</h5>
    </v-flex>
    <v-flex xs12 sm6>
      <v-card class="pa-3">
        <form @submit.prevent="updateProfileInformation">
          <!-- First Name -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.first_name"
              :error-messages="form.errors.first_name"
              label="First Name"
              autocomplete="first_name"/>
          </div>

          <!-- Last Name -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.last_name"
              :error-messages="form.errors.last_name"
              label="Last Name"
              autocomplete="last_name"/>
          </div>

          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.username"
              :error-messages="form.errors.username"
              label="Username"
              autocomplete="username"/>
          </div>

          <!-- Email -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.email"
              type="email"
              :error-messages="form.errors.email"
              label="Email"
              autocomplete="email"/>
          </div>

          <!-- Phone -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.phone"
              type="phone"
              :error-messages="form.errors.phone"
              label="phone"
              autocomplete="phone"/>
          </div>

          <!-- Address -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.address"
              type="address"
              :error-messages="form.errors.address"
              label="address"
              autocomplete="address"/>
          </div>

          <!-- City -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.city"
              type="city"
              :error-messages="form.errors.city"
              label="city"
              autocomplete="city"/>
          </div>

          <!-- State -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.state"
              type="state"
              :error-messages="form.errors.state"
              label="state"
              autocomplete="state"/>
          </div>

          <!-- Zip -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.zip"
              type="zip"
              :error-messages="form.errors.zip"
              label="zip"
              autocomplete="zip"/>
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
        form: this.$inertia.form({
          _method: 'PUT',
          username: this.$page.props.auth.user.data.username,
          first_name: this.$page.props.auth.user.data.first_name,
          last_name: this.$page.props.auth.user.data.last_name,
          email: this.$page.props.auth.user.data.email,
          phone: this.$page.props.auth.user.data.phone,
          address: this.$page.props.auth.user.data.address,
          city: this.$page.props.auth.user.data.city,
          state: this.$page.props.auth.user.data.state,
          zip: this.$page.props.auth.user.data.zip
        })
      };
    },

    methods: {
      updateProfileInformation() {
        this.form.post(route('user-profile-information.update'), {
          errorBag: 'updateProfileInformation',
          preserveScroll: true
        });
      }
    },
    components: {
      ActionMessage
    }
  };
</script>
