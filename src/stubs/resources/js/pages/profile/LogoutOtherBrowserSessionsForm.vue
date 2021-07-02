<template>
  <v-layout row wrap>
    <v-flex xs12 sm6>
      <h3>Browser Sessions</h3>
      <h5>Manage and logout your active sessions on other browsers and devices.</h5>
    </v-flex>
    <v-flex xs12 sm6>
      <v-card class="pa-3">
        <div class="max-w-xl text-sm text-gray-600">
          If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.
        </div>

        <!-- Other Browser Sessions -->
        <div v-if="sessions.length > 0" class="mt-5 space-y-6">
          <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
            <div>
              <v-icon v-if="session.agent.is_desktop">mdi-laptop</v-icon>
            </div>

            <div class="ml-3">
              <div class="text-sm text-gray-600">
                {{ session.agent.platform }} - {{ session.agent.browser }}
              </div>

              <div>
                <div class="text-xs text-gray-500">
                  {{ session.ip_address }},

                  <span v-if="session.is_current_device" class="text-green-500 font-semibold">This device</span>
                  <span v-else>Last active {{ session.last_active }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex items-center mt-5">
          <v-btn @click.native="confirmLogout">
            Logout Other Browser Sessions
          </v-btn>


          <ActionMessage :on="form.recentlySuccessful" class="ml-3">
            Done.
          </ActionMessage>
        </div>

        <!-- Logout Other Devices Confirmation Modal -->
        <v-dialog v-model="confirmingLogout" @close="closeModal">
          <template #title>
            Logout Other Browser Sessions
          </template>

          <template #content>
            Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.

            <div class="mt-4">
              <v-text-field
                  ref="current_password"
                  v-model="form.password"
                  :error-messages="form.errors.password"
                  label="Password"
                  type="password"
                  autocomplete="password"
                  @keyup.enter.native="logoutOtherBrowserSessions"/>
            </div>
          </template>

          <template #footer>
            <v-btn @click.native="closeModal">
              Nevermind
            </v-btn>

            <v-btn @click.native="logoutOtherBrowserSessions">
              Logout Other Browser Sessions
            </v-btn>
          </template>
        </v-dialog>
      </v-card>
    </v-flex>


    <template #content>
    </template>
  </v-layout>
</template>

<script>

import ActionMessage from '@/components/ActionMessage';

export default {
  props: ['sessions'],

  data() {
    return {
      confirmingLogout: false,

      form: this.$inertia.form({
        password: ''
      })
    };
  },

  methods: {
    confirmLogout() {
      this.confirmingLogout = true;

      setTimeout(() => this.$refs.password?.focus(), 250);
    },

    logoutOtherBrowserSessions() {
      this.form.delete(route('other-browser-sessions.destroy'), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onError: () => this.$refs.password.focus(),
        onFinish: () => this.form.reset()
      });
    },

    closeModal() {
      this.confirmingLogout = false;

      this.form.reset();
    }
  },

  components: {
    ActionMessage
  }
};
</script>
