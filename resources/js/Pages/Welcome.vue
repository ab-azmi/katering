<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import MerchantCard from '@/Pages/Merchant/MerchantCard.vue';
import { Merchant, Paginated } from '@/types';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import MerchantFilter from '@/Pages/Merchant/MerchantFilter.vue';
import { ref, watch, computed } from 'vue';
import Paginate from '@/Components/Paginate.vue';
import { router } from '@inertiajs/vue3'
import { useDebounceFn } from '@vueuse/core'

const props = defineProps<{
    merchants: Paginated<Merchant[]>;
    canLogin?: boolean;
    canRegister?: boolean;
    search?: string;
}>();

const searchInput = ref<string>(props.search ?? '');

const querySearch = () => {
    router.visit(route('home', { search: searchInput.value }), {
        only: ['merchants', 'search'],
    });
}

watch(searchInput, () => {
    if(searchInput.value === '') {
        router.visit(route('home'), {
            only: ['merchants', 'search'],
        });
    }
});

</script>

<template>

    <Head title="Welcome"/>

    <GuestLayout>
        <header >
          <Navbar :canLogin="canLogin" :canRegister="canRegister"/>
        </header>

        <main class="mt-12">
            <h1 class="text-3xl font-bold my-7">
                Merchants
            </h1>
            <MerchantFilter v-model="searchInput" @keyup.enter="querySearch"/>
            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <template v-for="merchant in merchants.data" :key="merchant.id">
                    <MerchantCard :merchant="merchant"/>
                </template>
            </div>
            <div class="my-3 grid justify-items-center">
                <Paginate :data="merchants"/>
            </div>
        </main>
    </GuestLayout>

</template>
