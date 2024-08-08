<script setup lang="ts">
import { Menu, Merchant } from '@/types';
import MenuCard from '@/Pages/Merchant/MenuCard.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Separator from '@/Components/ui/separator/Separator.vue';
import Button from '@/Components/ui/button/Button.vue';
import { ArrowLeft } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { ref, defineProps } from 'vue';
import OrderDrawer from '@/Pages/Merchant/OrderDrawer.vue';

defineProps<{
    merchant: Merchant;
}>();

const total = ref<number>(0)
const items = ref<{
    item: Menu;
    quantity: number;
}[]>([])

const handleAddQuantity = (menu: Menu) => {
    total.value += menu.price

    const item = items.value.find((item) => item.item.id === menu.id)
    if (item) {
        item.quantity += 1
    } else {
        items.value.push({
            item: menu,
            quantity: 1
        })
    }
}

</script>
<template>
    <GuestLayout>
        <Link :href="route('home')" as="button">
        <Button class="text-sm mt-3">
            <ArrowLeft class="h-6" />
        </Button>
        </Link>
        <div class="my-5">
            <h1 class="text-4xl font-semibold">{{ merchant.name }}</h1>
            <p class="italic text-slate-500">{{ merchant.address }}</p>
            <Separator class="my-3" />
            <p class="">{{ merchant.description }}</p>
        </div>
        <h2 class="text-2xl mb-3 font-semibold text-slate-600">Menus</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <MenuCard @AddQuantity="handleAddQuantity" :menu="menu" v-for="menu in merchant.menus" :key="menu.id" />
        </div>
        <!-- Total -->
        <div v-if="total > 0"
            class="fixed bottom-0 left-0 w-full p-4 bg-primary text-secondary flex justify-between items-center">
            <OrderDrawer :orderList="items">
                <Button variant="secondary">
                    Order List
                </Button>
            </OrderDrawer>
            <div class="flex gap-10 items-center">
                <h1 class="text-2xl font-bold">Total : $ {{ total }}</h1>
                <Button variant="secondary">Checkout</Button>
            </div>
        </div>
        <!-- Drawer -->

    </GuestLayout>
</template>