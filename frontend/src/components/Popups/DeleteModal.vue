<template>
  <div
    @click.self="cancel"
    v-if="isVisible"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center backdrop"
  >
    <div class="bg-white p-4 rounded shadow-lg max-w-sm w-full dark:bg-boxdark">
      <h2 class="text-lg font-bold mb-4">{{ title }}</h2>
      <p>{{ message }}</p>
      <div class="flex justify-end mt-4">
        <button @click="cancel" class="mr-2 px-4 py-2 bg-gray-300 rounded">Cancel</button>
        <button @click="confirm" class="px-4 py-2 bg-red-500 rounded">
          Delete
        </button>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps<{
  isVisible: boolean;
  title: string;
  message: string;
}>();

const emit = defineEmits(["confirm", "cancel"]);

const confirm = () => {
  emit("confirm");
};

const cancel = () => {
  emit("cancel");
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
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
