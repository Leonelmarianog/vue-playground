<script setup lang="ts">
import CustomButton from '@/components/CustomButton.vue';
import { Plus } from 'lucide-vue-next';
import BoardList from '@/components/BoardList.vue';
import { useListStore } from '@/stores/list.ts';

const listStore = useListStore();
</script>

<template>
  <div id="board" class="grid auto-cols-[20em] grid-flow-col gap-2 items-start h-full">
    <ul>
      <li v-for="list in listStore.lists" :key="list.id">
        <BoardList :list="list" />
      </li>
    </ul>

    <CustomButton variant="transparent">
      <span class="flex justify-center items-center gap-1">
        <Plus :size="16" />
        Add another List
      </span>
    </CustomButton>
  </div>
</template>
