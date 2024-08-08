<script setup lang="ts">
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/Components/ui/table'
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Navbar from '@/Components/Navbar.vue';
import { defineProps } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Order } from '@/types';
import Badge from '@/Components/ui/badge/Badge.vue';
import Button from '@/Components/ui/button/Button.vue';
import { Receipt } from 'lucide-vue-next';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'

const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    orders: Order[];
    isCustomer: boolean;
}>();

const printOrder = (order: any) => {
    //send req to order.print route
    router.get(route('order.print', order.id), {
        onSuccess: (response) => {
            console.log(response);
        },
    });
};

</script>

<template>

    <Head title="Welcome" />

    <GuestLayout>
        <header>
            <Navbar :canLogin="canLogin" :canRegister="canRegister" />
        </header>

        <main class="mt-12">
            <h1 class="text-3xl font-bold my-7">
                My Orders
            </h1>
            <div class="">
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
                                <Badge v-if="isCustomer" variant="default">{{ order.status }}</Badge>
                                <DropdownMenu v-else>
                                    <DropdownMenuTrigger>
                                        <Badge variant="default">{{ order.status }}</Badge>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent>
                                        <DropdownMenuItem>Pending</DropdownMenuItem>
                                        <DropdownMenuItem>Success</DropdownMenuItem>
                                        <DropdownMenuItem>Cancle</DropdownMenuItem>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </TableCell>
                            <TableCell>{{ order.merchant?.name }}</TableCell>
                            <TableCell>
                                <Button>Show</Button>
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
        </main>
    </GuestLayout>


</template>