<script setup lang="ts">
import { ref, Ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import Stage       from './Stage.vue';
import TaskModal   from './TaskModal.vue';
import type { TaskType } from '@/types';

type PageProps = {
  tasks: TaskType[],
}

const page = usePage<PageProps>();
const selectedTask = ref<TaskType | null>(null);

const tasks = computed(
  () => page.props.tasks.filter(
    (task) => task.deleted === 0,
  )
);

const pending = filterTasksByStage(tasks, "pending");
const active  = filterTasksByStage(tasks, "active");
const delayed = filterTasksByStage(tasks, "delayed");
const done    = filterTasksByStage(tasks, "done");

function filterTasksByStage(
  tasks: Ref<TaskType[]>,
  stage: string,
) {
  return computed(
    () => tasks.value.filter(
      task => task.stage === stage
    )
  );
}

function handleTaskDrop(
  taskId:   number,
  newStage: string,
) {
  const task = tasks.value.find(
    task => task.id === taskId
  );

  if (task) {
    task.stage = newStage;
    router.put(`/tasks/${task.id}`, task);
  }
}

function handleCreateTask(
  task: Omit<TaskType, 'id'>,
): void {
  router.post('/tasks', task);
}

function handleTaskReorder(
  draggedId: number,
  targetId: number,
) {
  const draggedTask = tasks.value.find(
    task => task.id === draggedId
  );

  const targetTask = tasks.value.find(
    task => task.id === targetId
  );

  if (!draggedTask || !targetTask) return;

  draggedTask.stage = targetTask.stage;
  router.put(`/tasks/${draggedTask.id}`, draggedTask);
}

function openTaskModal(
  task: TaskType
) {
  selectedTask.value = task;
}

function closeTaskModal() {
  selectedTask.value = null;
}

function handleUpdateTask(
  task: Omit<TaskType, 'id'>,
): void {
  router.put(`/tasks/${task.id}`, task);
}

function handleDeleteTask(
  task: Omit<TaskType, 'id'>,
): void {
  router.delete(`/tasks/${task.id}`);
}
</script>

<template>
  <div class="
    kanban
    grid
    grid-cols-4
    h-full
    gap-10
  ">
    <div class="
      overflow-hidden
      rounded-xl
      border
      border-sidebar-border/70
      dark:border-sidebar-border
    ">
      <Stage
        title="pending"
        :tasks="pending"
        @task-drop="handleTaskDrop"
        @create-task="handleCreateTask"
        @reorder-task="handleTaskReorder"
        @task-clicked="openTaskModal"
      />
    </div>

    <div class="
      overflow-hidden
      rounded-xl
      border
      border-sidebar-border/70
      dark:border-sidebar-border
    ">
      <Stage
        title="active"
        :tasks="active"
        @task-drop="handleTaskDrop"
        @create-task="handleCreateTask"
        @reorder-task="handleTaskReorder"
        @task-clicked="openTaskModal"
      />
    </div>

    <div class="
      overflow-hidden
      rounded-xl
      border
      border-sidebar-border/70
      dark:border-sidebar-border
    ">
      <Stage
        title="delayed"
        :tasks="delayed"
        @task-drop="handleTaskDrop"
        @create-task="handleCreateTask"
        @reorder-task="handleTaskReorder"
        @task-clicked="openTaskModal"
      />
    </div>

    <div class="
      overflow-hidden
      rounded-xl
      border
      border-sidebar-border/70
      dark:border-sidebar-border
    ">
      <Stage
        title="done"
        :tasks="done"
        @task-drop="handleTaskDrop"
        @create-task="handleCreateTask"
        @reorder-task="handleTaskReorder"
        @task-clicked="openTaskModal"
      />
    </div>
  </div>

  <TaskModal
    v-if="selectedTask"
    :task="selectedTask"
    @close="closeTaskModal"
    @delete="handleDeleteTask"
    @update="handleUpdateTask"
  />
</template>
