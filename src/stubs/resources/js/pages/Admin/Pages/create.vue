<template>
  <v-dialog v-model="show" max-width="500px" class="pa-3">
    <v-card>
      <form @submit.prevent="submit">
        <v-card-text>
          <v-text-field
            v-model="form.title"
            :error-messages="form.errors.title"
            label="Title"
            required/>
          <v-text-field
            v-model="form.link"
            :error-messages="form.errors.link"
            label="Link"
            required/>
        </v-card-text>

        <v-card-actions>
          <v-btn color="primary" text @click.stop="show=false">Close</v-btn>
          <v-spacer/>
          <v-btn type="submit" color="primary">Create</v-btn>
        </v-card-actions>
      </form>
    </v-card>
  </v-dialog>
</template>

<script>
  import {toKebabCase} from '@/helper';

  export default {
    props: {
      value: Boolean
    },
    data() {
      return {
        form: this.$inertia.form({
          title: '',
          link: ''
        })
      };
    },
    computed: {
      show: {
        get() {
          return this.value;
        },
        set(value) {
          this.$emit('input', value);
        }
      },
      title() {
        return this.form.title;
      }
    },
    methods: {
      toKebabCase,
      submit() {
        this.form.post(route('admin.page.create'), {
          onSuccess: (data) => {
            this.form.reset();
            this.show = false;
          },
          onFinish: () => {}
        });
      }
    },
    watch: {
      title() {
        this.form.link = toKebabCase(this.form.title)
          .replace('.', '');
      }
    }
  };
</script>
