<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as postsIndex, update as postsUpdate } from '@/routes/posts';

interface Post {
    id: number;
    title: string;
    content: string;
}

const props = defineProps<{
    post: Post;
}>();

const form = useForm({
    title: props.post.title,
    content: props.post.content,
});

const submit = () => {
    form.put(postsUpdate.url(props.post.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout>
        <Head :title="`Editar Post #${post.id}`" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100">
                            Editar Post
                        </h2>
                        <Link 
                            :href="postsIndex.url()" 
                            class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200"
                        >
                            Volver a Posts
                        </Link>
                    </div>

                    <form @submit.prevent="submit" class="space-y-6 max-w-2xl">
                        <div>
                            <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                Título
                            </label>
                            <input 
                                id="title"
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full rounded-md border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 bg-transparent border"
                                required 
                            />
                            <div v-if="form.errors.title" class="text-sm text-red-600 mt-2">
                                {{ form.errors.title }}
                            </div>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                Contenido
                            </label>
                            <textarea 
                                id="content"
                                v-model="form.content"
                                rows="6"
                                class="mt-1 block w-full rounded-md border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 bg-transparent border"
                                required 
                            ></textarea>
                            <div v-if="form.errors.content" class="text-sm text-red-600 mt-2">
                                {{ form.errors.content }}
                            </div>
                        </div>

                        <div class="flex justify-start">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition disabled:opacity-50"
                            >
                                <span v-if="form.processing">Actualizando...</span>
                                <span v-else>Actualizar Post</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
