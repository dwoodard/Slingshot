<template>
  <v-layout row wrap>
    <v-flex xs12 sm6>
      <h3>Delete Account</h3>
      <h6>Permanently delete your account.</h6>
    </v-flex>
    <v-flex xs12 sm6>
      <v-card class="pa-3">
        <div>
          Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </div>

        <div class="mt-5">
          <v-btn color="red" dark @click.native="confirmUserDeletion">
            Delete Account
          </v-btn>
        </div>

        <!-- Delete Account Confirmation Modal -->
        <portal to="modals">
          <v-dialog v-model="confirmingUserDeletion" @close="closeModal">
            <v-card>
              <v-card-title class="text-h5">
                Delete Account?
              </v-card-title>

              <v-card-text>
                Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.


                <v-text-field
                    ref="password"
                    v-model="form.password"
                    :error-messages="form.errors.password"
                    label="Password"
                    type="password"
                    autocomplete="password"
                    @keyup.enter.native="deleteUser"/>
              </v-card-text>

              <v-card-actions>
                <v-spacer/>

                <v-btn
                    text
                    @click.native="closeModal">
                  Nevermind
                </v-btn>

                <v-btn
                    color="green darken-1"
                    text
                    @click.native="deleteUser">
                  Delete Account
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </portal>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {

  data() {
    return {
      confirmingUserDeletion: false,

      form: this.$inertia.form({
        password: ''
      })
    };
  },

  methods: {
    confirmUserDeletion() {
      this.confirmingUserDeletion = true;

      // setTimeout(() => this.$refs.password.focus(), 250);
    },

    deleteUser() {
      this.form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onError: () => this.$refs.password.focus(),
        onFinish: () => this.form.reset()
      });
    },

    closeModal() {
      this.confirmingUserDeletion = false;

      this.form.reset();
    }
  },
  components: {

  }
};
</script>
