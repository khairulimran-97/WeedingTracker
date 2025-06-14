<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Badge } from '@/components/ui/badge'
import { Plus, Edit, Trash2, Settings, Sun, Moon, Monitor, Check, X, Filter, ChevronDown, Calendar, AlertTriangle } from 'lucide-vue-next'
import { useAppearance } from '@/composables/useAppearance'
import type { WeddingPageProps, WeddingTask, TaskFormData, SettingsFormData } from '@/types'

type Props = WeddingPageProps & {
    timeUntilWedding?: {
        days: number;
        hours: number;
        minutes: number;
        seconds: number;
    } | null;
}

const props = defineProps<Props>()

const { appearance, updateAppearance } = useAppearance()

const selectedCategory = ref('all')
const showTaskDialog = ref(false)
const showSettingsDialog = ref(false)
const showCategoryPopover = ref(false)
const editingTask = ref<WeddingTask | null>(null)

const taskForm = useForm<TaskFormData>({
    title: '',
    description: '',
    category: 'legal',
    priority: 'medium',
    deadline: '',
    notes: []
})

const settingsForm = useForm<SettingsFormData>({
    bride_name: props.settings.bride_name,
    groom_name: props.settings.groom_name,
    hashtag: props.settings.hashtag,
    wedding_date: props.settings.wedding_date,
    theme_color: props.settings.theme_color
})

const filteredTasks = computed(() => {
    if (selectedCategory.value === 'all') {
        return props.tasks
    }
    return props.tasks.filter(task => task.category === selectedCategory.value)
})

const currentCategoryDisplay = computed(() => {
    if (selectedCategory.value === 'all') {
        return 'All Tasks'
    }
    const category = props.categories.find(cat => cat.value === selectedCategory.value)
    return category ? `${category.icon} ${category.label}` : 'Unknown Category'
})

const getCategoryPercentage = (categoryValue: string) => {
    const stats = props.categoryStats[categoryValue]
    if (!stats || stats.total === 0) return 0
    return Math.round((stats.completed / stats.total) * 100)
}

const selectCategory = (categoryValue: string) => {
    selectedCategory.value = categoryValue
    showCategoryPopover.value = false
}

// Toggle task completion status
const toggleTask = (task: WeddingTask) => {
    useForm({}).post(`/tasks/${task.id}/toggle`, {
        preserveScroll: true,
    })
}

const openTaskDialog = (task?: WeddingTask) => {
    if (task) {
        editingTask.value = task
        taskForm.title = task.title
        taskForm.description = task.description || ''
        taskForm.category = task.category
        taskForm.priority = task.priority
        taskForm.deadline = task.deadline || ''
        taskForm.notes = task.notes || []
    } else {
        editingTask.value = null
        taskForm.reset()
        taskForm.category = 'legal'
        taskForm.priority = 'medium'
    }
    showTaskDialog.value = true
}

const saveTask = () => {
    if (editingTask.value) {
        taskForm.patch(`/tasks/${editingTask.value.id}`, {
            onSuccess: () => {
                showTaskDialog.value = false
                taskForm.reset()
                editingTask.value = null
            }
        })
    } else {
        taskForm.post('/tasks', {
            onSuccess: () => {
                showTaskDialog.value = false
                taskForm.reset()
            }
        })
    }
}

const saveSettings = () => {
    settingsForm.patch('/wedding/settings', {
        onSuccess: () => {
            showSettingsDialog.value = false
        }
    })
}

const deleteTask = (task: WeddingTask) => {
    if (confirm('Are you sure you want to delete this task?')) {
        useForm({}).delete(`/tasks/${task.id}`, {
            preserveScroll: true
        })
    }
}

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    })
}

const formatDateMobile = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        month: 'short',
        day: 'numeric'
    })
}

const isOverdue = (deadline: string) => {
    if (!deadline) return false
    return new Date(deadline) < new Date()
}
</script>

<template>
    <Head title="Wedding Dashboard" />

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Desktop Header -->
        <div class="hidden md:block p-6">
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center gap-8">
                    <!-- Couple Name -->
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ settings.couple_name }}
                        </h1>
                        <span class="text-xl">💕</span>
                    </div>

                    <!-- Wedding Status & Countdown -->
                    <div class="flex items-center gap-6">
                        <!-- Task Progress -->
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            {{ stats.completed }}/{{ stats.total }} tasks ({{ stats.percentage }}%)
                        </span>

                        <!-- Wedding Status -->
                        <div v-if="settings.is_wedding_today" class="flex items-center gap-2 text-rose-600 dark:text-rose-400 font-bold text-lg">
                            <span class="text-2xl">🎉</span>
                            <span>It's your wedding day!</span>
                            <span class="text-2xl">🎉</span>
                        </div>

                        <div v-else-if="settings.is_wedding_past" class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <span class="text-lg">✨</span>
                            <span>Married {{ formatDate(settings.wedding_date) }}</span>
                            <span class="text-lg">💍</span>
                        </div>

                        <!-- Big Countdown for Future Wedding -->
                        <div v-else-if="props.timeUntilWedding" class="flex items-center gap-4">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ formatDate(settings.wedding_date) }}
                            </div>
                            <div class="flex items-center gap-1 bg-rose-50 dark:bg-rose-950 px-4 py-2 rounded-lg border border-rose-200 dark:border-rose-800">
                                <span class="text-lg">⏰</span>
                                <div class="flex items-center gap-2 text-rose-600 dark:text-rose-400 font-bold">
                                    <div v-if="props.timeUntilWedding.days > 0" class="text-center">
                                        <div class="text-xl leading-none">{{ props.timeUntilWedding.days }}</div>
                                        <div class="text-xs uppercase">{{ props.timeUntilWedding.days === 1 ? 'Day' : 'Days' }}</div>
                                    </div>
                                    <span v-if="props.timeUntilWedding.days > 0" class="text-lg text-gray-400">:</span>
                                    <div v-if="props.timeUntilWedding.days > 0 || props.timeUntilWedding.hours > 0" class="text-center">
                                        <div class="text-xl leading-none">{{ props.timeUntilWedding.hours }}</div>
                                        <div class="text-xs uppercase">Hours</div>
                                    </div>
                                    <span v-if="props.timeUntilWedding.days > 0 || props.timeUntilWedding.hours > 0" class="text-lg text-gray-400">:</span>
                                    <div class="text-center">
                                        <div class="text-xl leading-none">{{ props.timeUntilWedding.minutes }}</div>
                                        <div class="text-xs uppercase">Minutes</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fallback if no wedding date set -->
                        <span v-else class="text-sm text-gray-500 dark:text-gray-400">
                            Set wedding date in settings ⚙️
                        </span>
                    </div>
                </div>

                <!-- Desktop Settings Menu -->
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="outline" size="sm">
                            <Settings class="h-4 w-4 mr-2" />
                            Settings
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end" class="w-48">
                        <DropdownMenuItem @click="showSettingsDialog = true">
                            <Settings class="h-4 w-4 mr-2" />
                            Wedding Settings
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="updateAppearance('light')">
                            <Sun class="h-4 w-4 mr-2" />
                            Light Mode
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="updateAppearance('dark')">
                            <Moon class="h-4 w-4 mr-2" />
                            Dark Mode
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="updateAppearance('system')">
                            <Monitor class="h-4 w-4 mr-2" />
                            System
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="md:hidden sticky top-0 z-10 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3">
            <div class="flex items-center justify-between mb-3">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-gray-100 truncate">
                            {{ settings.couple_name }}
                        </h1>
                        <span class="text-sm">💕</span>
                    </div>

                    <!-- Task Progress -->
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        {{ stats.completed }}/{{ stats.total }} completed
                    </div>
                </div>

                <!-- Mobile Settings Button -->
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="ghost" size="sm" class="p-2">
                            <Settings class="h-5 w-5" />
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end" class="w-48">
                        <DropdownMenuItem @click="showSettingsDialog = true">
                            <Settings class="h-4 w-4 mr-2" />
                            Wedding Settings
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="updateAppearance('light')">
                            <Sun class="h-4 w-4 mr-2" />
                            Light Mode
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="updateAppearance('dark')">
                            <Moon class="h-4 w-4 mr-2" />
                            Dark Mode
                        </DropdownMenuItem>
                        <DropdownMenuItem @click="updateAppearance('system')">
                            <Monitor class="h-4 w-4 mr-2" />
                            System
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>

            <!-- Mobile Wedding Status & Big Countdown -->
            <div class="space-y-2">
                <div v-if="settings.is_wedding_today" class="flex items-center justify-center gap-2 text-rose-600 dark:text-rose-400 font-bold text-base bg-rose-50 dark:bg-rose-950 py-2 px-3 rounded-lg">
                    <span class="text-lg">🎉</span>
                    <span>It's your wedding day!</span>
                    <span class="text-lg">🎉</span>
                </div>

                <div v-else-if="settings.is_wedding_past" class="flex items-center justify-center gap-2 text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 py-2 px-3 rounded-lg">
                    <span>✨</span>
                    <span>Married {{ formatDateMobile(settings.wedding_date) }}</span>
                    <span>💍</span>
                </div>

                <div v-else-if="props.timeUntilWedding" class="bg-rose-50 dark:bg-rose-950 py-3 px-4 rounded-lg border border-rose-200 dark:border-rose-800">
                    <div class="text-center">
                        <div class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                            Wedding Day: {{ formatDateMobile(settings.wedding_date) }}
                        </div>
                        <div class="flex items-center justify-center gap-3">
                            <span class="text-base">⏰</span>
                            <div class="flex items-center gap-2 text-rose-600 dark:text-rose-400 font-bold">
                                <div v-if="props.timeUntilWedding.days > 0" class="text-center">
                                    <div class="text-lg leading-none">{{ props.timeUntilWedding.days }}</div>
                                    <div class="text-xs uppercase">{{ props.timeUntilWedding.days === 1 ? 'Day' : 'Days' }}</div>
                                </div>
                                <span v-if="props.timeUntilWedding.days > 0" class="text-base text-gray-400">:</span>
                                <div v-if="props.timeUntilWedding.days > 0 || props.timeUntilWedding.hours > 0" class="text-center">
                                    <div class="text-lg leading-none">{{ props.timeUntilWedding.hours }}</div>
                                    <div class="text-xs uppercase">Hours</div>
                                </div>
                                <span v-if="props.timeUntilWedding.days > 0 || props.timeUntilWedding.hours > 0" class="text-base text-gray-400">:</span>
                                <div class="text-center">
                                    <div class="text-lg leading-none">{{ props.timeUntilWedding.minutes }}</div>
                                    <div class="text-xs uppercase">Minutes</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            until your special day!
                        </div>
                    </div>
                </div>

                <div v-else class="text-center text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 py-2 px-3 rounded-lg">
                    Set wedding date in settings ⚙️
                </div>
            </div>

            <!-- Mobile Progress Bar -->
            <div class="mt-3">
                <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400 mb-1">
                    <span>Progress</span>
                    <span>{{ stats.percentage }}%</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div
                        class="bg-rose-500 h-2 rounded-full transition-all duration-300"
                        :style="{ width: stats.percentage + '%' }"
                    ></div>
                </div>
            </div>
        </div>

        <!-- Wedding Settings Dialog -->
        <Dialog v-model:open="showSettingsDialog">
            <DialogContent class="max-w-md md:max-w-md max-w-[95vw] w-full max-h-[90vh] overflow-y-auto">
                <DialogHeader>
                    <DialogTitle>Wedding Settings</DialogTitle>
                    <DialogDescription>
                        Update your wedding details and preferences.
                    </DialogDescription>
                </DialogHeader>
                <form @submit.prevent="saveSettings" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <Label for="bride_name">Bride's Name</Label>
                            <Input v-model="settingsForm.bride_name" required />
                        </div>
                        <div>
                            <Label for="groom_name">Groom's Name</Label>
                            <Input v-model="settingsForm.groom_name" required />
                        </div>
                    </div>
                    <div>
                        <Label for="hashtag">Wedding Hashtag</Label>
                        <Input v-model="settingsForm.hashtag" placeholder="#CoupleHashtag" />
                    </div>
                    <div>
                        <Label for="wedding_date">Wedding Date</Label>
                        <Input type="date" v-model="settingsForm.wedding_date" required />
                    </div>
                    <div>
                        <Label for="theme_color">Theme Color</Label>
                        <Input type="color" v-model="settingsForm.theme_color" />
                    </div>
                    <div class="flex flex-col md:flex-row gap-2 pt-4">
                        <Button type="button" variant="outline" @click="showSettingsDialog = false" class="flex-1">
                            Cancel
                        </Button>
                        <Button type="submit" class="bg-rose-500 hover:bg-rose-600 flex-1" :disabled="settingsForm.processing">
                            Save Settings
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>

        <!-- Desktop Controls -->
        <div class="hidden md:block px-6 mb-6">
            <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <!-- Category Filter -->
                <div class="flex items-center gap-4">
                    <Popover v-model:open="showCategoryPopover">
                        <PopoverTrigger as-child>
                            <Button variant="outline" class="w-64 justify-between">
                                <span class="flex items-center gap-2">
                                    <Filter class="h-4 w-4" />
                                    {{ currentCategoryDisplay }}
                                </span>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-gray-500">
                                        {{ selectedCategory === 'all' ? `${stats.completed}/${stats.total}` : `${categoryStats[selectedCategory]?.completed || 0}/${categoryStats[selectedCategory]?.total || 0}` }}
                                    </span>
                                    <ChevronDown class="h-4 w-4" />
                                </div>
                            </Button>
                        </PopoverTrigger>
                        <PopoverContent class="w-80 p-4" align="start">
                            <div class="space-y-3">
                                <h4 class="font-medium text-sm text-gray-900 dark:text-gray-100">Filter by Category</h4>

                                <!-- All Tasks Option -->
                                <Button
                                    variant="ghost"
                                    :class="[
                                        'w-full justify-start h-auto p-3',
                                        selectedCategory === 'all' ? 'bg-rose-100 dark:bg-rose-900' : 'hover:bg-gray-100 dark:hover:bg-gray-800'
                                    ]"
                                    @click="selectCategory('all')"
                                >
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex flex-col items-start">
                                            <span class="font-medium">All Tasks</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ stats.completed }} of {{ stats.total }} completed
                                            </span>
                                        </div>
                                        <div class="flex flex-col items-end gap-1">
                                            <span class="text-xs font-medium">{{ stats.percentage }}%</span>
                                            <div class="w-16 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                                <div
                                                    class="h-full bg-green-500 transition-all duration-300"
                                                    :style="{ width: stats.percentage + '%' }"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </Button>

                                <!-- Individual Categories -->
                                <div class="space-y-1 max-h-64 overflow-y-auto">
                                    <Button
                                        v-for="category in categories"
                                        :key="category.value"
                                        variant="ghost"
                                        :class="[
                                            'w-full justify-start h-auto p-3',
                                            selectedCategory === category.value ? 'bg-rose-100 dark:bg-rose-900' : 'hover:bg-gray-100 dark:hover:bg-gray-800'
                                        ]"
                                        @click="selectCategory(category.value)"
                                    >
                                        <div class="flex items-center justify-between w-full">
                                            <div class="flex flex-col items-start">
                                                <span class="flex items-center gap-2 font-medium">
                                                    {{ category.icon }}
                                                    {{ category.label }}
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ categoryStats[category.value]?.completed || 0 }} of {{ categoryStats[category.value]?.total || 0 }} completed
                                                </span>
                                            </div>
                                            <div class="flex flex-col items-end gap-1">
                                                <span class="text-xs font-medium">
                                                    {{ getCategoryPercentage(category.value) }}%
                                                </span>
                                                <div class="w-16 h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                                    <div
                                                        class="h-full bg-green-500 transition-all duration-300"
                                                        :style="{ width: getCategoryPercentage(category.value) + '%' }"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </Button>
                                </div>
                            </div>
                        </PopoverContent>
                    </Popover>

                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Showing {{ filteredTasks.length }} tasks
                    </span>
                </div>

                <!-- Add Task Button -->
                <Dialog v-model:open="showTaskDialog">
                    <DialogTrigger as-child>
                        <Button @click="openTaskDialog()" class="bg-rose-500 hover:bg-rose-600 text-white">
                            <Plus class="mr-2 h-4 w-4" />
                            Add Task
                        </Button>
                    </DialogTrigger>
                    <DialogContent class="max-w-md">
                        <DialogHeader>
                            <DialogTitle>
                                {{ editingTask ? 'Edit Task' : 'Add New Task' }}
                            </DialogTitle>
                            <DialogDescription>
                                {{ editingTask ? 'Update task details and settings.' : 'Create a new wedding task to track your progress.' }}
                            </DialogDescription>
                        </DialogHeader>
                        <form @submit.prevent="saveTask" class="space-y-4">
                            <div>
                                <Label for="title">Task Title</Label>
                                <Input
                                    v-model="taskForm.title"
                                    required
                                    placeholder="Enter task title"
                                    :disabled="taskForm.processing"
                                />
                            </div>
                            <div>
                                <Label for="description">Description</Label>
                                <Textarea
                                    v-model="taskForm.description"
                                    rows="3"
                                    placeholder="Enter task description (optional)"
                                    :disabled="taskForm.processing"
                                />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <Label for="category">Category</Label>
                                    <Select v-model="taskForm.category" :disabled="taskForm.processing">
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select category" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem v-for="cat in categories" :key="cat.value" :value="cat.value">
                                                {{ cat.icon }} {{ cat.label }}
                                            </SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div>
                                    <Label for="priority">Priority</Label>
                                    <Select v-model="taskForm.priority" :disabled="taskForm.processing">
                                        <SelectTrigger>
                                            <SelectValue placeholder="Select priority" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem v-for="priority in priorities" :key="priority.value" :value="priority.value">
                                                {{ priority.label }}
                                            </SelectItem>
                                        </SelectContent>
                                    </Select>
                                </div>
                            </div>
                            <div>
                                <Label for="deadline">Deadline (Optional)</Label>
                                <Input
                                    type="date"
                                    v-model="taskForm.deadline"
                                    :disabled="taskForm.processing"
                                />
                            </div>
                            <div class="flex justify-end gap-2 pt-4">
                                <Button
                                    type="button"
                                    variant="outline"
                                    @click="showTaskDialog = false"
                                    :disabled="taskForm.processing"
                                >
                                    Cancel
                                </Button>
                                <Button
                                    type="submit"
                                    class="bg-rose-500 hover:bg-rose-600 text-white"
                                    :disabled="taskForm.processing"
                                >
                                    {{ taskForm.processing ? 'Saving...' : (editingTask ? 'Update Task' : 'Create Task') }}
                                </Button>
                            </div>
                        </form>
                    </DialogContent>
                </Dialog>
            </div>
        </div>

        <!-- Mobile Controls -->
        <div class="md:hidden p-4 space-y-3">
            <!-- Category Filter -->
            <Popover v-model:open="showCategoryPopover">
                <PopoverTrigger as-child>
                    <Button variant="outline" class="w-full justify-between h-12">
                        <span class="flex items-center gap-2">
                            <Filter class="h-4 w-4" />
                            {{ currentCategoryDisplay }}
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-500">
                                {{ selectedCategory === 'all' ? `${stats.completed}/${stats.total}` : `${categoryStats[selectedCategory]?.completed || 0}/${categoryStats[selectedCategory]?.total || 0}` }}
                            </span>
                            <ChevronDown class="h-4 w-4" />
                        </div>
                    </Button>
                </PopoverTrigger>
                <PopoverContent class="w-full p-3" align="start">
                    <div class="space-y-2">
                        <!-- All Tasks Option -->
                        <Button
                            variant="ghost"
                            :class="[
                                'w-full justify-between h-auto p-3',
                                selectedCategory === 'all' ? 'bg-rose-100 dark:bg-rose-900' : ''
                            ]"
                            @click="selectCategory('all')"
                        >
                            <div class="text-left">
                                <div class="font-medium">All Tasks</div>
                                <div class="text-xs text-gray-500">{{ stats.completed }}/{{ stats.total }}</div>
                            </div>
                            <div class="text-xs font-medium">{{ stats.percentage }}%</div>
                        </Button>

                        <!-- Individual Categories -->
                        <div class="space-y-1 max-h-48 overflow-y-auto">
                            <Button
                                v-for="category in categories"
                                :key="category.value"
                                variant="ghost"
                                :class="[
                                    'w-full justify-between h-auto p-3',
                                    selectedCategory === category.value ? 'bg-rose-100 dark:bg-rose-900' : ''
                                ]"
                                @click="selectCategory(category.value)"
                            >
                                <div class="text-left">
                                    <div class="font-medium">{{ category.icon }} {{ category.label }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ categoryStats[category.value]?.completed || 0 }}/{{ categoryStats[category.value]?.total || 0 }}
                                    </div>
                                </div>
                                <div class="text-xs font-medium">{{ getCategoryPercentage(category.value) }}%</div>
                            </Button>
                        </div>
                    </div>
                </PopoverContent>
            </Popover>

            <!-- Add Task Button -->
            <Dialog v-model:open="showTaskDialog">
                <DialogTrigger as-child>
                    <Button @click="openTaskDialog()" class="w-full bg-rose-500 hover:bg-rose-600 text-white h-12">
                        <Plus class="mr-2 h-4 w-4" />
                        Add New Task
                    </Button>
                </DialogTrigger>
                <DialogContent class="max-w-[95vw] w-full max-h-[90vh] overflow-y-auto">
                    <DialogHeader>
                        <DialogTitle>
                            {{ editingTask ? 'Edit Task' : 'Add New Task' }}
                        </DialogTitle>
                    </DialogHeader>
                    <form @submit.prevent="saveTask" class="space-y-4">
                        <div>
                            <Label for="title">Task Title</Label>
                            <Input
                                v-model="taskForm.title"
                                required
                                placeholder="Enter task title"
                                :disabled="taskForm.processing"
                            />
                        </div>
                        <div>
                            <Label for="description">Description</Label>
                            <Textarea
                                v-model="taskForm.description"
                                rows="2"
                                placeholder="Enter description (optional)"
                                :disabled="taskForm.processing"
                            />
                        </div>

                        <div class="space-y-4">
                            <div>
                                <Label for="category">Category</Label>
                                <Select v-model="taskForm.category" :disabled="taskForm.processing">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Select category" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem v-for="cat in categories" :key="cat.value" :value="cat.value">
                                            {{ cat.icon }} {{ cat.label }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <div>
                                <Label for="priority">Priority</Label>
                                <Select v-model="taskForm.priority" :disabled="taskForm.processing">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Select priority" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem v-for="priority in priorities" :key="priority.value" :value="priority.value">
                                            {{ priority.label }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                        </div>
                        <div>
                            <Label for="deadline">Deadline (Optional)</Label>
                            <Input
                                type="date"
                                v-model="taskForm.deadline"
                                :disabled="taskForm.processing"
                            />
                        </div>
                        <div class="flex gap-2 pt-4">
                            <Button
                                type="button"
                                variant="outline"
                                @click="showTaskDialog = false"
                                :disabled="taskForm.processing"
                                class="flex-1"
                            >
                                Cancel
                            </Button>
                            <Button
                                type="submit"
                                class="bg-rose-500 hover:bg-rose-600 text-white flex-1"
                                :disabled="taskForm.processing"
                            >
                                {{ taskForm.processing ? 'Saving...' : (editingTask ? 'Update' : 'Create') }}
                            </Button>
                        </div>
                    </form>
                </DialogContent>
            </Dialog>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block px-6">
            <Card class="dark:bg-gray-800 dark:border-gray-700">
                <CardContent class="p-0">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Task
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Category
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Priority
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Deadline
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr v-for="task in filteredTasks" :key="task.id" :class="[
                                    'transition-colors duration-200',
                                    task.is_completed
                                        ? 'bg-green-50 hover:bg-green-100 dark:bg-green-950 dark:hover:bg-green-900'
                                        : 'hover:bg-gray-50 dark:hover:bg-gray-700'
                                ]">
                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span :class="[
                                                'text-sm font-medium px-3 py-1 rounded-full',
                                                task.is_completed
                                                    ? 'bg-green-200 text-green-800 dark:bg-green-800 dark:text-green-200'
                                                    : 'bg-amber-200 text-amber-800 dark:bg-amber-800 dark:text-amber-200'
                                            ]">
                                            {{ task.is_completed ? 'Completed' : 'Pending' }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Task -->
                                <td class="px-6 py-4">
                                    <div class="max-w-xs">
                                        <div :class="[
                                                'text-sm font-medium',
                                                task.is_completed
                                                    ? 'line-through text-gray-500 dark:text-gray-400'
                                                    : 'text-gray-900 dark:text-gray-100'
                                            ]">
                                            {{ task.title }}
                                        </div>
                                        <div v-if="task.description" :class="[
                                                'text-sm mt-1 truncate',
                                                task.is_completed
                                                    ? 'line-through text-gray-400 dark:text-gray-500'
                                                    : 'text-gray-500 dark:text-gray-400'
                                            ]">
                                            {{ task.description }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Badge :class="task.category_color" variant="secondary">
                                        {{ task.category_icon }} {{ task.category_display }}
                                    </Badge>
                                </td>

                                <!-- Priority -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Badge :class="task.priority_color" variant="outline">
                                        {{ task.priority_display }}
                                    </Badge>
                                </td>

                                <!-- Deadline -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    <div v-if="task.deadline" class="flex items-center gap-1">
                                        <span :class="[
                                            isOverdue(task.deadline) && !task.is_completed
                                                ? 'text-red-600 dark:text-red-400 font-medium'
                                                : ''
                                        ]">
                                            {{ formatDate(task.deadline) }}
                                        </span>
                                        <AlertTriangle v-if="isOverdue(task.deadline) && !task.is_completed" class="h-3 w-3 text-red-500" />
                                    </div>
                                    <span v-else>-</span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <!-- Quick Toggle Completion -->
                                        <Button
                                            size="sm"
                                            variant="ghost"
                                            @click="toggleTask(task)"
                                            :class="[
                                                task.is_completed
                                                    ? 'hover:bg-orange-50 dark:hover:bg-orange-900'
                                                    : 'hover:bg-green-50 dark:hover:bg-green-900'
                                            ]"
                                            :title="task.is_completed ? 'Mark as incomplete' : 'Mark as complete'"
                                        >
                                            <Check v-if="!task.is_completed" class="h-4 w-4 text-green-600" />
                                            <X v-else class="h-4 w-4 text-orange-600" />
                                        </Button>

                                        <!-- Edit -->
                                        <Button
                                            size="sm"
                                            variant="ghost"
                                            @click="openTaskDialog(task)"
                                            class="hover:bg-blue-50 dark:hover:bg-blue-900"
                                            title="Edit task"
                                        >
                                            <Edit class="h-4 w-4 text-blue-600" />
                                        </Button>

                                        <!-- Delete -->
                                        <Button
                                            size="sm"
                                            variant="ghost"
                                            @click="deleteTask(task)"
                                            class="hover:bg-red-50 dark:hover:bg-red-900"
                                            title="Delete task"
                                        >
                                            <Trash2 class="h-4 w-4 text-red-500" />
                                        </Button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- Desktop Empty State -->
                        <div v-if="filteredTasks.length === 0" class="text-center py-12">
                            <div class="text-gray-400 dark:text-gray-500 mb-4">
                                <Plus class="h-12 w-12 mx-auto" />
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No tasks found</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">
                                {{ selectedCategory === 'all' ? 'Get started by adding your first wedding task.' : 'No tasks in this category yet.' }}
                            </p>
                            <Button @click="openTaskDialog()" class="bg-rose-500 hover:bg-rose-600 text-white">
                                <Plus class="mr-2 h-4 w-4" />
                                Add Task
                            </Button>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden px-4 pb-6 space-y-3">
            <!-- Mobile Empty State -->
            <div v-if="filteredTasks.length === 0" class="text-center py-12">
                <div class="text-gray-400 dark:text-gray-500 mb-4">
                    <Plus class="h-12 w-12 mx-auto" />
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No tasks found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 px-4">
                    {{ selectedCategory === 'all' ? 'Get started by adding your first wedding task.' : 'No tasks in this category yet.' }}
                </p>
                <Button @click="openTaskDialog()" class="bg-rose-500 hover:bg-rose-600 text-white">
                    <Plus class="mr-2 h-4 w-4" />
                    Add Task
                </Button>
            </div>

            <!-- Task Cards -->
            <Card
                v-for="task in filteredTasks"
                :key="task.id"
                :class="[
                    'transition-all duration-200 border-l-4',
                    task.is_completed
                        ? 'bg-green-50 border-l-green-500 dark:bg-green-950 dark:border-l-green-400'
                        : 'border-l-rose-500 hover:shadow-md'
                ]"
            >
                <CardContent class="p-4">
                    <!-- Header Row -->
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <h3 :class="[
                                'font-medium text-sm leading-tight',
                                task.is_completed
                                    ? 'line-through text-gray-500 dark:text-gray-400'
                                    : 'text-gray-900 dark:text-gray-100'
                            ]">
                                {{ task.title }}
                            </h3>
                            <p v-if="task.description" :class="[
                                'text-xs mt-1 line-clamp-2',
                                task.is_completed
                                    ? 'line-through text-gray-400 dark:text-gray-500'
                                    : 'text-gray-600 dark:text-gray-400'
                            ]">
                                {{ task.description }}
                            </p>
                        </div>

                        <!-- Quick Complete Button -->
                        <Button
                            size="sm"
                            variant="ghost"
                            @click="toggleTask(task)"
                            :class="[
                                'ml-3 p-2 shrink-0',
                                task.is_completed
                                    ? 'text-orange-600 hover:bg-orange-50 dark:hover:bg-orange-900'
                                    : 'text-green-600 hover:bg-green-50 dark:hover:bg-green-900'
                            ]"
                        >
                            <Check v-if="!task.is_completed" class="h-4 w-4" />
                            <X v-else class="h-4 w-4" />
                        </Button>
                    </div>

                    <!-- Info Row -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 flex-wrap">
                            <!-- Category Badge -->
                            <Badge :class="task.category_color" variant="secondary" class="text-xs">
                                {{ task.category_icon }} {{ task.category_display }}
                            </Badge>

                            <!-- Priority Badge -->
                            <Badge :class="task.priority_color" variant="outline" class="text-xs">
                                {{ task.priority_display }}
                            </Badge>

                            <!-- Deadline -->
                            <div v-if="task.deadline" class="flex items-center gap-1 text-xs">
                                <Calendar class="h-3 w-3" />
                                <span :class="[
                                    isOverdue(task.deadline) && !task.is_completed
                                        ? 'text-red-600 dark:text-red-400 font-medium'
                                        : 'text-gray-500 dark:text-gray-400'
                                ]">
                                    {{ formatDateMobile(task.deadline) }}
                                </span>
                                <AlertTriangle v-if="isOverdue(task.deadline) && !task.is_completed" class="h-3 w-3 text-red-500" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-1">
                            <Button
                                size="sm"
                                variant="ghost"
                                @click="openTaskDialog(task)"
                                class="p-2 hover:bg-blue-50 dark:hover:bg-blue-900"
                            >
                                <Edit class="h-4 w-4 text-blue-600" />
                            </Button>
                            <Button
                                size="sm"
                                variant="ghost"
                                @click="deleteTask(task)"
                                class="p-2 hover:bg-red-50 dark:hover:bg-red-900"
                            >
                                <Trash2 class="h-4 w-4 text-red-500" />
                            </Button>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>

        <!-- Completion Message -->
        <div v-if="stats.percentage === 100" class="p-4 md:px-6">
            <Card class="border-green-200 dark:border-green-700 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900">
                <CardContent class="py-6 text-center">
                    <div class="text-4xl mb-2">🎉</div>
                    <h3 class="text-xl font-bold text-green-800 dark:text-green-200 mb-2">All tasks completed!</h3>
                    <p class="text-green-700 dark:text-green-300">
                        Congratulations {{ settings.couple_name }}! You're ready for your special day! ♡
                    </p>
                </CardContent>
            </Card>
        </div>

        <!-- Bottom spacing for mobile -->
        <div class="md:hidden h-6"></div>
    </div>
</template>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
