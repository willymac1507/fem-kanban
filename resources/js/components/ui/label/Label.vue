<script lang="ts" setup>
import type {LabelProps} from "reka-ui"
import {Label} from "reka-ui"
import type {HTMLAttributes} from "vue"
import {reactiveOmit} from "@vueuse/core"
import {cn} from "@/lib/utils"

const props = defineProps<LabelProps & { class?: HTMLAttributes["class"] }>()

const delegatedProps = reactiveOmit(props, "class")
</script>

<template>
    <Label
        :class="
      cn(
        'mb-2 text-xs font-bold flex items-center gap-2 leading-none select-none group-data-[disabled=true]:pointer-events-none group-data-[disabled=true]:opacity-50 peer-disabled:cursor-not-allowed peer-disabled:opacity-50',
        props.class,
      )
    "
        data-slot="label"
        v-bind="delegatedProps"
    >
        <slot/>
    </Label>
</template>
