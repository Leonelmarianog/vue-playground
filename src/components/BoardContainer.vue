<script setup lang="ts">
import CustomButton from '@/components/CustomButton.vue';
import { Plus } from 'lucide-vue-next';
import BoardList from '@/components/BoardList.vue';
import { useListStore } from '@/stores/list.ts';

const listStore = useListStore();
</script>

<template>
  <ul id="board" class="inline-grid auto-cols-[20em] grid-flow-col gap-2 items-start px-4">
    <li v-for="list in listStore.lists" :key="list.id">
      <BoardList :list="list" />
    </li>

    <li>
      <CustomButton variant="transparent" width="full">
        <span class="flex justify-center items-center gap-1">
          <Plus :size="16" />
          Add another List
        </span>
      </CustomButton>
    </li>
  </ul>
</template>
