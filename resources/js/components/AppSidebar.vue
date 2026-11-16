<script lang="ts" setup>
import {useStore} from '@/../stores/stores'
import {usePage} from '@inertiajs/vue3';
import BoardIcon from '@/components/icons/BoardIcon.vue';
import NavMain from '@/components/nav/NavMain.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    useSidebar,
} from '@/components/ui/sidebar';
import {dashboard} from '@/routes';
import type {NavItem} from '@/types';
import {computed, ComputedRef, inject, watch} from "vue";
import {boardsKey} from "@/types/injection-keys";
import HideSidebarIcon from "@/components/icons/HideSidebarIcon.vue";

const {isMobile, toggleSidebar, state} = useSidebar();
const store = useStore();
const page = usePage();
const boards = inject(boardsKey, computed(() => []));
const mainNavItems: ComputedRef<NavItem[]> = computed(() => getNavItems());

store.activeBoard = mainNavItems.value[0] ? mainNavItems.value[0].title :
    'No Boards';
store.boardsCount = boards.value!.length;

watch(state, () => {
    store.sidebarState = state.value;
})

function getNavItems() {
    let items = [];
    for (let i = 0; i < boards.value!.length; i++) {
        items.push({
            title: boards.value![i].name,
            href: dashboard(),
            icon: BoardIcon,
        });
    }
    return items;
}
</script>

<template>
    <div v-if="isMobile"
         class="flex flex-col items-center absolute inset-0 w-screen h-screen z-5 bg-black opacity-65">
        <div
            class="flex flex-col items-center w-3/4 bg-medium-gray rounded-xl h-1/2 mt-20 z-10">
            <button class="my-auto bg-primary p-4 cursor-pointer"
                    @click="toggleSidebar">Click
            </button>
        </div>
    </div>

    <Sidebar v-else class="border-r border-lines" collapsible="offcanvas"
             variant="inset">

        <SidebarContent class="pt-4">
            <NavMain :items="mainNavItems"/>
        </SidebarContent>

        <SidebarFooter>
            <button
                class="font-bold text-heading-md leading-4.75 flex flex-row items-center gap-2 px-4 py-2 text-sm text-medium-gray cursor-pointer"
                @click="toggleSidebar">
                <HideSidebarIcon class="size-6"/>
                <span class="pb-2">Hide Sidebar</span>
            </button>
        </SidebarFooter>
    </Sidebar>
    <slot/>
</template>
