<template>
  <v-layout row wrap>
    <v-flex xs12 sm6>
      <h3>Profile Information</h3>
      <h5>Update your account's profile information and email address.</h5>
    </v-flex>
    <v-flex xs12 sm6>
      <v-card class="pa-3">
        <form @submit.prevent="updateProfileInformation">
          <!-- Profile Photo -->
          <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
            <h3>Photo</h3>
            <!-- Profile Photo File Input -->
            <v-file-input ref="photo" :error-messages="form.errors.photo" class="d-none" @change="updatePhotoPreview"/>

            <!-- Current Profile Photo -->
            <div v-show="! photoPreview" class="mt-2 d-inline-block">
              <UiAvatar class="rounded-full h-20 w-20 object-cover" :name="user.name"/>
            </div>

            <!-- New Profile Photo Preview -->
            <div v-show="photoPreview" class="mt-2 d-inline-block">
              <span class="block rounded-full w-20 h-20"
                    :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
              </span>
            </div>
            <v-btn class="mt-2 mr-2 d-inline-block" type="button" @click.native.prevent="selectNewPhoto">
              Select A New Photo
            </v-btn>


            <v-btn v-if="user.profile_photo_path" type="button" class="mt-2"
                   @click.native.prevent="deletePhoto">
              Remove Photo
            </v-btn>

            <jet-input-error :message="form.errors.photo" class="mt-2"/>
          </div>

          <!-- Name -->
          <div class="col-span-6 sm:col-span-4">
            <v-text-field
              v-model="form.name"
              :error-messages="form.errors.name"
              label="Name"
              autocomplete="name"/>
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
              required
              type="zip"
              :error-messages="form.errors.zip"
              label="zip"
              autocomplete="zip"/>
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
  import JetButton from '@/vendor/Jetstream/Button';
  import JetFormSection from '@/vendor/Jetstream/FormSection';
  import JetInput from '@/vendor/Jetstream/Input';
  import JetInputError from '@/vendor/Jetstream/InputError';
  import JetLabel from '@/vendor/Jetstream/Label';
  import JetSecondaryButton from '@/vendor/Jetstream/SecondaryButton';
  import UiAvatar from '@/components/UiAvatar';

  export default {

    props: ['user'],

    data() {
      return {
        form: this.$inertia.form({
          _method: 'PUT',
          username: this.user.username,
          name: this.user.name,
          email: this.user.email,
          phone: this.user.phone,
          address: this.user.address,
          city: this.user.city,
          state: this.user.state,
          zip: this.user.zip,
          photo: null
        }),

        photoPreview: null
      };
    },

    methods: {
      updateProfileInformation() {
        if (this.$refs.photo) {
          this.form.photo = this.$refs.photo.files?.[0];
        }

        this.form.post(route('user-profile-information.update'), {
          errorBag: 'updateProfileInformation',
          preserveScroll: true
        });
      },

      selectNewPhoto() {
        this.$refs.photo.click();
      },

      updatePhotoPreview() {
        const reader = new FileReader();

        reader.onload = (e) => {
          this.photoPreview = e.target.result;
        };
        debugger;
        reader.readAsDataURL(this.$refs.photo.files[0]);
      },

      deletePhoto() {
        this.$inertia.delete(this.route('current-user-photo.destroy'), {
          preserveScroll: true,
          onSuccess: () => (this.photoPreview = null)
        });
      }
    },
    components: {
      UiAvatar
    }
  };
</script>
