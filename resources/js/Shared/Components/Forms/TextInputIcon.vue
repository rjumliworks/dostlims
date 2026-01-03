<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    light: Boolean,
    icon: String,
    readonly: Boolean
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="form-icon">
        <input type="text" class="form-control form-control-icon" id="iconInput" placeholder="example@gmail.com" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" style="min-height: 38.4px !important;" :style="(light) ? 'background-color: #f5f6f7;' : ''" :readonly="readonly">
        <i class="ri-mail-unread-line"></i>
    </div>
</template>
<style scoped>
input::placeholder {
    font-size: 12px;
}
</style>