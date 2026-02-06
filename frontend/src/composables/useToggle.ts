import { ref } from 'vue';

export function useToggle(initialValue = false) {
  const isVisible = ref(initialValue);

  const show = () => {
    isVisible.value = true;
  };

  const hide = () => {
    isVisible.value = false;
  };

  const toggle = () => {
    isVisible.value = !isVisible.value;
  };

  return {
    isVisible,
    show,
    hide,
    toggle,
  };
}
