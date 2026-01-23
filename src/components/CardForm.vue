<script lang="ts">
import { defineComponent, type PropType } from 'vue';
import { Field } from 'vee-validate';
import { object, string } from 'yup';
import DynamicForm from '@/components/DynamicForm.vue';
import CustomButton from '@/components/CustomButton.vue';

const schema = object({
  content: string().trim().required('This field is required.').default(''),
});

export default defineComponent({
  components: { CustomButton, DynamicForm, Field },

  emits: ['save', 'cancel'],

  props: {
    initialValues: {
      type: Object as PropType<Record<string, unknown> | null>,
      default: null,
    },
  },

  computed: {
    schema() {
      return schema;
    },

    isEdit() {
      return !!this.initialValues;
    },

    formValues() {
      return this.isEdit ? this.initialValues : null;
    },
  },

  methods: {
    save(values: Record<string, unknown>) {
      this.$emit('save', values);
    },

    cancel() {
      this.$emit('cancel');
    },
  },

  mounted() {
    const $contentField = (this.$refs.contentFieldWrapper as HTMLElement).querySelector(
      'textarea[name="content"]',
    )! as HTMLTextAreaElement;
    $contentField.focus();
  },
});
</script>

<template>
  <DynamicForm :schema="schema" :initial-values="formValues" @submit="save">
    <template #default="{ meta }">
      <div class="space-y-2">
        <div>
          <div class="p-2 bg-white rounded-sm shadow-md" ref="contentFieldWrapper">
            <Field
              as="textarea"
              type="textarea"
              name="content"
              placeholder="Enter a title for this card..."
              class="w-full block pl-1"
              ref="contentInput"
            />
          </div>
        </div>

        <div class="space-x-2">
          <CustomButton type="submit" variant="sky" :disabled="!meta.valid">Save</CustomButton>
          <CustomButton type="button" @click="cancel">Cancel</CustomButton>
        </div>
      </div>
    </template>
  </DynamicForm>
</template>
