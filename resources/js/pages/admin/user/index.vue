<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

defineProps<{
    users: Array<any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/admin/users',
    },
];
</script>

<template>
    <Head title="Users Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="px-4 py-8 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Users</h1>
                    <p class="mt-2 text-sm text-slate-600">A detailed list of all registered users with the 'User' role.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <Link 
                        href="/admin/users/create" 
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-center text-sm font-semibold text-white shadow-lg shadow-indigo-200 hover:bg-indigo-500 hover:-translate-y-0.5 transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 active:scale-95"
                    >
                        <svg class="w-5 h-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create User
                    </Link>
                </div>
            </div>
            
            <div class="mt-10 overflow-hidden bg-white shadow-xl shadow-slate-200/50 ring-1 ring-slate-200 sm:rounded-2xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th scope="col" class="py-4 pl-6 pr-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500">ID</th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Name</th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Email</th>
                                <th scope="col" class="px-3 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">Role</th>
                                <th scope="col" class="relative py-4 pl-3 pr-6 text-right">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            <tr v-for="user in users" :key="user.id" class="hover:bg-indigo-50/30 transition-colors duration-150 group">
                                <td class="whitespace-nowrap py-5 pl-6 pr-3 text-sm font-medium text-slate-400 group-hover:text-indigo-600 transition-colors">
                                    #{{ user.id }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm">
                                    <div class="flex items-center">
                                        <div class="h-9 w-9 flex-shrink-0">
                                            <div class="h-full w-full rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xs ring-2 ring-white shadow-sm">
                                                {{ user.name.charAt(0).toUpperCase() }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-semibold text-slate-900">{{ user.name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm text-slate-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ user.email }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-5 text-sm">
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        User
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-5 pl-3 pr-6 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <button class="text-slate-400 hover:text-indigo-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="text-slate-400 hover:text-rose-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="!users || users.length === 0" class="flex flex-col items-center justify-center py-20 bg-white">
                    <div class="h-20 w-20 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="text-base font-semibold text-slate-900">No users found</p>
                    <p class="text-sm text-slate-500 mt-1">Get started by creating your first user.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
