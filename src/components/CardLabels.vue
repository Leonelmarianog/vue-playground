<script setup lang="ts">
import type { Label } from '@/types';

defineProps<{
  labels: Label[];
}>();
</script>

<template>
  <ul class="flex flex-wrap gap-x-1">
    <li v-for="label in labels" :key="label.name + '_' + new Date().getTime()">
      <div
        class="text-xs capitalize text-white py-px px-2 rounded-sm inline-block"
        :style="{ backgroundColor: label.color }"
      >
        {{ label.name }}
      </div>
    </li>
  </ul>
</template>
