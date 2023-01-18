<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateExpenseForm from "./Partials/CreateExpenseForm.vue";

const props = defineProps({
    recurringPeriods: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Registrar Gasto">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Registrar Gasto
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateExpenseForm
                    :recurring-periods="recurringPeriods"
                    :categories="categories"
                />
            </div>
        </div>
    </AppLayout>
</template>
