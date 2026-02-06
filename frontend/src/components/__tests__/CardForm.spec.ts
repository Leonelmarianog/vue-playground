import { describe, it, expect, vi } from 'vitest';
import { flushPromises, mount } from '@vue/test-utils';
import waitForExpect from 'wait-for-expect';
import CardForm from '@/components/CardForm.vue';

describe('CardSaveForm.vue', () => {
  describe('Rendering', () => {
    it('renders correctly', () => {
      const wrapper = mount(CardForm);

      expect(wrapper.find('textarea[name="content"]').exists()).toBe(true);
      expect(wrapper.find('textarea[name="content"]').attributes('placeholder')).toBeTruthy();
      expect(wrapper.find('button[type="submit"]').text()).toBe('Save');
      expect(wrapper.find('button[type="button"]').text()).toBe('Cancel');
    });

    it('focuses the content field on mount', () => {
      const spy = vi.spyOn(HTMLTextAreaElement.prototype, 'focus');
      mount(CardForm);

      expect(spy).toHaveBeenCalled();
      spy.mockRestore();
    });

    it('leaves all form fields empty when creating a new Card', async () => {
      const wrapper = mount(CardForm);

      const textarea = wrapper.find('textarea[name="content"]');
      expect((textarea.element as HTMLTextAreaElement).value).toBe('');
    });

    it('pre-populates form fields with initial data when editing an existing Card', async () => {
      const initialValues = { content: 'Existing Content' };
      const wrapper = mount(CardForm, {
        props: { initialValues },
      });

      const textarea = wrapper.find('textarea[name="content"]');
      expect((textarea.element as HTMLTextAreaElement).value).toBe('Existing Content');
    });
  });

  describe('Fields', () => {
    describe('Content Field', () => {
      it('is required', async () => {
        const wrapper = mount(CardForm);
        const contentField = wrapper.find('textarea[name="content"]');

        await contentField.setValue('');

        await flushPromises();
        await waitForExpect(() => {
          expect(wrapper.find('button[type="submit"]').attributes('disabled')).toBeDefined();
        });
      });

      it('trims input', async () => {
        const wrapper = mount(CardForm);
        const contentField = wrapper.find('textarea[name="content"]');

        await contentField.setValue('       ');

        await flushPromises();
        await waitForExpect(() => {
          expect(wrapper.find('button[type="submit"]').attributes('disabled')).toBeDefined();
        });
      });
    });
  });

  describe('Save and Cancel buttons', () => {
    describe('Save button', () => {
      it('is disabled on mount', async () => {
        const wrapper = mount(CardForm);

        await flushPromises();
        await waitForExpect(() => {
          expect(wrapper.find('button[type="submit"]').attributes('disabled')).toBeDefined();
        });
      });

      it('is disabled when validation fails', async () => {
        const wrapper = mount(CardForm);
        const contentField = wrapper.find('textarea[name="content"]');

        await contentField.setValue('');

        await flushPromises();
        await waitForExpect(() => {
          expect(wrapper.find('button[type="submit"]').attributes('disabled')).toBeDefined();
        });
      });

      it('is enabled when validation passes', async () => {
        const wrapper = mount(CardForm);
        const contentField = wrapper.find('textarea[name="content"]');

        await contentField.setValue('test');

        await flushPromises();
        await waitForExpect(() => {
          expect(wrapper.find('button[type="submit"]').attributes('disabled')).toBeUndefined();
        });
      });
    });

    describe('Cancel button', () => {
      it('emits a "cancel" event when clicked', async () => {
        const wrapper = mount(CardForm);

        await wrapper.find('button[type="button"]').trigger('click');

        await flushPromises();
        await waitForExpect(() => {
          expect(wrapper.emitted()).toHaveProperty('cancel');
        });
      });
    });
  });

  describe('Submission', () => {
    it('emits a "save" event on submit', async () => {
      const wrapper = mount(CardForm);

      await wrapper.find('textarea[name="content"]').setValue('test');
      await wrapper.find('form').trigger('submit');

      await flushPromises();
      await waitForExpect(() => {
        expect(wrapper.emitted()).toHaveProperty('save');
      });
    });
  });
});
