<script setup lang="ts">
import BoardList from '@/components/BoardList.vue';
import PageLayout from '@/components/PageLayout.vue';
import BoardContainer from '@/components/BoardContainer.vue';
import { useListStore } from '@/stores/list';

const listStore = useListStore();
</script>

<template>
  <PageLayout>
    <template v-slot:heading>
      <h1 class="font-bold text-3xl text-center">My board</h1>
    </template>

    <template v-slot:default>
      <BoardContainer>
        <template v-slot:default>
          <BoardList v-for="list in listStore.lists" :key="list.id" :list="list" />
        </template>
      </BoardContainer>
    </template>
  </PageLayout>
</template>
