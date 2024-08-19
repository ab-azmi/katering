<script setup lang="ts">
import { Menu, Merchant, OrderItem } from '@/types';
import MenuCard from '@/Pages/Merchant/MenuCard.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Separator from '@/Components/ui/separator/Separator.vue';
import Button from '@/Components/ui/button/Button.vue';
import { ArrowLeft } from 'lucide-vue-next';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { ref, defineProps, computed } from 'vue';
import { toast } from 'vue-sonner'
import OrderDrawer from '@/Pages/Merchant/OrderDrawer.vue';

const props = defineProps<{
    merchant: Merchant;
}>();

const form = useForm<{
    total: number;
    items: OrderItem[];
    merchant_id: number;

}>({
    total: 0,
    items: [],
    merchant_id: props.merchant?.user?.id ?? 0
})

const page = usePage();
const isAuth = computed(() => page.props.auth.user)

const handleAddQuantity = ({ menu, quantity }: { menu: Menu, quantity: number }) => {
    const item = form.items.find((item) => item?.menu?.id === menu.id)
    if (item) {
        item.quantity = quantity
    } else {
        form.items.push({
            menu_id: menu.id,
            quantity: quantity,
            menu: menu
        })
    }

    form.total = form.items.reduce((acc, i) => {
        return acc + i?.menu?.price! * i.quantity
    }, 0)
}

function handleCheckout() {
    // check if there is user session login
    if (!isAuth.value) {
        router.get(route('login'))
        return
    }

    form.post(route('merchant.checkout'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            toast('Order has been created', {
                action: {
                    label: 'Go to Order',
                    onClick: () => router.get(route('order.index')),
                },
                style: {
                    backgroundColor: '#10B981',
                    color: '#fff',
                },
            })
        }
    })

}

function handleBack() {
    window.history.back()
}

</script>
<template>
    <GuestLayout>
            <Button class="text-sm mt-3" @click="handleBack">
                <ArrowLeft class="h-6" />
            </Button>
        <div class="my-5">
            <h1 class="text-4xl font-semibold">{{ merchant.name }}</h1>
            <p class="italic text-slate-500">{{ merchant.address }}</p>
            <Separator class="my-3" />
            <p class="">{{ merchant.description }}</p>
        </div>
        <h2 class="text-2xl mb-3 font-semibold text-slate-600">Menu</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <MenuCard @AddQuantity="handleAddQuantity" :menu="menu" v-for="menu in merchant.menus" :key="menu.id" />
        </div>
        <!-- Total -->
        <div v-if="form.total > 0"
            class="fixed bottom-0 left-0 w-full p-4 bg-primary text-secondary flex justify-between items-center">
            <!-- Drawer -->
            <OrderDrawer :orderItems="form.items">
                <Button variant="secondary">
                    Order List
                </Button>
            </OrderDrawer>

            <div class="flex gap-10 items-center">
                <h1 class="text-2xl font-bold">Total : $ {{ form.total.toFixed(2) }}</h1>
                <Button variant="secondary" @click.prevent="handleCheckout">Checkout</Button>
            </div>
        </div>

    </GuestLayout>
</template>