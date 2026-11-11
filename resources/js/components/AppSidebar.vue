<script lang="ts" setup>
import {useStore} from '@/../stores/stores'
import {Link, usePage} from '@inertiajs/vue3';
import BoardIcon from '@/components/icons/BoardIcon.vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    useSidebar,
} from '@/components/ui/sidebar';
import {dashboard} from '@/routes';
import type {NavItem} from '@/types';
import {computed, ComputedRef, inject, ref} from "vue";
import {boardsKey} from "@/types/injection-keys";

const {isMobile, toggleSidebar, state} = useSidebar();
const store = useStore();
const page = usePage();
const boards = inject(boardsKey, computed(() => []));
const mainNavItems: ComputedRef<NavItem[]> = computed(() => getNavItems());

store.activeBoard = mainNavItems.value[0] ? mainNavItems.value[0].title :
    'No Boards';
store.boardsCount = boards.value!.length;
const footerNavItems: NavItem[] = [];

const showMobile = ref(false);

function toggleMobile() {
    showMobile.value = !showMobile.value
}

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
    <div v-if="isMobile && showMobile"
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
        <SidebarHeader class="mb-10">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton as-child size="lg">
                        <Link :href="dashboard()">
                            <AppLogo/>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems"/>
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems"/>
        </SidebarFooter>
    </Sidebar>
    <slot/>
</template>
