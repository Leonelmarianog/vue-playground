<script setup lang="ts">
import FocusOverlay from '@/components/FocusOverlay.vue';
import { computed, type CSSProperties } from 'vue';
import type { Card } from '@/types';
import QuickCardEditorMenu from '@/components/QuickCardEditorMenu.vue';

const props = defineProps<{
  cardRef: HTMLElement;
  card: Card;
  listId: number;
}>();

const emit = defineEmits<{
  (e: 'close'): void;
}>();

const cardRefBoxStyles = computed((): CSSProperties => {
  const cardRect = props.cardRef.getBoundingClientRect();

  return {
    top: `${cardRect.top}px`,
    left: `${cardRect.left}px`,
    width: `${cardRect.width}px`,
    height: `${cardRect.height}px`,
  };
});

function close() {
  emit('close');
}
</script>

<template>
  <FocusOverlay>
    <div
      class="flex gap-2 absolute"
      :style="{ top: cardRefBoxStyles.top, left: cardRefBoxStyles.left }"
    >
      <QuickCardEditorMenu
        :cardFormStyles="{ width: cardRefBoxStyles.width, height: cardRefBoxStyles.height }"
        :card="card"
        :listId="listId"
        @close="close"
      />
    </div>
  </FocusOverlay>
</template>
