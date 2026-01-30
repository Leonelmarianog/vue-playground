<script setup lang="ts">
import CardForm from '@/components/CardForm.vue';
import QuickCardEditorMenuButtons from '@/components/QuickCardEditorMenuButtons.vue';
import { useCardStore } from '@/stores/card.ts';
import type { Card } from '@/types';
import { type CSSProperties } from 'vue';

const props = defineProps<{
  cardFormStyles: CSSProperties;
  card: Card;
  listId: number;
}>();

const emit = defineEmits<{
  (e: 'close'): void;
}>();

const cardStore = useCardStore();

function updateCardAndClose(formData: Partial<Card>) {
  cardStore.updateCard({
    id: formData.id as number,
    listId: props.listId,
    content: formData.content as string,
  });

  close();
}

function close() {
  emit('close');
}
</script>

<template>
  <CardForm
    :style="cardFormStyles"
    :initial-values="card"
    @save="updateCardAndClose"
    @cancel="close"
  />
  <QuickCardEditorMenuButtons />
</template>
