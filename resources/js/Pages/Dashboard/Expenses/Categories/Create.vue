<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateCategoryForm from "./Partials/CreateCategoryForm.vue";
</script>

<template>
    <AppLayout title="Adicionar Categoria">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Adicionar Categoria
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateCategoryForm />
            </div>
        </div>
    </AppLayout>
</template>
