<script setup>
import { useForm } from "@inertiajs/vue3";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import ToggleInput from "@/Components/ToggleInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

defineProps({
    recurringPeriods: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    name: "",
    description: "",
    amount: "",
    date: "",
    is_recurring: false,
    recurring_period: "",
});

const createIncome = () => {
    form.post(route("dashboard.incomes.store"), {
        errorBag: "createIncome",
        preserveScroll: true,
    });
};
</script>

<template>
    <FormSection @submitted="createIncome">
        <template #title> Detalhes da Receita </template>

        <template #description>
            Cadastre uma nova fonte de receita para o seu orçamento. Caso a data
            de entrada seja futura, entrará no calendário de recebíveis.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Nome" />

                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="block w-full mt-1"
                    autofocus
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="description" value="Descrição" />

                <TextArea
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="block w-full mt-1"
                />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="amount" value="Valor" />

                <TextInput
                    id="amount"
                    v-model="form.amount"
                    type="text"
                    class="block mt-1"
                />
                <InputError :message="form.errors.amount" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="date" value="Data da Entrada (ou prevista)" />

                <TextInput
                    id="date"
                    v-model="form.date"
                    type="date"
                    class="block mt-1"
                />
                <InputError :message="form.errors.date" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="is_recurring" value="Pagamento Recorrente?" />

                <ToggleInput
                    id="is_recurring"
                    v-model="form.is_recurring"
                    class="block mt-1"
                />

                <InputError :message="form.errors.is_recurring" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4" v-if="form.is_recurring">
                <InputLabel for="recurring_period" value="Período" />

                <SelectInput
                    id="recurring_period"
                    v-model="form.recurring_period"
                    :options="recurringPeriods"
                    class="block mt-1"
                />

                <InputError
                    :message="form.errors.recurring_period"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Adicionar
            </PrimaryButton>
        </template>
    </FormSection>
</template>
