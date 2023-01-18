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

const form = useForm({
    name: "",
    description: "",
    amount: "",
    date: "",
    is_recurring: false,
    recurring_period: "",
});

const registerExpense = () => {
    form.post(route("dashboard.expenses.store"), {
        errorBag: "registerExpense",
        preserveScroll: true,
    });
};
</script>

<template>
    <FormSection @submitted="registerExpense">
        <template #title> Informações do Gasto </template>

        <template #description>
            Adicione as informações do gasto. Um registro bem detalhado
            facilitará a organização das suas despesas e geração de relatórios.
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
                <InputLabel for="category" value="Categoria" />

                <div class="flex flex-row">
                    <SelectInput
                        id="category"
                        v-model="form.category"
                        type="text"
                        class="block w-full mt-1"
                        :options="categories"
                    />
                    <PrimaryButton type="button" class="ml-2"
                        >Adicionar Categoria
                    </PrimaryButton>
                </div>

                <InputError :message="form.errors.category" class="mt-2" />
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
                <InputLabel for="date" value="Data do Gasto (ou prevista)" />

                <TextInput
                    id="date"
                    v-model="form.date"
                    type="date"
                    class="block mt-1"
                />
                <InputError :message="form.errors.date" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="is_recurring" value="Gasto Recorrente?" />

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
