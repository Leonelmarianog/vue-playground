import { describe, it, expect } from 'vitest';
import { mount } from '@vue/test-utils';
import DynamicForm from '@/components/DynamicForm.vue';
import { Form as VeeForm } from 'vee-validate';
import { object, string } from 'yup';

describe('DynamicForm.vue', () => {
  it('renders the slotted content', () => {
    const wrapper = mount(DynamicForm, {
      slots: {
        default: '<div id="test-slot">Slot Content</div>',
      },
    });

    expect(wrapper.find('#test-slot').exists()).toBe(true);
    expect(wrapper.text()).toContain('Slot Content');
  });

  it('passes props to VeeForm', () => {
    const schema = object({
      test: string().required(),
    });
    const initialValues = { test: 'initial' };

    const wrapper = mount(DynamicForm, {
      props: {
        schema,
        initialValues,
      },
      global: {
        stubs: {
          VeeForm: {
            name: 'Form',
            props: ['validationSchema', 'initialValues'],
            template: '<div><slot /></div>',
          },
        },
      },
    });

    const veeForm = wrapper.findComponent({ name: 'Form' });

    expect(veeForm.props('validationSchema')).toEqual(schema);
    expect(veeForm.props('initialValues')).toEqual(initialValues);
  });

  it('emits "submit" when VeeForm submits', async () => {
    const wrapper = mount(DynamicForm);
    const veeForm = wrapper.findComponent(VeeForm);

    const values = { name: 'John Doe' };
    veeForm.vm.$emit('submit', values);

    expect(wrapper.emitted('submit')).toBeTruthy();
    expect(wrapper.emitted('submit')![0]).toEqual([values]);
  });

  it('provides v-slot props to the slot', () => {
    const wrapper = mount(DynamicForm, {
      slots: {
        default: `
        <template #default="slotProps">
          <div id="slot-content">
            <span id="errors">{{ JSON.stringify(slotProps.errors) }}</span>
            <span id="values">{{ JSON.stringify(slotProps.values) }}</span>
            <span id="meta">{{ JSON.stringify(slotProps.meta) }}</span>
          </div>
        </template>
      `,
      },
      global: {
        stubs: {
          VeeForm: {
            template: '<slot :errors="{}" :values="{}" :meta="{}" />',
          },
        },
      },
    });

    const slotContent = wrapper.find('#slot-content');
    expect(slotContent.exists()).toBe(true);

    expect(wrapper.find('#errors').text().length).toBeGreaterThan(0); // {}
    expect(wrapper.find('#values').text().length).toBeGreaterThan(0); // {}
    expect(wrapper.find('#meta').text().length).toBeGreaterThan(0); // { ... }
  });
});
