<script setup lang="ts">
import { ref } from 'vue';

const defaultDeadline = new Date();
defaultDeadline.setDate(defaultDeadline.getDate() + 7);

const title = ref('');
const description = ref('');
const deadline = ref(formatDateForInput(defaultDeadline));

const emit = defineEmits<{
    (
        e: 'submit',
        task: {
            title: string;
            description: string;
            deadline: string;
        },
    ): void;
}>();

function submitForm() {
    emit('submit', {
        title: title.value,
        description: description.value,
        deadline: deadline.value.replace('T', ' ') + ':00',
    });

    title.value = '';
    description.value = '';
    deadline.value = '';
}

function formatDateForInput(date: Date): string {
    const pad = (n: number) => String(n).padStart(2, '0');
    const year = date.getFullYear();
    const month = pad(date.getMonth() + 1);
    const day = pad(date.getDate());
    const hours = pad(date.getHours());
    const minutes = pad(date.getMinutes());
    return `${year}-${month}-${day}T${hours}:${minutes}`;
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
                    ref="title"
                    v-model="title.value"
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
                    ref="description"
                    v-model="description.value"
                    class="focus:ring-none w-full resize-none overflow-hidden text-sm/[18px] break-words focus:outline-none"
                    autocomplete="off"
                    autocorrect="off"
                    spellcheck="false"
                    rows="1"
                    maxlength="500"
                ></textarea>
            </div>

            <Deadline v-model="deadline"/>

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
