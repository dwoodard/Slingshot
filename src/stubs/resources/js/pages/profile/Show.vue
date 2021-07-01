<template>
  <div class="pa-3">
    <v-container>
      <div v-if="$page.props.jetstream.canUpdateProfileInformation">
        <update-profile-information-form :user="$page.props.user"/>
      </div>

      <div v-if="$page.props.jetstream.canUpdatePassword">
        <update-password-form/>
      </div>

      <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
        <two-factor-authentication-form/>
      </div>

      <logout-other-browser-sessions-form :sessions="sessions"/>

      <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
        <delete-user-form/>
      </template>
    </v-container>
  </div>
</template>

<script>
  import DeleteUserForm from './DeleteUserForm';
  import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm';
  import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm';
  import UpdatePasswordForm from './UpdatePasswordForm';
  import UpdateProfileInformationForm from './UpdateProfileInformationForm';
  import Layout from '@/layouts/Layout';

  export default {
    layout: Layout,
    props: ['sessions'],
    components: {
      DeleteUserForm,
      LogoutOtherBrowserSessionsForm,
      TwoFactorAuthenticationForm,
      UpdatePasswordForm,
      UpdateProfileInformationForm
    }
  };
</script>
