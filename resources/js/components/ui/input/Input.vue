<script lang="ts" setup>
import type {HTMLAttributes} from "vue"
import {useVModel} from "@vueuse/core"
import {cn} from "@/lib/utils"

const props = defineProps<{
    defaultValue?: string | number
    modelValue?: string | number
    class?: HTMLAttributes["class"]
}>()

const emits = defineEmits<{
    (e: "update:modelValue", payload: string | number): void
}>()

const modelValue = useVModel(props, "modelValue", emits, {
    passive: true,
    defaultValue: props.defaultValue,
})
</script>

<template>
    <input
        v-model="modelValue"
        :class="cn(
      'border-input focus:border-primary focus:outline-none focus:ring-0 focus-visible:ring-0 h-9 w-full min-w-0 rounded-sm border px-3 py-1 shadow-xs placeholder:text-muted-foreground placeholder:text-body-lg text-body-lg',
      props.class,
    )"
        data-slot="input"
    >
</template>
