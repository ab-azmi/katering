<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import MerchantCard from '@/Pages/Merchant/MerchantCard.vue';
import { Merchant } from '@/types';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import MerchantFilter from '@/Pages/Merchant/MerchantFilter.vue';
import { ref, watch, computed } from 'vue';

const props = defineProps<{
    merchants: Merchant[];
    canLogin?: boolean;
    canRegister?: boolean;
}>();

const search = ref<string>('');

const filteredMerchants = computed(() => {
    return props.merchants.filter(merchant => {
        return merchant.name.toLowerCase().includes(search.value.toLowerCase());
    });
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
            <MerchantFilter v-model="search"/>
            <div class="grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <template v-for="merchant in filteredMerchants" :key="merchant.id">
                    <MerchantCard :merchant="merchant"/>
                </template>
            </div>
        </main>
    </GuestLayout>

</template>
