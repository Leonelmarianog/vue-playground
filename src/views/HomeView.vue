<script setup lang="ts">
import BoardContainer from '@/components/BoardContainer.vue';
import PageLayout from '@/components/PageLayout.vue';
</script>

<template>
  <PageLayout>
    <template #heading>
      <h1 class="font-bold text-3xl text-center">My board</h1>
    </template>

    <template #default>
      <BoardContainer />
    </template>
  </PageLayout>
</template>
