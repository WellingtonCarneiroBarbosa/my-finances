<script setup>
defineProps({
    value: String,
    for: {
        type: String,
        default: null,
    },
});
</script>

<template>
    <label
        :for="for"
        class="block font-medium text-sm text-gray-700 dark:text-gray-300"
    >
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
