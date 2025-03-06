<script setup>
import { defineProps } from 'vue';

defineProps({
    posts: Array
});
</script>

<template>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Display Board</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="post in posts" :key="post.id" class="bg-white shadow-lg rounded-lg p-4">
                <img class="w-48 h-48 object-cover rounded-md mb-4" :src="`/storage/${post.image}`" alt="Post Image"
                    v-if="post.image">
                <h2 class="text-xl font-semibold mt-4">{{ post.title }}</h2>
                <p class="text-gray-600 mt-2">{{ post.description }}</p>
            </div>
        </div>
    </div>
</template>