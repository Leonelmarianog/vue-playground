import { describe, it, expect } from 'vitest';
import { mount } from '@vue/test-utils';
import QuickCardEditorMenuButtons from '@/components/QuickCardEditorMenuButtons.vue';

describe('QuickCardEditorMenuButtons.vue', () => {
  it('renders correctly', () => {
    const wrapper = mount(QuickCardEditorMenuButtons);

    expect(wrapper.text()).toContain('Open Card');
    expect(wrapper.text()).toContain('Edit labels');
  });
});
