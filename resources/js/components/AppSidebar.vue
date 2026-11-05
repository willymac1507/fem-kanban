<script lang="ts" setup>
import {useStore} from '@/../stores/stores'
import {Link} from '@inertiajs/vue3';
import BoardIcon from '@/components/icons/BoardIcon.vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
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
import {ref} from "vue";

const {isMobile, toggleSidebar, state} = useSidebar();

const store = useStore();

const boards = store.boards;
const mainNavItems: NavItem[] = getNavItems();
store.activeBoard = mainNavItems[0] ? mainNavItems[0].title : 'No Boards';
const footerNavItems: NavItem[] = [];

const showMobile = ref(false);

function toggleMobile() {
    showMobile.value = !showMobile.value
}

function getNavItems() {
    let items = [];
    for (let i = 0; i < boards!.length; i++) {
        items.push({
            title: boards![i].name,
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
        <div class="flex flex-col items-center w-3/4 bg-medium-gray rounded-xl h-1/2 mt-20 z-10">
            <button class="my-auto bg-primary p-4 cursor-pointer" @click="toggleSidebar">Click</button>
        </div>
    </div>
    <Sidebar v-else class="border-r border-lines" collapsible="offcanvas" variant="inset">
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
            <NavUser/>
        </SidebarFooter>
    </Sidebar>
    <slot/>
</template>
