<script setup>
import { onMounted, ref } from "vue";

defineProps({
    id: {
        type: String,
        required: true,
    },
    modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="flex flex-col items-start">
        <div class="cursor-pointer rounded-full relative shadow-sm">
            <input
                :id="id"
                ref="input"
                type="checkbox"
                class="focus:outline-none checkbox w-4 h-4 rounded-full bg-white absolute m-1 shadow-sm appearance-none cursor-pointer"
                @change="$emit('update:modelValue', $event.target.checked)"
            />
            <label
                :for="id"
                class="toggle-label dark:bg-gray-700 block w-12 h-6 overflow-hidden rounded-full bg-gray-300 cursor-pointer"
            ></label>
        </div>
    </div>
</template>

<script>
export default {
    name: "ToggleInput",
};
</script>

<style>
.checkbox:checked {
    /* Apply class right-0*/
    right: 0;
}
.checkbox:checked + .toggle-label {
    /* Apply class bg-indigo-700 */
    background-color: #4c51bf;
}
</style>
