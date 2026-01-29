<script setup lang="ts">
import { computed } from 'vue';

type VariantOption = 'default' | 'green' | 'transparent' | 'clear';
type PaddingOption = 'xs' | 'sm' | 'md' | 'lg';

const emit = defineEmits<{
  (e: 'click'): void;
}>();

const props = withDefaults(
  defineProps<{
    variant?: VariantOption;
    padding?: PaddingOption;
    fullWidth?: boolean;
  }>(),
  {
    variant: 'default',
    padding: 'md',
    fullWidth: false,
  },
);

const BASE_STYLE = 'cursor-pointer disabled:cursor-not-allowed rounded-sm text-nowrap';

const VARIANT_OPTIONS: Record<VariantOption, string> = {
  default: 'bg-neutral-600 hover:bg-neutral-700 disabled:bg-neutral-300 text-white',
  green: 'bg-green-600 hover:bg-green-700 disabled:bg-green-300 text-white',
  transparent: 'bg-black/60 hover:bg-black/80 disabled:bg-black/30 text-white',
  clear: 'bg-transparent hover:bg-gray-100 disabled:text-gray-400 text-gray-800',
};

const PADDING_OPTIONS: Record<PaddingOption, string> = {
  xs: 'py-1 px-3 text-sm',
  sm: 'py-1.5 px-4 text-sm',
  md: 'py-2 px-6',
  lg: 'py-3 px-8 text-lg',
};

const classes = computed(() => {
  const variant = VARIANT_OPTIONS[props.variant];
  const padding = PADDING_OPTIONS[props.padding];
  const width = props.fullWidth ? 'w-full' : '';
  return [BASE_STYLE, variant, padding, width];
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
