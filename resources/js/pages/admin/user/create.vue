<script setup lang="ts">
import { Head, useForm} from '@inertiajs/vue3';

import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card';
import InputError from '@/components/InputError.vue';
import type { BreadcrumbItem } from '@/types';

import { store } from '@/routes/admin/users';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Usuarios', href: '/admin/users' },
    { title: 'Registrar', href: '/admin/users/create' },
];

const form = useForm({
    name: '',
    email: '',
    password: '',
});

const submit = () => {
    form.post(store().url, {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Registrar Usuario" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col items-center justify-center min-h-[60vh] py-12 px-4 sm:px-6 lg:px-8">
            <Card class="w-full max-w-md shadow-lg transition-all duration-300 hover:shadow-xl border-slate-200 dark:border-slate-800">
                <CardHeader class="space-y-1">
                    <CardTitle class="text-2xl font-bold tracking-tight">Registrar nuevo usuario</CardTitle>
                    <p class="text-sm text-muted-foreground">Completa los datos para dar de alta un nuevo administrador.</p>
                </CardHeader>

                <CardContent>
                    <form @submit.prevent="submit" class="space-y-5">
                        <div class="grid gap-2">
                            <Label for="name" class="text-sm font-medium">Nombre de usuario</Label>
                            <Input
                                id="name"
                                type="text"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="p. ej. jsmith"
                                class="transition-colors focus-visible:ring-primary"
                            />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email" class="text-sm font-medium">Correo electrónico</Label>
                            <Input
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autocomplete="email"
                                placeholder="usuario@ejemplo.com"
                                class="transition-colors focus-visible:ring-primary"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="password" class="text-sm font-medium">Contraseña</Label>
                            <Input
                                id="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="transition-colors focus-visible:ring-primary"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="pt-2">
                            <Button type="submit" class="w-full font-semibold transition-all hover:scale-[1.01]" :disabled="form.processing">
                                <template v-if="form.processing">
                                    <span class="mr-2 h-4 w-4 animate-spin rounded-full border-2 border-current border-t-transparent"></span>
                                    Procesando...
                                </template>
                                <template v-else>
                                    Registrar administrador
                                </template>
                            </Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
