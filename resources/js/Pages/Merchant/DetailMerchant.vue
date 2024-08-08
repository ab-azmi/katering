<script setup lang="ts">
import { Merchant } from '@/types';
import MenuCard from '@/Components/MenuCard.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Separator from '@/Components/ui/separator/Separator.vue';
import Button from '@/Components/ui/button/Button.vue';
import { ArrowLeft } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';


defineProps<{
    merchant: Merchant;
}>();

</script>
<template>
    <GuestLayout>
        <Link :href="route('home')" as="button">
            <Button class="text-sm mt-3">
                <ArrowLeft class="h-6"/>
            </Button>
        </Link>
        <div class="my-5">
            <h1 class="text-4xl font-semibold">{{ merchant.name }}</h1>
            <p class="italic text-slate-500">{{ merchant.address }}</p>
            <Separator class="my-3"/>
            <p class="">{{ merchant.description }}</p>
        </div>
        <h2 class="text-2xl mb-3 font-semibold text-slate-600">Menus</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4" >
            <MenuCard :menu="menu" v-for="menu in merchant.menus" :key="menu.id"/>
        </div>
    </GuestLayout>
</template>