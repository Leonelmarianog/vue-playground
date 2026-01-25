<script setup lang="ts">
defineProps<{
  name?: string;
  color?: string;
}>();
</script>

<template>
  <div
    class="text-xs capitalize text-white py-px px-2 rounded-sm inline-block"
    :style="{ backgroundColor: color }"
  >
    {{ name }}
  </div>
</template>
