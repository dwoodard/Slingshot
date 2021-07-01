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
        <v-dialog
            v-model="confirmingUserDeletion"
            max-width="290"
        >
          <v-card>
            <v-card-title class="text-h5">
              Delete Account?
            </v-card-title>

            <v-card-text>
              Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn
                  color="green darken-1"
                  text
                  @click="dialog = false"
              >
                Disagree
              </v-btn>

              <v-btn
                  color="green darken-1"
                  text
                  @click="dialog = false"
              >
                Agree
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <jet-dialog-modal :show="confirmingUserDeletion" @close="closeModal">


          <template #content>


            <div class="mt-4">
              <jet-input ref="password" v-model="form.password" type="password"
                         class="mt-1 block w-3/4"
                         placeholder="Password"
                         @keyup.enter.native="deleteUser"/>

              <jet-input-error :message="form.errors.password" class="mt-2"/>
            </div>
          </template>

          <template #footer>
            <jet-secondary-button @click.native="closeModal">
              Nevermind
            </jet-secondary-button>

            <jet-danger-button class="ml-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                               @click.native="deleteUser">
              Delete Account
            </jet-danger-button>
          </template>
        </jet-dialog-modal>
      </v-card>
    </v-flex>


    <template #content>
    </template>
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

        setTimeout(() => this.$refs.password.focus(), 250);
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
