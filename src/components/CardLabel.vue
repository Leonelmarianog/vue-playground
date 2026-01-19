<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    name: String,
    color: String,
  },
});
</script>

<template>
  <div
    class="text-xs capitalize text-white py-px px-2 rounded-sm inline-block"
    :style="{ backgroundColor: color }"
  >
    {{ name }}
  </div>
</template>
