import { describe, it, expect } from 'vitest';
import { DOMWrapper, mount } from '@vue/test-utils';
import BoardCard from '@/components/BoardCard.vue';

describe('BoardCard.vue', () => {
  it('renders the card content', () => {
    const wrapper = mount(BoardCard, {
      props: {
        card: {
          id: 1,
          listId: 1,
          content: 'Hello card',
          labels: [],
        },
      },
    });

    expect(wrapper.text()).toContain('Hello card');
  });

  it('renders labels', () => {
    const wrapper = mount(BoardCard, {
      props: {
        card: {
          id: 1,
          listId: 1,
          content: 'With labels',
          labels: [
            { name: 'Bug', color: '#f00' },
            { name: 'Chore', color: '#0f0' },
          ],
        },
      },
      global: {
        stubs: {
          CardLabel: {
            name: 'CardLabel',
            props: ['label'],
            template: `<span id="card-label-stub">{{ label.name }}:{{ label.color }}</span>`,
          },
        },
      },
    });
    const labels = wrapper.findAll('#card-label-stub');

    expect(labels).toHaveLength(2);
    expect((labels[0] as DOMWrapper<HTMLElement>).text()).toBe('Bug:#f00');
    expect((labels[1] as DOMWrapper<HTMLElement>).text()).toBe('Chore:#0f0');
  });

  it('renders the edit button', () => {
    const wrapper = mount(BoardCard, {
      props: {
        card: {
          id: 1,
          listId: 1,
          content: 'Icon test',
          labels: [],
        },
      },
    });
    const button = wrapper.find('button');

    expect(button.exists()).toBe(true);
  });

  it('emits "edit" event with card data when edit button is clicked', async () => {
    const wrapper = mount(BoardCard, {
      props: {
        card: {
          id: 42,
          listId: 1,
          content: 'Editable content',
          labels: [],
        },
      },
    });

    await wrapper.find('button').trigger('click');

    const editEvent = wrapper.emitted('edit');
    const [card] = editEvent![0] as [Record<string, unknown>];

    expect(card).toEqual({ id: 42, listId: 1, content: 'Editable content', labels: [] });
  });
});
