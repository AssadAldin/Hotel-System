<script setup lang="ts">
import BreadcrumbDefault from "@/components/Breadcrumbs/BreadcrumbDefault.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";

import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

interface Room {
  id: number;
  number: number;
  floor: number;
}

const route = useRoute();
const room = ref<Room | null>(null);
const loading = ref(true);

const fetchRoom = async () => {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8000/api/rooms/${route.params.id}`
    );
    room.value = response.data.data;
  } catch (error) {
    console.error("Error fetching room:", error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchRoom();
});

const pageTitle = ref("Show Room");
</script>

<template>
  <DefaultLayout>
    <!-- Breadcrumb Start -->
    <BreadcrumbDefault :pageTitle="pageTitle" />
    <!-- Breadcrumb End -->
    <div>
      <h1>Room Details</h1>
      <div v-if="loading">Loading...</div>
      <div v-else-if="room">
        <p><strong>Room Number:</strong> {{ room.number }}</p>
        <p><strong>Floor:</strong> {{ room.floor }}</p>
        <!-- Add more fields as necessary -->
      </div>
      <div v-else>
        <p>Room not found</p>
      </div>
    </div>
    
  </DefaultLayout>
</template>
