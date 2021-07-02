<template>
  <div class="pa-3">
    <v-container>
      <UpdateProfileInformationForm :user="$page.props.auth.user"/>

      <UpdatePasswordForm/>

      <LogoutOtherBrowserSessionsForm :sessions="sessions"/>

      <DeleteUserForm/>
    </v-container>
  </div>
</template>

<script>
import Layout from '@/layouts/Layout';
import DeleteUserForm from './DeleteUserForm';
import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm';
import UpdatePasswordForm from './UpdatePasswordForm';
import UpdateProfileInformationForm from './UpdateProfileInformationForm';

export default {
  layout: Layout,
  props: ['sessions'],
  components: {
    DeleteUserForm,
    LogoutOtherBrowserSessionsForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm
  }
};
</script>
