<script setup lang="ts">
import { ref } from 'vue';
import Button from './ui/button/Button.vue';
import Card from './ui/card/Card.vue';

const title = ref('');
const description = ref('');

const emit = defineEmits<{
    (
        e: 'submit',
        title: string,
        description: string,
    ): void;
}>();

function submitForm() {
    emit('submit',
        title.value,
        description.value,
    );

    title.value = '';
    description.value = '';
}

</script>

<template>
    <div
        class="bg-card/70 inset-0 flex items-center justify-center backdrop-blur-sm"
        entity="task-create"
    >
        <Card
            class="border-accent shadow-accent max-h-[90vh] max-w-sm space-y-4 overflow-y-auto border px-4 py-3 shadow-2xl/100"
            @click.stop
        >
            <div>
                <p class="text-muted-foreground text-xs">Title:</p>

                <textarea
                    v-model="title"
                    class="w-full resize-none overflow-hidden text-2xl/[23px] font-bold break-words focus:outline-none"
                    autocomplete="off"
                    autocorrect="off"
                    spellcheck="false"
                    rows="1"
                    maxlength="100"
                />
            </div>

            <div>
                <p class="text-muted-foreground text-xs">Description:</p>

                <textarea
                    v-model="description"
                    class="focus:ring-none w-full resize-none overflow-hidden text-sm/[18px] break-words focus:outline-none"
                    autocomplete="off"
                    autocorrect="off"
                    spellcheck="false"
                    rows="1"
                    maxlength="500"
                ></textarea>
            </div>

            <div class="flex justify-end gap-1 pt-2">
                <Button
                    @click="submitForm"
                    variant="confirmative"
                    size="sm"
                >
                    Save
                </Button>
            </div>
        </Card>
    </div>
</template>
