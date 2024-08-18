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

export type Paginated<T = {}> = {
    data?: T;
    per_page: number;
    first_page_url: string;
    last_page_url: string;
    from: number;
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    current_page: number;
    last_page: number;
    query?: string;
    page_name?: string;
    on_each_side?: number;
    next_page_url: string | null;
    prev_page_url: string | null;
    path: string;
    total: number;
}

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