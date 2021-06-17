import Vue from 'vue';

Vue.filter('capitalize', (value, capitalizeAllwords) => {
  if (!value) return '';

  if (capitalizeAllwords) {
    return value.split(' ').map((word) => {
      return word[0].toUpperCase() + word.substring(1);
    }).join(' ');
  }
  return value[0].toUpperCase() + value.substring(1);
});

Vue.filter('initials', (value) => {
  if (!value) return '';
  return value.split(' ').map((n) => n[0]).join('');
});
