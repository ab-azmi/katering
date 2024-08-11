export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
    roles?: string[]
    merchant?: Merchant
    customer?: Customer
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export type Menu = {
    id: number;
    name: string;
    price: number;
    description: string;
}

export type Merchant = {
    id: number;
    name: string;
    description: string;
    address: string;
    phone: string;
    slug?: string;
    menus?: Menu[];
    user?: User
}

export type Customer = {
    id: number;
    name: string;
    description: string;
    address: string;
    phone: string;
    user?: User
}

export type OrderItem = {
    id?: number;
    order_id?: number;
    menu_id: number;
    quantity: number;
    menu?: Menu
}

export type Order = {
    id: number;
    user_id: number;
    merchant_id: number;
    total: number;
    status: string;
    code: string;
    created_at: string;
    order_items?: OrderItem[]
    merchant?: User
    customer?: User
}