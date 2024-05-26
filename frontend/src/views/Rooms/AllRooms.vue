<script setup lang="ts">
import BreadcrumbDefault from "@/components/Breadcrumbs/BreadcrumbDefault.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
import MainModal from "../../components/Popups/MainModal.vue";

import { ref, onMounted } from "vue";
import axios from "axios";

const pageTitle = ref("Rooms");

const items = ref<Item[]>([]);
// Get data
const fetchData = async () => {
  try {
    const response = await axios.get<Item[]>("http://127.0.0.1:8001/api/rooms");
    items.value = response.data.data;
  } catch (error) {
    console.error("There was an error fetching the data:", error);
  }
  
};

onMounted(fetchData);
//End Get data

const showModal = ref(false);
</script>

<template>
  <DefaultLayout>
    <!-- Breadcrumb Start -->
    <BreadcrumbDefault :pageTitle="pageTitle" />
    <!-- Breadcrumb End -->
    <MainModal
      :isVisible="showModal"
      title="My Modal"
      @update:isVisible="showModal = $event"
    >
      <p>This is the content of the modal.</p>
    </MainModal>
    <div
      class="rounded-lg border border-stroke px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
    >
      <div class="max-w-full overflow-x-auto">
        <table class="w-full table-auto">
          <thead>
            <tr class="bg-gray-2 text-left dark:bg-meta-4">
              <th
                class="min-w-[220px] py-4 px-4 font-medium text-black dark:text-white xl:pl-11"
              >
                Room
              </th>
              <th class="min-w-[150px] py-4 px-4 font-medium text-black dark:text-white">
                Guests
              </th>
              <th class="min-w-[120px] py-4 px-4 font-medium text-black dark:text-white">
                Status
              </th>
              <th class="py-4 px-4 font-medium text-black dark:text-white">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items" :key="index">
              <td class="py-5 px-4 pl-9 xl:pl-11">
                <h5 class="font-medium text-black dark:text-white">
                  {{ item.id }}Room {{ item.floor }}{{ item.number }}
                </h5>
                <p class="text-sm"></p>
              </td>
              <td class="py-5 px-4">
                <p class="text-black dark:text-white">Guest Name</p>
              </td>
              <td class="py-5 px-4">
                <p
                  class="inline-flex rounded-full bg-opacity-10 py-1 px-3 text-sm font-medium"
                  :class="{
                    'bg-warning text-warning': item.number === 3,
                    'bg-danger text-danger': item.number === 1,
                    'bg-success text-success': item.number === 2,
                  }"
                >
                  Rented
                </p>
              </td>
              <td class="py-5 px-4">
                <div class="flex items-center space-x-3.5">
                  <!-- Show button -->
                  <button class="hover:text-primary">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="size-6"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                      />
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                      />
                    </svg>
                  </button>
                  <!-- Delete button -->
                  <button class="hover:text-primary" @click="showModal = true">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="size-6"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                      />
                    </svg>
                  </button>
                  <!-- Edit button -->
                  <button class="hover:text-primary">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="size-6"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                      />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </DefaultLayout>
</template>
