<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Checkbox } from '@/components/ui/checkbox'
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { Badge } from '@/components/ui/badge'
import { Plus, Edit, Trash2, Settings, Sun, Moon, Monitor } from 'lucide-vue-next'
import { useAppearance } from '@/composables/useAppearance'
import type { WeddingPageProps, WeddingTask, TaskFormData, SettingsFormData } from '@/types'

type Props = WeddingPageProps

const props = defineProps<Props>()

const { appearance, updateAppearance } = useAppearance()

const selectedCategory = ref('all')
const showTaskDialog = ref(false)
const showSettingsDialog = ref(false)
const editingTask = ref<WeddingTask | null>(null)
const toggleTaskId = ref<number | null>(null)

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

const toggleTask = (task: WeddingTask, checked: boolean) => {
    // Prevent multiple simultaneous requests
    if (toggleTaskId.value === task.id) return

    toggleTaskId.value = task.id
    const originalStatus = task.is_completed

    // Optimistically update the UI
    task.is_completed = checked

    useForm({}).post(`/tasks/${task.id}/toggle`, {
        preserveScroll: true,
        onFinish: () => {
            toggleTaskId.value = null
        },
        onError: () => {
            // Revert on error
            task.is_completed = originalStatus
        }
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
</script>

<template>
    <Head title="Wedding Dashboard" />

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <!-- Header with Settings Menu -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    Wedding Tasks - {{ settings.couple_name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ stats.completed }}/{{ stats.total }} tasks completed ({{ stats.percentage }}%) •
                    Wedding Date: {{ formatDate(settings.wedding_date) }}
                    <span v-if="!settings.is_wedding_past"> • {{ settings.days_until_wedding }} days to go</span>
                </p>
            </div>

            <!-- Settings Menu -->
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
        <!-- Wedding Settings Dialog -->
        <Dialog v-model:open="showSettingsDialog">
            <DialogContent class="max-w-md">
                <DialogHeader>
                    <DialogTitle>Wedding Settings</DialogTitle>
                </DialogHeader>
                <form @submit.prevent="saveSettings" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
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
                    <div class="flex justify-end gap-2 pt-4">
                        <Button type="button" variant="outline" @click="showSettingsDialog = false">
                            Cancel
                        </Button>
                        <Button type="submit" class="bg-rose-500 hover:bg-rose-600" :disabled="settingsForm.processing">
                            Save Settings
                        </Button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>

        <!-- Controls -->
        <div class="mb-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
            <!-- Category Filter -->
            <div class="flex flex-wrap gap-2">
                <Button
                    variant="outline"
                    size="sm"
                    :class="[
                        'border-gray-300 dark:border-gray-600',
                        selectedCategory === 'all' ? 'bg-rose-100 border-rose-300 dark:bg-rose-900 dark:border-rose-700' : ''
                    ]"
                    @click="selectedCategory = 'all'"
                >
                    All ({{ stats.total }})
                </Button>
                <Button
                    v-for="category in categories"
                    :key="category.value"
                    variant="outline"
                    size="sm"
                    :class="[
                        'border-gray-300 dark:border-gray-600',
                        selectedCategory === category.value ? 'bg-rose-100 border-rose-300 dark:bg-rose-900 dark:border-rose-700' : ''
                    ]"
                    @click="selectedCategory = category.value"
                >
                    {{ category.icon }} {{ category.label }}
                    ({{ categoryStats[category.value]?.total || 0 }})
                </Button>
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

        <!-- Tasks Table -->
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
                                'hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200',
                                task.is_completed ? 'opacity-75 bg-green-50/30 dark:bg-green-900/10' : ''
                            ]">
                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <Checkbox
                                        :checked="task.is_completed"
                                        @update:checked="(checked) => toggleTask(task, checked)"
                                        :disabled="toggleTaskId === task.id"
                                        class="mr-3 data-[state=checked]:bg-green-600 data-[state=checked]:border-green-600"
                                    />
                                    <span :class="[
                                            'text-sm font-medium transition-all duration-200',
                                            task.is_completed
                                                ? 'text-green-600 dark:text-green-400'
                                                : 'text-gray-500 dark:text-gray-400',
                                            toggleTaskId === task.id ? 'opacity-50' : ''
                                        ]">
                                            {{ toggleTaskId === task.id ? 'Updating...' : (task.is_completed ? 'Completed' : 'Pending') }}
                                        </span>
                                </div>
                            </td>

                            <!-- Task -->
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <div :class="[
                                            'text-sm font-medium transition-all duration-200',
                                            task.is_completed
                                                ? 'line-through text-gray-500 dark:text-gray-400'
                                                : 'text-gray-900 dark:text-gray-100'
                                        ]">
                                        {{ task.title }}
                                    </div>
                                    <div v-if="task.description" :class="[
                                            'text-sm mt-1 truncate transition-all duration-200',
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
                                {{ task.deadline ? formatDate(task.deadline) : '-' }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <Button
                                        size="sm"
                                        variant="ghost"
                                        @click="openTaskDialog(task)"
                                        class="hover:bg-blue-50 dark:hover:bg-blue-900"
                                    >
                                        <Edit class="h-4 w-4 text-blue-600" />
                                    </Button>
                                    <Button
                                        size="sm"
                                        variant="ghost"
                                        @click="deleteTask(task)"
                                        class="hover:bg-red-50 dark:hover:bg-red-900"
                                    >
                                        <Trash2 class="h-4 w-4 text-red-500" />
                                    </Button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Empty State -->
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

        <!-- Completion Message -->
        <div v-if="stats.percentage === 100" class="mt-8">
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
    </div>
</template>
