<script lang="ts">
import { defineComponent } from 'vue';
import type { PropType } from 'vue';
import CardLabel from './CardLabel.vue';

export default defineComponent({
  components: { CardLabel },

  props: {
    id: {
      type: Number,
      required: true,
    },
    content: {
      type: String,
      default: '',
    },
    labels: {
      type: Array as PropType<{ name: string; color: string }[]>,
      default: () => [],
    },
  },

  methods: {
    edit() {
      this.$emit(
        'edit',
        { cardId: this.id, content: this.content },
        this.$el.getBoundingClientRect(),
      );
    },
  },
});
</script>

<template>
  <div class="bg-neutral-100 rounded-sm shadow-sm px-2 py-1 space-y-1 group relative">
    <ul class="flex flex-wrap gap-x-1">
      <li v-for="label in labels" :key="label.name + '_' + new Date().getTime()">
        <CardLabel :name="label.name" :color="label.color" />
      </li>
    </ul>

    <p class="truncate">{{ content }}</p>

    <button
      class="bg-neutral-100 text-sm font-bold p-1 rounded-sm cursor-pointer group-hover:block hover:bg-neutral-300 absolute top-[0.2em] right-[0.2em]"
      @click="edit"
    >
      <img
        class="w-5 h-5"
        src="https://unpkg.com/lucide-static@latest/icons/pencil.svg"
        alt="Edit"
      />
    </button>
  </div>
</template>
