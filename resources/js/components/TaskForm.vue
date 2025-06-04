<template>
    <form @submit.prevent="submitForm" class="flex flex-col rounded-xl gap-2 bg-popup p-4 rounded">
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
</template>
