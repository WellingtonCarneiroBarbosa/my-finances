<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateIncomeForm from "./Partials/CreateIncomeForm.vue";

defineProps({
    recurringPeriods: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Adicionar Receita">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Adicionar Receita
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateIncomeForm :recurring-periods="recurringPeriods" />
            </div>
        </div>
    </AppLayout>
</template>
