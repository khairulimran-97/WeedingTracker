<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Checkbox } from '@/components/ui/checkbox'
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { Badge } from '@/components/ui/badge'
import { Progress } from '@/components/ui/progress'
import { Heart, Calendar, Clock, Plus, Edit, Trash2 } from 'lucide-vue-next'
import type { WeddingPageProps, WeddingTask, TaskFormData } from '@/types'

type Props = WeddingPageProps

const props = defineProps<Props>()

const selectedCategory = ref('all')
const showTaskDialog = ref(false)
const editingTask = ref<WeddingTask | null>(null)

const taskForm = useForm<TaskFormData>({
    title: '',
    description: '',
    category: 'legal',
    priority: 'medium',
    deadline: '',
    notes: []
})

const filteredTasks = computed(() => {
    if (selectedCategory.value === 'all') {
        return props.tasks
    }
    return props.tasks.filter(task => task.category === selectedCategory.value)
})

const toggleTask = (task: WeddingTask) => {
    useForm({}).post(`/tasks/${task.id}/toggle`)
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
    }
    showTaskDialog.value = true
}

const saveTask = () => {
    if (editingTask.value) {
        taskForm.patch(`/tasks/${editingTask.value.id}`, {
            onSuccess: () => {
                showTaskDialog.value = false
                taskForm.reset()
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

const deleteTask = (task: WeddingTask) => {
    if (confirm('Are you sure you want to delete this task?')) {
        useForm({}).delete(`/tasks/${task.id}`)
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

    <AppLayout>
        <div class="min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-red-50">
            <!-- Header Section -->
            <div class="relative overflow-hidden bg-gradient-to-r from-rose-400 via-pink-400 to-red-400 px-4 py-12 text-white">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative mx-auto max-w-4xl text-center">
                    <div class="mb-4 flex items-center justify-center gap-2">
                        <Heart class="h-8 w-8 animate-pulse" fill="currentColor" />
                        <h1 class="text-4xl font-bold tracking-tight lg:text-6xl">
                            {{ settings.couple_name }}
                        </h1>
                        <Heart class="h-8 w-8 animate-pulse" fill="currentColor" />
                    </div>
                    <p class="text-xl font-medium opacity-90">{{ settings.hashtag }}</p>
                    <div class="mt-6 flex items-center justify-center gap-2 text-lg">
                        <Calendar class="h-5 w-5" />
                        <span>{{ formatDate(settings.wedding_date) }}</span>
                        <span v-if="!settings.is_wedding_past" class="mx-2">•</span>
                        <span v-if="settings.is_wedding_today" class="font-bold text-yellow-300 animate-pulse">
                            🎉 Wedding Day! 🎉
                        </span>
                        <span v-else-if="!settings.is_wedding_past" class="font-semibold">
                            {{ settings.days_until_wedding }} days to go!
                        </span>
                    </div>
                </div>
            </div>

            <!-- Progress Overview -->
            <div class="mx-auto max-w-6xl px-4 py-8">
                <Card class="mb-8 border-rose-200 bg-white/80 backdrop-blur-sm">
                    <CardHeader class="text-center">
                        <CardTitle class="text-2xl text-gray-800">Wedding Preparation Progress</CardTitle>
                        <p class="text-gray-600">Keep track of your special day preparations</p>
                    </CardHeader>
                    <CardContent>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600">{{ stats.completed }}</div>
                                <div class="text-sm text-gray-600">Completed</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-orange-600">{{ stats.remaining }}</div>
                                <div class="text-sm text-gray-600">Remaining</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-rose-600">{{ stats.percentage }}%</div>
                                <div class="text-sm text-gray-600">Progress</div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Overall Progress</span>
                                <span>{{ stats.percentage }}%</span>
                            </div>
                            <Progress :value="stats.percentage" class="h-3" />
                        </div>
                    </CardContent>
                </Card>

                <!-- Category Filters -->
                <div class="mb-6 flex flex-wrap gap-2">
                    <Button
                        variant="outline"
                        size="sm"
                        :class="selectedCategory === 'all' ? 'bg-rose-100 border-rose-300' : ''"
                        @click="selectedCategory = 'all'"
                    >
                        All Tasks ({{ stats.total }})
                    </Button>
                    <Button
                        v-for="category in categories"
                        :key="category.value"
                        variant="outline"
                        size="sm"
                        :class="selectedCategory === category.value ? 'bg-rose-100 border-rose-300' : ''"
                        @click="selectedCategory = category.value"
                    >
                        {{ category.icon }} {{ category.label }}
                        ({{ categoryStats[category.value]?.total || 0 }})
                    </Button>
                </div>

                <!-- Add Task Button -->
                <div class="mb-6">
                    <Dialog v-model:open="showTaskDialog">
                        <DialogTrigger as-child>
                            <Button @click="openTaskDialog()" class="bg-rose-500 hover:bg-rose-600">
                                <Plus class="mr-2 h-4 w-4" />
                                Add New Task
                            </Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>
                                    {{ editingTask ? 'Edit Task' : 'Add New Task' }}
                                </DialogTitle>
                            </DialogHeader>
                            <form @submit.prevent="saveTask" class="space-y-4">
                                <div>
                                    <Label for="title">Task Title</Label>
                                    <Input v-model="taskForm.title" required />
                                </div>
                                <div>
                                    <Label for="description">Description</Label>
                                    <Textarea v-model="taskForm.description" />
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <Label for="category">Category</Label>
                                        <Select v-model="taskForm.category">
                                            <SelectTrigger>
                                                <SelectValue />
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
                                        <Select v-model="taskForm.priority">
                                            <SelectTrigger>
                                                <SelectValue />
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
                                    <Label for="deadline">Deadline</Label>
                                    <Input type="date" v-model="taskForm.deadline" />
                                </div>
                                <div class="flex justify-end gap-2">
                                    <Button type="button" variant="outline" @click="showTaskDialog = false">
                                        Cancel
                                    </Button>
                                    <Button type="submit" class="bg-rose-500 hover:bg-rose-600">
                                        {{ editingTask ? 'Update' : 'Create' }} Task
                                    </Button>
                                </div>
                            </form>
                        </DialogContent>
                    </Dialog>
                </div>

                <!-- Tasks Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <Card
                        v-for="task in filteredTasks"
                        :key="task.id"
                        :class="[
                            'transition-all duration-200 hover:shadow-lg border-l-4',
                            task.is_completed
                                ? 'bg-green-50 border-l-green-400 opacity-75'
                                : 'bg-white border-l-rose-400'
                        ]"
                    >
                        <CardHeader class="pb-3">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-2">
                                    <Checkbox
                                        :checked="task.is_completed"
                                        @update:checked="() => toggleTask(task)"
                                    />
                                    <Badge :class="task.category_color" variant="secondary">
                                        {{ task.category_icon }} {{ task.category_display }}
                                    </Badge>
                                </div>
                                <div class="flex gap-1">
                                    <Button size="sm" variant="ghost" @click="openTaskDialog(task)">
                                        <Edit class="h-3 w-3" />
                                    </Button>
                                    <Button size="sm" variant="ghost" @click="deleteTask(task)">
                                        <Trash2 class="h-3 w-3" />
                                    </Button>
                                </div>
                            </div>
                            <CardTitle :class="task.is_completed ? 'line-through text-gray-500' : ''">
                                {{ task.title }}
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            <p v-if="task.description" class="text-sm text-gray-600 mb-3">
                                {{ task.description }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <Badge
                                    :class="task.priority_color"
                                    variant="outline"
                                >
                                    {{ task.priority_display }}
                                </Badge>
                                <div v-if="task.deadline" class="flex items-center gap-1">
                                    <Clock class="h-3 w-3" />
                                    {{ formatDate(task.deadline) }}
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Completion Message -->
                <div v-if="stats.percentage === 100" class="mt-12 text-center">
                    <Card class="mx-auto max-w-2xl border-green-200 bg-gradient-to-r from-green-50 to-emerald-50">
                        <CardContent class="py-8">
                            <div class="mb-4 text-6xl">🎉</div>
                            <h3 class="text-2xl font-bold text-green-800 mb-2">Congratulations!</h3>
                            <p class="text-green-700">
                                All wedding preparations are complete! You're ready for your special day, {{ settings.couple_name }}! ♡
                            </p>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}
</style>
