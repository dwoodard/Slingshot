<template>
  <div>
    <section v-html="JSON.parse($page.props.page.source).html">
    </section>
  </div>
</template>

<script>
  export default {
    props: ['page'],

    mounted() {
      const css = JSON.parse(this.$page.props.page.source).css;
      const head = document.head || document.getElementsByTagName('head')[0];
      const style = document.createElement('style');
      head.appendChild(style);
      style.appendChild(document.createTextNode(css));
    }
  };
</script>
