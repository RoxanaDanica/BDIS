<script setup lang="ts">
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
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { UserRound, ClipboardList, ChartNoAxesColumn, LogOut } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Gestionare Pacienti',
        href: 'gestionare-pacienti',
        icon: UserRound,
    },
    {
        title: 'Gestionare Consultații',
        href: 'gestionare-consultatii',
        icon: ClipboardList,
    },
     {
        title: 'Rapoarte și statistici',
        href: 'rapoarte-si-statistici',
        icon: ChartNoAxesColumn,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Logout',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: LogOut,
    },
];
</script>

<template>
    <Sidebar class="bg-[#1D4F8B] " collapsible="icon" variant="inset">
        <SidebarHeader class="bg-[#2B6AAE] ">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="bg-[#1D4F8B] ">
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter class="bg-[#1D4F8B] ">
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
