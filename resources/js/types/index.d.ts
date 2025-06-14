import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

// Wedding-specific types
export interface WeddingTask {
    id: number;
    title: string;
    description?: string;
    category: string;
    priority: string;
    is_completed: boolean;
    deadline?: string;
    notes?: any;
    sort_order: number;
    category_display: string;
    category_icon: string;
    category_color: string;
    priority_display: string;
    priority_color: string;
    created_at: string;
    updated_at: string;
}

export interface WeddingSettings {
    id: number;
    bride_name: string;
    groom_name: string;
    hashtag: string;
    wedding_date: string;
    theme_color: string;
    couple_name: string;
    days_until_wedding: number;
    is_wedding_today: boolean;
    is_wedding_past: boolean;
    created_at: string;
    updated_at: string;
}

export interface CategoryOption {
    value: string;
    label: string;
    icon: string;
    color: string;
}

export interface PriorityOption {
    value: string;
    label: string;
    color: string;
    textColor: string;
    sortOrder: number;
}

export interface WeddingStats {
    total: number;
    completed: number;
    remaining: number;
    percentage: number;
}

export interface CategoryStats {
    [key: string]: {
        total: number;
        completed: number;
        remaining: number;
        category?: CategoryOption;
    };
}

export interface PriorityStats {
    [key: string]: {
        total: number;
        completed: number;
        remaining: number;
        priority?: PriorityOption;
    };
}

export interface TimeUntilWedding {
    days: number;
    hours: number;
    minutes: number;
    seconds: number;
}

// Wedding page props
export interface WeddingPageProps {
    settings: WeddingSettings;
    tasks: WeddingTask[];
    stats: WeddingStats;
    categoryStats: CategoryStats;
    priorityStats: PriorityStats;
    timeUntilWedding?: TimeUntilWedding;
    categories: CategoryOption[];
    priorities: PriorityOption[];
}

// Form data types
export interface TaskFormData {
    title: string;
    description: string;
    category: string;
    priority: string;
    deadline: string;
    notes: any[];
}

export interface SettingsFormData {
    bride_name: string;
    groom_name: string;
    hashtag: string;
    wedding_date: string;
    theme_color: string;
}

// Enum values as string literal types
export type WeddingCategoryValue =
    | 'legal'
    | 'attire'
    | 'jewelry'
    | 'services'
    | 'food'
    | 'decoration'
    | 'stationery'
    | 'gifts'
    | 'venue'
    | 'photography';

export type TaskPriorityValue = 'low' | 'medium' | 'high';
