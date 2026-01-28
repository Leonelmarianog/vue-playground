<script setup lang="ts">
import CardLabel from './CardLabel.vue';
import type { Card } from '@/types';

const props = defineProps<{
  card: Card;
}>();

const emit = defineEmits<{
  (e: 'edit', card: Card): void;
}>();

const edit = () => {
  emit('edit', props.card);
};
</script>

<template>
  <div ref="root" class="bg-neutral-100 rounded-sm shadow-sm px-2 py-1 space-y-1 group relative">
    <ul class="flex flex-wrap gap-x-1">
      <li v-for="label in card.labels" :key="label.name + '_' + new Date().getTime()">
        <CardLabel :label="label" />
      </li>
    </ul>

    <p class="truncate">{{ card.content }}</p>

    <button
      class="bg-neutral-100 text-sm font-bold p-1 rounded-sm cursor-pointer group-hover:block hover:bg-neutral-300 absolute top-[0.2em] right-[0.2em]"
      @click="edit"
    >
      <img
        class="w-5 h-5"
        src="https://unpkg.com/lucide-static@latest/icons/pencil.svg"
        alt="Edit Card"
      />
    </button>
  </div>
</template>
