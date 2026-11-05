<script lang="ts" setup>
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import {useCurrentUrl} from '@/composables/useCurrentUrl';
import type {NavItem} from '@/types';
import {ref} from "vue";
import {useStore} from '@/../stores/stores'

const props = defineProps<{
    items: NavItem[];
}>();

const {isCurrentUrl} = useCurrentUrl();
const activeBoard = ref(props.items[0] ? props.items[0].title : 'No Boards')
const store = useStore()
</script>

<template>
    <SidebarGroup class="pr-6 py-0">
        <SidebarGroupLabel>Platform</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-if="items.length === 0">None</SidebarMenuItem>
            <SidebarMenuItem v-for="item in items" v-else :key="item.title">
                <div :class="item.title === activeBoard ? 'text-primary bg-main-purple' : 'text-neutral-600'"
                     class="flex items-center gap-2 rounded-r-full">
                    <SidebarMenuButton
                        :is-active="item.title === activeBoard"
                        :tooltip="item.title"
                        as-child
                    >
                        <button class="cursor-pointer" @click="activeBoard = store.activeBoard = item.title">
                            <component :is="item.icon"/>
                            <span>{{ item.title }}</span>
                        </button>
                    </SidebarMenuButton>
                </div>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
