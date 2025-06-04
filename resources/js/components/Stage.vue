<script setup lang="ts">
import { ref, computed } from 'vue';
import Task from './Task.vue';

const props = defineProps<{
    title: string;
    tasks: Array<{
        id: number;
        userId: number;
        title: string;
        description?: string;
        taskStatus: string;
        deadline: string;
        updated_at: string;
        created_at: string;
    }>;
}>();

const emit = defineEmits<{
    (e: 'task-drop', taskId: number, newStatus: string): void;
    (e: 'create-task', task: {
        title: string;
        description: string;
        taskStatus: string;
        deadline: string;
    }): void;
}>();

const showForm = ref(false);
const newTitle = ref('');
const newDescription = ref('');
const newDeadline = ref('');
const length = computed(() => props.tasks.length);


function handleDrop(event: DragEvent) {
    const taskId = parseInt(event.dataTransfer?.getData('task-id') || '', 10);
    if (!isNaN(taskId)) {
        emit('task-drop', taskId, props.title);
    }
}

function submitForm() {
    if (!newTitle.value.trim()) return;

    emit('create-task', {
        title: newTitle.value,
        description: newDescription.value,
        taskStatus: props.title,
        deadline: newDeadline.value
    });

    newTitle.value = '';
    newDescription.value = '';
    newDeadline.value = '';
    showForm.value = false;
}

</script>

<template>
    <div class="stage h-full flex flex-col gap-2" @dragover.prevent @drop="handleDrop">
        <div class="flex justify-between py-2 px-5 gap-5">
            <h2 class="text-2xl font-bold mb-2 text-center">{{ title }}</h2>
            <h2 class="font-bold text-2xl text-center">{{ length }}</h2>
        </div>

        <div class="px-1">
            <button class="bg-input hover:bg-popover text-popover-foreground w-full px-4 py-2 rounded-xl" @click="showForm = !showForm">Добавить новую задачу</button>
        </div>

        <div v-if="showForm" class="px-5">
            <form @submit.prevent="submitForm" class="flex flex-col gap-2 bg-gray-100 p-4 rounded">
                <input
                    v-model="newTitle"
                    type="text"
                    placeholder="название"
                    class="border p-2 rounded"
                    required
                />

                <textarea
                    v-model="newDescription"
                    placeholder="описание"
                    class="border p-2 rounded"
                ></textarea>

                <input
                    v-model="newDeadline"
                    type="text"
                    placeholder="крайний срок"
                    class="border p-2 rounded"
                    required
                />

                <button
                    type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
                >
                    сохранить
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 gap-1 p-1 overflow-y-auto">
            <Task v-for="task in tasks" :key="task.id" :task="task" />
        </div>
    </div>
</template>

