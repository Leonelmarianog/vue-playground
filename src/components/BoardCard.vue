<script setup lang="ts">
import CardLabels from './CardLabels.vue';
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
    <CardLabels :labels="card.labels" />

    <p class="truncate">{{ card.content }}</p>

    <div class="absolute top-1 right-1 hidden group-hover:block">
      <CustomButton variant="clear" padding="xs" @click="edit">
        <Pencil :size="20" />
      </CustomButton>
    </div>
  </div>
</template>
