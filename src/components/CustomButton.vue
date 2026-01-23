<script lang="ts">
import { defineComponent } from 'vue';

const BASE_STYLE = 'cursor-pointer disabled:cursor-not-allowed rounded-sm py-2 px-6 text-nowrap';

const VARIANTS = {
  default: 'bg-neutral-500 hover:bg-neutral-400 disabled:bg-neutral-400 text-white',
  sky: 'bg-sky-500 hover:bg-sky-400 disabled:bg-sky-400 text-white',
  transparent: 'bg-black/60 hover:bg-black/80 text-white',
  clear: 'bg-black/0 hover:bg-black/20',
};

export default defineComponent({
  emits: ['click'],

  props: {
    variant: {
      type: String,
      default: 'default',
    },
    fullWidth: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    classes() {
      const variant = VARIANTS[this.variant as keyof typeof VARIANTS];
      const width = this.fullWidth ? 'w-full' : '';
      return [BASE_STYLE, width, variant];
    },
  },

  methods: {
    onClick() {
      this.$emit('click');
    },
  },
});
</script>

<template>
  <button :class="classes" @click="onClick">
    <slot />
  </button>
</template>
