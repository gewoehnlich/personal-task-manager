<script setup lang="ts">
import {
  TimeFieldInput,
  TimeFieldRoot,
} from 'reka-ui'
</script>

<template>
<div class="flex flex-col gap-2">
    <TimeFieldRoot
      id="birthday"
      v-slot="{ segments }"
      :hour-cycle="24"
      class="flex select-none bg-muted items-center rounded-lg shadow-sm text-center text-green10 p-1 data-[invalid]:border-red-500 text-sm"
    >
      <template
        v-for="item in segments"
        :key="item.part"
      >
        <TimeFieldInput
          v-if="item.part === 'literal'"
          :part="item.part"
        >
          {{ item.value }}
        </TimeFieldInput>
        <TimeFieldInput
          v-else
          :part="item.part"
          class="rounded p-0.5 focus:outline-none focus:shadow-[0_0_0_2px] focus:shadow-black data-[placeholder]:text-green9"
        >
          {{ item.value }}
        </TimeFieldInput>
      </template>
    </TimeFieldRoot>
  </div>
</template>

