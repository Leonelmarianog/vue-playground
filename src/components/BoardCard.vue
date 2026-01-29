<script setup lang="ts">
import CardLabel from './CardLabel.vue';
import type { Card } from '@/types';
import { Pencil } from 'lucide-vue-next';
import CustomButton from '@/components/CustomButton.vue';

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

    <div class="absolute top-1 right-1 hidden group-hover:block">
      <CustomButton variant="clear" padding="xs" @click="edit">
        <Pencil :size="20" />
      </CustomButton>
    </div>
  </div>
</template>
