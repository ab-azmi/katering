export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
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
    menus?: Menu[]
}