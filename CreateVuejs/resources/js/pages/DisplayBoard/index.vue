<script setup>
import { defineProps } from 'vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

defineProps({
    posts: Array
});

const showForm = ref(false);
const closeModal = () => {
    showForm.value = false;
};
const form = ref({
    title: '',
    image: null,
    description: ''
});

const handleFileUpload = (event) => {
    form.value.image = event.target.files[0];
};

const createDisplayBoard = () => {
    const formData = new FormData();
    formData.append('title', form.value.title);
    formData.append('image', form.value.image);
    formData.append('description', form.value.description);

    router.post('/displayboard', formData, {
        onSuccess: () => {
            showForm.value = false;
            form.value = { title: '', image: null, description: '' };
        },
        onError: () => {
            alert("An error occurred while creating the display board.");
        }
    });
};
</script>

<template>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Display Board</h1>

        <button @click="showForm = true"
            class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 mb-6">
            + Create New DisplayBoard
        </button>

        <div v-if="showForm" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
            <div class="bg-white rounded-lg shadow-xl p-8 w-96">
                <h2 class="text-2xl font-semibold mb-4">Create New DisplayBoard</h2>
                <form @submit.prevent="createDisplayBoard">
                    <input type="text" v-model="form.title" placeholder="Title" required
                        class="w-full p-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <input type="file" @change="handleFileUpload" required
                        class="w-full p-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

                    <textarea v-model="form.description" placeholder="Description" required
                        class="w-full p-3 mb-4 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                    <div class="flex justify-between items-center">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Submit
                        </button>
                        <button type="button" @click="closeModal"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

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