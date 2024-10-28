export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    alert: {
        type: 'success' | 'error';
        message: string;
    }
};

export interface PageLinks {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
}

export interface PageMeta {
    from: number;
    to: number;
    total: number;
}
