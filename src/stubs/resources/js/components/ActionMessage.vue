<template>
  <span>
    <transition leave-active-class="transition ease-in duration-1000" leave-class="opacity-100" leave-to-class="opacity-0">
      <span v-show="on" class="gray-text">
        <slot></slot>
      </span>
    </transition>
  </span>
</template>

<script>
export default {
  props: ['on']
};
</script>
