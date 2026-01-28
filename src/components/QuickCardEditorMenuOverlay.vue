<script setup lang="ts">
import CardForm from '@/components/CardForm.vue';
import FocusOverlay from '@/components/FocusOverlay.vue';
import QuickCardEditorMenuButtons from '@/components/QuickCardEditorMenuButtons.vue';
import { computed, type CSSProperties } from 'vue';
import type { Card } from '@/types';
import { useCardStore } from '@/stores/card.ts';

const props = defineProps<{
  cardRef: HTMLElement;
  card: Card;
  listId: number;
}>();

const emit = defineEmits<{
  (e: 'close'): void;
}>();

const cardStore = useCardStore();

const styles = computed((): CSSProperties => {
  const cardRect = props.cardRef.getBoundingClientRect();

  return {
    top: `${cardRect.top}px`,
    left: `${cardRect.left}px`,
    height: `${cardRect.height}px`,
    width: `${cardRect.width}px`,
  };
});

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
  <FocusOverlay>
    <div
      class="flex gap-2 absolute"
      :style="{
        top: styles.top,
        left: styles.left,
      }"
    >
      <CardForm
        :style="{
          height: styles.height,
          width: styles.width,
        }"
        :initial-values="card"
        @save="updateCardAndClose"
        @cancel="close"
      />

      <QuickCardEditorMenuButtons />
    </div>
  </FocusOverlay>
</template>
