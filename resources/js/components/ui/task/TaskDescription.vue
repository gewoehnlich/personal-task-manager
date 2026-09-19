<script setup lang="ts">
import { nextTick, onMounted, ref, watch } from 'vue';

const description = defineModel<string | null>('description');

const descriptionRef = ref<HTMLTextAreaElement | null>(null);

function autoResize(): void {
    const descriptionElement = descriptionRef.value;

    if (!descriptionElement) {
        return;
    }

    descriptionElement.style.height = 'auto';
    descriptionElement.style.height = descriptionElement.scrollHeight + 'px';
}

onMounted(() => {
    autoResize();
});

watch(description, async () => {
    await nextTick();
    autoResize();
});
</script>

<template>
    <textarea
        ref="descriptionRef"
        v-model="description"
        class="focus:ring-none w-full resize-none overflow-hidden text-sm/[18px] break-words focus:outline-none"
        autocomplete="off"
        autocorrect="off"
        spellcheck="false"
        rows="1"
        maxlength="500"
    />
</template>
