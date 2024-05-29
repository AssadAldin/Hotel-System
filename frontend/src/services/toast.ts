import { ref } from 'vue';

interface Toast {
  message: string;
  type: 'success' | 'error' | 'info';
  duration: number;
}

const toasts = ref<Toast[]>([]);

const addToast = (toast: Toast) => {
  toasts.value.push(toast);
  setTimeout(() => {
    toasts.value.shift();
  }, toast.duration || 3000);
};

export { toasts, addToast };
