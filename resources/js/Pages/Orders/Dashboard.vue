<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Order } from '@/types';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table';
import Button from '@/Components/ui/button/Button.vue';
import { Receipt } from 'lucide-vue-next';
import Badge from '@/Components/ui/badge/Badge.vue';
import OrderDrawer from '@/Pages/Merchant/OrderDrawer.vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu';
import { useForm } from '@inertiajs/vue3';

defineProps<{
    orders: Order[];
}>();

const updateStatus = (order: Order, status: string) => {
    const form = useForm({
        ...order,
        status: status,
    })

    form.put(route('order.update', order), {
        onSuccess: () => {
            console.log('Order status updated');
        },
    });
}
</script>

<template>

    <Head title="Orders" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Orders</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2">
                    <Table>
                        <TableCaption>A list of your recent invoices.</TableCaption>
                        <TableHeader>
                            <TableRow>
                                <TableHead>
                                    Invoice
                                </TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead>Merchant</TableHead>
                                <TableHead>Items</TableHead>
                                <TableHead class="text-right">
                                    Amount
                                </TableHead>
                                <TableHead>
                                    Receipt
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="order in orders" :key="order.id">
                                <TableCell class="font-medium">
                                    {{ order.code }}
                                </TableCell>
                                <TableCell>
                                    <DropdownMenu>
                                        <DropdownMenuTrigger>
                                            <Badge :variant="order.status === 'success' ? 'default' : order.status === 'pending' ? 'outline' : 'destructive'">
                                                {{ order.status }}
                                            </Badge>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent>
                                            <DropdownMenuItem @click.prevent="updateStatus(order, 'pending')">Pending</DropdownMenuItem>
                                            <DropdownMenuItem @click.prevent="updateStatus(order, 'success')">Success</DropdownMenuItem>
                                            <DropdownMenuItem @click.prevent="updateStatus(order, 'cancel')">Cancel</DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                                <TableCell>{{ order.merchant?.name }}</TableCell>
                                <TableCell>
                                    <OrderDrawer :orderItems="order.order_items!">
                                        <Button>Show</Button>
                                    </OrderDrawer>
                                </TableCell>
                                <TableCell class="text-right">
                                    USD {{ order.total }}
                                </TableCell>
                                <TableCell>
                                    <Button variant="ghost" :as="'a'" :href="'/order/print/' + order.id">
                                        <Receipt class="h-6" />
                                    </Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
