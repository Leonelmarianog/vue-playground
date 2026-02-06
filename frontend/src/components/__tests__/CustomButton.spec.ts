import { describe, it, expect } from 'vitest';
import { mount } from '@vue/test-utils';
import CustomButton from '@/components/CustomButton.vue';

describe('CustomButton.vue', () => {
  describe('Rendering', () => {
    it('renders the slotted content', () => {
      const wrapper = mount(CustomButton, {
        slots: {
          default: 'Click Me',
        },
      });

      expect(wrapper.find('button').text()).toBe('Click Me');
    });

    it('has base styles', () => {
      const wrapper = mount(CustomButton);
      const button = wrapper.find('button');

      expect(button.attributes('class')).toContain('cursor-pointer');
      expect(button.attributes('class')).toContain('rounded-sm');
    });

    it('has styles for the disabled state', () => {
      const wrapper = mount(CustomButton, {
        props: {
          disabled: true,
        },
      });
      const button = wrapper.find('button');

      expect(button.attributes('class')).toContain('cursor-not-allowed');
    });
  });

  describe('Props', () => {
    describe('variant', () => {
      it('applies default variant when not set', () => {
        const wrapper = mount(CustomButton);
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('bg-neutral-600');
      });

      it('applies variant when set to "green"', () => {
        const wrapper = mount(CustomButton, {
          props: {
            variant: 'green',
          },
        });
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('bg-green-600');
      });

      it('applies variant when set to "transparent"', () => {
        const wrapper = mount(CustomButton, {
          props: {
            variant: 'transparent',
          },
        });
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('bg-black/40');
      });

      it('applies variant when set to "clear"', () => {
        const wrapper = mount(CustomButton, {
          props: {
            variant: 'clear',
          },
        });
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('bg-transparent');
      });
    });

    describe('width', () => {
      it('makes button not span the full width of its parent when set to "auto"', () => {
        const wrapper = mount(CustomButton);
        const button = wrapper.find('button');

        expect(button.attributes('class')).not.toContain('w-full');
      });

      it('makes button span the full width of its parent when set to "full"', () => {
        const wrapper = mount(CustomButton, {
          props: {
            width: 'full',
          },
        });
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('w-full');
      });
    });

    describe('padding', () => {
      it('applies default padding when not set', () => {
        const wrapper = mount(CustomButton);
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('py-2');
        expect(button.attributes('class')).toContain('px-3');
      });

      it('applies padding when set to "xs"', () => {
        const wrapper = mount(CustomButton, {
          props: {
            padding: 'xs',
          },
        });
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('py-1');
        expect(button.attributes('class')).toContain('px-1');
      });

      it('applies padding when set to "sm"', () => {
        const wrapper = mount(CustomButton, {
          props: {
            padding: 'sm',
          },
        });
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('py-1');
        expect(button.attributes('class')).toContain('px-2');
      });

      it('applies padding when set to "lg"', () => {
        const wrapper = mount(CustomButton, {
          props: {
            padding: 'lg',
          },
        });
        const button = wrapper.find('button');

        expect(button.attributes('class')).toContain('py-3');
        expect(button.attributes('class')).toContain('px-4');
      });
    });
  });

  describe('Events', () => {
    it('emits a "click" event when clicked', async () => {
      const wrapper = mount(CustomButton);

      await wrapper.find('button').trigger('click');

      expect(wrapper.emitted()).toHaveProperty('click');
    });
  });
});
