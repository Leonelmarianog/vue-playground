import { describe, it, expect, beforeEach } from 'vitest';
import { mount } from '@vue/test-utils';
import { createPinia, setActivePinia } from 'pinia';
import BoardContainer from '@/components/BoardContainer.vue';
import BoardList from '@/components/BoardList.vue';
import CustomButton from '@/components/CustomButton.vue';
import { useListStore } from '@/stores/list';

describe('BoardContainer.vue', () => {
  beforeEach(() => {
    setActivePinia(createPinia());
  });

  it('renders correctly with lists from store', () => {
    const listStore = useListStore();

    listStore.lists = [
      { id: 1, title: 'List 1', cards: [] },
      { id: 2, title: 'List 2', cards: [] },
    ];

    const wrapper = mount(BoardContainer, {
      global: {
        stubs: {
          BoardList: true,
          CustomButton: true,
          Plus: true,
        },
      },
    });

    const boardLists = wrapper.findAllComponents(BoardList);

    expect(boardLists).toHaveLength(2);
    expect(boardLists[0]!.props('list')).toEqual(listStore.lists[0]);
    expect(boardLists[1]!.props('list')).toEqual(listStore.lists[1]);
  });

  it('renders the "Add another List" button with correct props', () => {
    const wrapper = mount(BoardContainer, {
      global: {
        stubs: {
          BoardList: true,
          CustomButton: {
            template: '<button><slot /></button>',
            props: ['variant'],
          },
          Plus: true,
        },
      },
    });

    const button = wrapper.findComponent(CustomButton);

    expect(button.exists()).toBe(true);
    expect(button.props('variant')).toBe('transparent');
    expect(button.text()).toContain('Add another List');
  });

  it('renders empty list when store has no lists', () => {
    const listStore = useListStore();
    listStore.lists = [];

    const wrapper = mount(BoardContainer, {
      global: {
        stubs: {
          BoardList: true,
          CustomButton: true,
          Plus: true,
        },
      },
    });

    expect(wrapper.findAllComponents(BoardList)).toHaveLength(0);
  });
});
