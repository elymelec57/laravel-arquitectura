<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as postsIndex, create as postsCreate, edit as postsEdit, destroy as postsDestroy } from '@/routes/posts';

interface Post {
    id: number;
    title: string;
    content: string;
}

defineProps<{
    posts: Post[];
}>();

const form = useForm({});

const deletePost = (post: Post) => {
    if (confirm('¿Estás seguro de eliminar este post?')) {
        form.delete(postsDestroy.url(post.id));
    }
};
</script>

<template>
    <AppLayout>
        <Head title="Posts" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-100">
                                Gestión de Posts (SOLID)
                            </h2>
                            <Link 
                                :href="postsCreate.url()" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition"
                            >
                                Crear Nuevo Post
                            </Link>
                        </div>

                        <div v-if="$page.props.flash?.message" class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                            {{ $page.props.flash.message }}
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                                <thead class="bg-zinc-50 dark:bg-zinc-800">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Título</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Contenido</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-zinc-200 dark:bg-zinc-900 dark:divide-zinc-800">
                                    <tr v-for="post in posts" :key="post.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-zinc-500 dark:text-zinc-400">
                                            {{ post.id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-zinc-900 dark:text-zinc-100 font-medium">
                                            {{ post.title }}
                                        </td>
                                        <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400 truncate max-w-xs">
                                            {{ post.content }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-3">
                                            <Link 
                                                :href="postsEdit.url(post.id)" 
                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                            >
                                                Editar
                                            </Link>
                                            <button 
                                                @click="deletePost(post)" 
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                            >
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="posts.length === 0">
                                        <td colspan="4" class="px-6 py-4 text-center text-zinc-500">
                                            No hay posts registrados.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
