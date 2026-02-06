import { describe, it, expect } from 'vitest';
import { mount } from '@vue/test-utils';
import PageLayout from '@/components/PageLayout.vue';

describe('PageLayout.vue', () => {
  it('renders slots', () => {
    const wrapper = mount(PageLayout, {
      slots: {
        heading: '<h1>Title</h1>',
        default: '<p>Content</p>',
      },
    });

    expect(wrapper.find('header').text()).toBe('Title');
    expect(wrapper.find('main').text()).toBe('Content');
  });
});
