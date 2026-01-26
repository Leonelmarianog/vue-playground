<script setup lang="ts">
import { type CSSProperties, computed, ref } from 'vue';
import BoardCard from './BoardCard.vue';
import CardForm from '@/components/CardForm.vue';
import FocusOverlay from '@/components/FocusOverlay.vue';
import CardMenu from '@/components/CardMenu.vue';
import CustomButton from '@/components/CustomButton.vue';
import type { Card, List } from '@/types';
import { useToggle } from '@/composables/useToggle';
import { useCardStore } from '@/stores/card';

const props = defineProps<{
  list: List;
}>();

const cardStore = useCardStore();

const activeCard = ref<Partial<Card> | null>(null);
const activeCardRect = ref<DOMRect | null>(null);

const {
  isVisible: isCardCreateFormVisible,
  show: showCardCreateForm,
  hide: hideCardCreateForm,
} = useToggle();

const {
  isVisible: isCardUpdateFormVisible,
  show: showCardUpdateForm,
  hide: hideCardUpdateForm,
} = useToggle();

const handleOpenCardUpdateForm = (card: Partial<Card>, cardRect: DOMRect) => {
  activeCard.value = card;
  activeCardRect.value = cardRect;
  showCardUpdateForm();
};

const handleCloseCardUpdateForm = () => {
  activeCard.value = null;
  activeCardRect.value = null;
  hideCardUpdateForm();
};

const handleCreateCard = (formData: Partial<Card>) => {
  cardStore.storeCard({
    id: new Date().getTime(),
    listId: props.list.id,
    content: formData.content as string,
    labels: [],
  });
  hideCardCreateForm();
};

const handleUpdateCard = (formData: Partial<Card>) => {
  cardStore.updateCard({
    id: formData.id as number,
    listId: props.list.id,
    content: formData.content as string,
  });
  handleCloseCardUpdateForm();
};

const activeCardPosition = computed((): CSSProperties | null => {
  if (!activeCardRect.value) {
    return null;
  }

  return {
    top: `${activeCardRect.value.top}px`,
    left: `${activeCardRect.value.left}px`,
  };
});

const activeCardSize = computed((): CSSProperties | null => {
  if (!activeCardRect.value) {
    return null;
  }

  return {
    height: `${activeCardRect.value.height}px`,
    width: `${activeCardRect.value.width}px`,
  };
});
</script>

<template>
  <div class="bg-neutral-300 rounded-md shadow-md p-2">
    <h2 class="font-bold capitalize pl-2">{{ list.title }}</h2>

    <ul class="space-y-2 mt-3 mb-2">
      <li v-for="card in list.cards" :key="card.id">
        <BoardCard :card="card" @edit="handleOpenCardUpdateForm" />
      </li>
    </ul>

    <CardForm
      v-if="isCardCreateFormVisible"
      @save="handleCreateCard"
      @cancel="hideCardCreateForm"
    />

    <CustomButton v-else variant="clear" :fullWidth="true" @click="showCardCreateForm">
      <span class="text-neutral-500 hover:text-neutral-700 text-sm font-bold text-left block">
        + Add another card
      </span>
    </CustomButton>

    <FocusOverlay v-if="isCardUpdateFormVisible">
      <div class="flex gap-2 absolute" :style="activeCardPosition || undefined">
        <CardForm
          :style="activeCardSize || undefined"
          :initial-values="activeCard"
          @save="handleUpdateCard"
          @cancel="handleCloseCardUpdateForm"
        />
        <CardMenu />
      </div>
    </FocusOverlay>
  </div>
</template>
