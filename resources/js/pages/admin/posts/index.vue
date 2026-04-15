<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

defineProps<{
    posts: Array<any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/admin/posts',
    },
];
</script>

<template>
    <Head title="Posts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-4 py-8 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-bold leading-6 text-gray-900">Posts</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the posts including their title, description, and author ID.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <Link href="/admin/posts/create" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Create Post
                    </Link>
                </div>
            </div>
            
            <div class="mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User ID</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr v-for="post in posts" :key="post.id" class="hover:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ post.id }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ typeof post.title === 'string' ? post.title : (post.title?.title || '-') }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ typeof post.description === 'string' ? post.description : (post.description?.description || '-') }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ typeof post.user_id === 'number' ? post.user_id : (post.user_id?.userId || post.user_id?.user_id || '-') }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <Link href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, {{ typeof post.title === 'string' ? post.title : post.title?.title }}</span></Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="!posts || posts.length === 0" class="text-center py-12 bg-white">
                    <p class="text-sm text-gray-500">No posts found.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
