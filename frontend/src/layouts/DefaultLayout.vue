<script setup lang="ts">
import HeaderArea from "@/components/Header/HeaderArea.vue";
import SidebarArea from "@/components/Sidebar/SidebarArea.vue";
import ToastAlert from "../../src/components/ToastAlert.vue";
import { addToast, toasts } from "../../src/services/toast.ts";

const showToast = () => {
  console.log("toast");

  addToast({
    message: "Hello, World!",
    type: "success",
    duration: 3000,
  });
};
</script>

<template>
  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <!-- ===== Sidebar Start ===== -->
    <SidebarArea />
    <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      <!-- ===== Header Start ===== -->
      <HeaderArea />
      <!-- ===== Header End ===== -->

      <!-- ===== Main Content Start ===== -->
      <main>
          <!-- Toast -->
          <div class="relative z-40 md:ml-6">
            <ToastAlert v-for="(toast, index) in toasts" :key="index" v-bind="toast" />
          </div>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <slot></slot>
        </div>
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
  </div>
  <!-- ===== Page Wrapper End ===== -->
</template>
