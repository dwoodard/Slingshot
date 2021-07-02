<template>
  <div class="pa-3">
    <v-container>
      <UpdateProfileInformationForm :user="$page.props.auth.user"/>

      <UpdatePasswordForm/>

      <DeleteUserForm/>
    </v-container>
  </div>
</template>

<script>
import Layout from '@/layouts/Layout';
import DeleteUserForm from './DeleteUserForm';
import UpdatePasswordForm from './UpdatePasswordForm';
import UpdateProfileInformationForm from './UpdateProfileInformationForm';

export default {
  layout: Layout,
  components: {
    DeleteUserForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm
  }
};
</script>
