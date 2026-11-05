import type {InertiaLinkProps} from '@inertiajs/vue3';
import {Component} from "vue";

export type BreadcrumbItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
};

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: Component<any>;
    isActive?: boolean;
};
