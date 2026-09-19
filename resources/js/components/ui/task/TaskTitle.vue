<script setup lang="ts">
import { nextTick, onMounted, ref, watch } from 'vue';

const title = defineModel<string | null>('title');

const titleRef = ref<HTMLTextAreaElement | null>(null);

function autoResize(): void {
    const titleElement = titleRef.value;

    if (!titleElement) {
        return;
    }

    titleElement.style.height = 'auto';
    titleElement.style.height = titleElement.scrollHeight + 'px';
}

onMounted(() => {
    autoResize();
});

watch(title, async () => {
    await nextTick();
    autoResize();
});
</script>

<template>
    <textarea
        ref="titleRef"
        v-model="title"
        class="w-full resize-none overflow-hidden text-2xl/[23px] font-bold break-words focus:outline-none"
        autocomplete="off"
        autocorrect="off"
        spellcheck="false"
        rows="1"
        maxlength="100"
    />
</template>
