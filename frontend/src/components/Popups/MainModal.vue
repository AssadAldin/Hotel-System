<template>
  <transition name="fade">
    <div v-if="isVisible" @click.self="close" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 backdrop">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden w-full max-w-md">
        <div class="px-4 py-2 bg-gray-100 border-b">
          <h2 class="text-lg font-semibold">{{ title }}</h2>
        </div>
        <div class="p-4">
          <slot></slot>
        </div>
        <div class="px-4 py-2 bg-gray-100 border-t text-right">
          <button @click="close" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Close
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';

interface Props {
  isVisible: boolean;
  title: string;
}

const props = defineProps<Props>();
const emit = defineEmits(['update:isVisible']);

const close = () => {
  emit('update:isVisible', false);
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
.backdrop {
  top: 0;
  position: fixed;
  background: rgba(0, 0, 0, 0.5);
  width: 100%;
  height: 100%;
}
</style>