import { describe, it, expect } from 'vitest';
import { mount } from '@vue/test-utils';
import CardLabels from '@/components/CardLabels.vue';

describe('CardLabels.vue', () => {
  describe('Rendering', () => {
    it('renders nothing when no labels are provided', () => {
      const wrapper = mount(CardLabels, {
        props: {
          labels: [],
        },
      });

      const labels = wrapper.findAll('li');

      expect(labels).toHaveLength(0);
    });

    it('renders all labels', () => {
      const wrapper = mount(CardLabels, {
        props: {
          labels: [
            { name: 'Bug', color: 'rgb(255, 0, 0)' },
            { name: 'Feature', color: 'rgb(0, 255, 0)' },
            { name: 'Refactor', color: 'rgb(0, 0, 255)' },
          ],
        },
      });

      const labels = wrapper.findAll('li');

      expect(labels).toHaveLength(3);
    });

    it('renders each label correctly', () => {
      const wrapper = mount(CardLabels, {
        props: {
          labels: [{ name: 'Bug', color: 'rgb(255, 0, 0)' }],
        },
      });

      const label = wrapper.find('div');

      expect(label.text()).toBe('Bug');
      expect(label.attributes('style')).toContain('rgb(255, 0, 0)');
    });

    it('spaces labels', () => {
      const wrapper = mount(CardLabels, {
        props: {
          labels: [
            { name: 'Bug', color: 'rgb(255, 0, 0)' },
            { name: 'Feature', color: 'rgb(0, 255, 0)' },
            { name: 'Refactor', color: 'rgb(0, 0, 255)' },
          ],
        },
      });

      const list = wrapper.find('ul');

      expect(list.classes().join(' ')).toContain('flex flex-wrap gap-x-1');
    });

    it('capitalizes labels', () => {
      const wrapper = mount(CardLabels, {
        props: {
          labels: [
            { name: 'Bug', color: 'rgb(255, 0, 0)' },
            { name: 'Feature', color: 'rgb(0, 255, 0)' },
            { name: 'Refactor', color: 'rgb(0, 0, 255)' },
          ],
        },
      });

      const label = wrapper.find('div');

      expect(label.classes()).toContain('capitalize');
    });
  });
});
