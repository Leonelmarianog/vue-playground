<script setup lang="ts">
import { computed } from 'vue';

const BASE_STYLE = 'cursor-pointer disabled:cursor-not-allowed rounded-sm py-2 px-6 text-nowrap';

const VARIANT_OPTIONS = {
  default: 'bg-neutral-600 hover:bg-neutral-700 disabled:bg-neutral-300 text-white',
  green: 'bg-green-600 hover:bg-green-700 disabled:bg-green-300 text-white',
  transparent: 'bg-black/60 hover:bg-black/80 disabled:bg-black/30 text-white',
  clear: 'bg-transparent hover:bg-gray-100 disabled:text-gray-400 text-gray-800',
};

const emit = defineEmits<{
  (e: 'click'): void;
}>();

const props = withDefaults(
  defineProps<{
    variant?: 'default' | 'green' | 'transparent' | 'clear';
    fullWidth?: boolean;
  }>(),
  {
    variant: 'default',
    fullWidth: false,
  },
);

const classes = computed(() => {
  const variantClass = VARIANT_OPTIONS[props.variant];
  const width = props.fullWidth ? 'w-full' : '';
  return [BASE_STYLE, width, variantClass];
});

const onClick = () => {
  emit('click');
};
</script>

<template>
  <button :class="classes" @click="onClick">
    <slot />
  </button>
</template>
