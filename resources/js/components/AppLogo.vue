<script lang="ts" setup>
import {usePage} from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';

const name = usePage().props.name;

</script>

<template>
    <div
        class="flex items-center justify-start rounded-md bg-sidebar-primary text-sidebar-primary-foreground"
    >
        <AppLogoIcon class="size-5 fill-current"/>
    </div>
    <!--    <div class="ml-1 grid flex-1 text-left text-sm">-->
    <!--        <span class="mb-0.5 truncate leading-tight font-semibold">{{-->
    <!--            name-->
    <!--        }}</span>-->
    <!--    </div>-->
</template>
