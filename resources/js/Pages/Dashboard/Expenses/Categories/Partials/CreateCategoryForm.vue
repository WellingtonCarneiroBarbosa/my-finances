<script setup>
import { useForm } from "@inertiajs/vue3";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";

const props = defineProps({
    shouldRedirect: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(["created"]);

const form = useForm({
    name: "",
    description: "",
    color: "#fff",
    should_redirect: props.shouldRedirect,
});

const createCategory = () => {
    form.post(route("dashboard.expenses.categories.store"), {
        errorBag: "createCategory",
        preserveScroll: true,
        onSuccess: (response) => {
            form.reset("name", "description", "color");
            created(response.props.flash.data.category);
        },
    });
};

const created = (data) => {
    emit("created", data);
};
</script>

<template>
    <FormSection @submitted="createCategory">
        <template #title> Informações da Categoria </template>

        <template #description>
            Adicione informações para a categoria. Uma categoria bem detalhada
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
                <InputLabel for="color" value="Cor" />

                <div class="flex align-items-center justify-content-center">
                    <v-color-picker
                        id="color"
                        v-model="form.color"
                        class="block mt-1"
                        hide-canvas="true"
                        hide-inputs="true"
                        show-swatches="true"
                        hide-sliders="true"
                    ></v-color-picker>
                    <div
                        class="w-7 h-7 rounded-full ml-2"
                        :style="{ backgroundColor: form.color }"
                    ></div>
                </div>

                <InputError :message="form.errors.color" class="mt-2" />
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
