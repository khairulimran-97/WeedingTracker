<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Progress } from '@/components/ui/progress'
import { Heart, Calendar, CheckCircle, Clock, Sparkles } from 'lucide-vue-next'

interface WeddingTask {
    id: number
    title: string
    description?: string
    category: string
    priority: string
    is_completed: boolean
    deadline?: string
    notes?: any
    sort_order: number
}

interface WeddingSettings {
    bride_name: string
    groom_name: string
    hashtag: string
    wedding_date: string
    theme_color: string
    couple_name: string
    days_until_wedding: number
    is_wedding_today: boolean
    is_wedding_past: boolean
}

interface Props {
    settings: WeddingSettings
    tasks: WeddingTask[]
    stats: {
        total: number
        completed: number
        remaining: number
        percentage: number
    }
    categoryStats: Record<string, { total: number; completed: number; remaining: number }>
    timeUntilWedding?: {
        days: number
        hours: number
        minutes: number
        seconds: number
    }
}

const props = defineProps<Props>()

const selectedCategory = ref('all')

    <script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Progress } from '@/components/ui/progress'
import { Heart, Calendar, CheckCircle, Clock, Sparkles } from 'lucide-vue-next'

interface WeddingTask {
    id: number
    title: string
    description?: string
    category: string
    priority: string
    is_completed: boolean
    deadline?: string
    notes?: any
    sort_order: number
    category_display: string
    category_icon: string
    category_color: string
    priority_display: string
    priority_color: string
}

interface WeddingSettings {
    bride_name: string
    groom_name: string
    hashtag: string
    wedding_date: string
    theme_color: string
    couple_name: string
    days_until_wedding: number
    is_wedding_today: boolean
    is_wedding_past: boolean
}

interface CategoryOption {
    value: string
    label: string
    icon: string
    color: string
}

interface PriorityOption {
    value: string
    label: string
    color: string
    textColor: string
    sortOrder: number
}

interface Props {
    settings: WeddingSettings
    tasks: WeddingTask[]
    stats: {
        total: number
        completed: number
        remaining: number
        percentage: number
    }
    categoryStats: Record<string, { total: number; completed: number; remaining: number }>
    priorityStats: Record<string, { total: number; completed: number; remaining: number }>
    timeUntilWedding?: {
        days: number
        hours: number
        minutes: number
        seconds: number
    }
    categories: CategoryOption[]
    priorities: PriorityOption[]
}

const props = defineProps<Props>()

const selectedCategory = ref('all')

const filteredTasks = computed(() => {
    if (selectedCategory.value === 'all') {
        return props.tasks
    }
    return props.tasks.filter(task => task.category === selectedCategory.value)
})

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    })
}
</script>

<template>
    <Head title="Wedding Progress - Madihah & Khairul" />

    <div class="min-h-screen bg-gradient-to-br from-rose-100 via-pink-100 to-red-100">
        <!-- Header Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-rose-500 via-pink-500 to-red-500 px-4 py-16 text-white">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-10 left-10 h-20 w-20 rounded-full bg-white/20"></div>
                <div class="absolute bottom-20 right-20 h-16 w-16 rounded-full bg-white/20"></div>
                <div class="absolute top-32 right-32 h-12 w-12 rounded-full bg-white/20"></div>
            </div>

            <div class="relative mx-auto max-w-4xl text-center">
                <div class="mb-6 flex items-center justify-center gap-3">
                    <Heart class="h-10 w-10 animate-pulse" fill="currentColor" />
                    <h1 class="text-5xl font-bold tracking-tight lg:text-7xl">
                        {{ settings.couple_name }}
                    </h1>
                    <Heart class="h-10 w-10 animate-pulse" fill="currentColor" />
                </div>

                <p class="text-2xl font-medium opacity-90 mb-8">{{ settings.hashtag }}</p>

                <div class="flex items-center justify-center gap-4 text-xl mb-8">
                    <Calendar class="h-6 w-6" />
                    <span class="font-semibold">{{ formatDate(settings.wedding_date) }}</span>
                    <Sparkles class="h-6 w-6" />
                    <span v-if="settings.is_wedding_today" class="font-bold text-yellow-300 animate-pulse">
            🎉 Wedding Day! 🎉
          </span>
                    <span v-else-if="!settings.is_wedding_past" class="font-semibold">
            Wedding Day!
          </span>
                </div>
            </div>
        </div>

        <!-- Progress Overview -->
        <div class="mx-auto max-w-5xl px-4 py-12">
            <Card class="mb-12 border-rose-200 bg-white/90 backdrop-blur-sm shadow-xl">
                <CardHeader className="text-center pb-6">
                    <CardTitle className="text-3xl text-gray-800 mb-2">Wedding Preparation Progress</CardTitle>
                    <p class="text-lg text-gray-600">Keep track of your special day preparations</p>
                </CardHeader>
                <CardContent class="pb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div class="text-center">
                            <div class="text-5xl font-bold text-green-600 mb-2">{{ stats.completed }}</div>
                            <div class="text-lg text-gray-600 font-medium">Completed</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-bold text-orange-600 mb-2">{{ stats.remaining }}</div>
                            <div class="text-lg text-gray-600 font-medium">Remaining</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-bold text-rose-600 mb-2">{{ stats.percentage }}%</div>
                            <div class="text-lg text-gray-600 font-medium">Progress</div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between text-lg text-gray-700 font-medium">
                            <span>Overall Progress</span>
                            <span>{{ stats.percentage }}%</span>
                        </div>
                        <Progress :value="stats.percentage" class="h-4 bg-gray-200" />
                    </div>
                </CardContent>
            </Card>

            <!-- Category Filters -->
            <div class="mb-8 flex flex-wrap gap-3 justify-center">
                <Button
                    variant="outline"
                    size="lg"
                    :class="[
            'transition-all duration-200 text-base font-medium px-6 py-3',
            selectedCategory === 'all'
              ? 'bg-rose-500 text-white border-rose-500 shadow-lg'
              : 'bg-white/80 hover:bg-rose-50 border-rose-200'
          ]"
                    @click="selectedCategory = 'all'"
                >
                    All Tasks ({{ stats.total }})
                </Button>

                <Button
                    v-for="category in categories"
                    :key="category.value"
                    variant="outline"
                    size="lg"
                    :class="[
            'transition-all duration-200 text-base font-medium px-6 py-3',
            selectedCategory === category.value
              ? 'bg-rose-500 text-white border-rose-500 shadow-lg'
              : 'bg-white/80 hover:bg-rose-50 border-rose-200'
          ]"
                    @click="selectedCategory = category.value"
                >
                    {{ category.icon }} {{ category.label }}
                    ({{ categoryStats[category.value]?.total || 0 }})
                </Button>
            </div>

            <!-- Tasks Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <Card
                    v-for="task in filteredTasks"
                    :key="task.id"
                    :class="[
            'transition-all duration-300 hover:shadow-xl border-l-4 transform hover:-translate-y-1',
            task.is_completed
              ? 'bg-gradient-to-br from-green-50 to-emerald-50 border-l-green-400'
              : 'bg-white/90 border-l-rose-400 hover:bg-white'
          ]"
                >
                    <CardHeader class="pb-4">
                        <div class="flex items-center justify-between mb-3">
                            <Badge :class="task.category_color" variant="secondary" class="text-sm px-3 py-1">
                                {{ task.category_icon }} {{ task.category_display }}
                            </Badge>
                            <CheckCircle
                                v-if="task.is_completed"
                                class="h-6 w-6 text-green-500 fill-current"
                            />
                        </div>

                        <CardTitle
                            :class="[
                'text-lg leading-tight',
                task.is_completed ? 'line-through text-gray-500' : 'text-gray-800'
              ]"
                        >
                            {{ task.title }}
                        </CardTitle>
                    </CardHeader>

                    <CardContent>
                        <p v-if="task.description" class="text-gray-600 mb-4 text-sm leading-relaxed">
                            {{ task.description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <Badge
                                :class="task.priority_color"
                                variant="outline"
                                class="text-xs font-medium"
                            >
                                {{ task.priority_display }}
                            </Badge>

                            <div v-if="task.deadline" class="flex items-center gap-1 text-xs text-gray-500">
                                <Clock class="h-3 w-3" />
                                {{ formatDate(task.deadline) }}
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>

            <!-- Completion Message -->
            <div v-if="stats.percentage === 100" class="mt-16 text-center">
                <Card class="mx-auto max-w-3xl border-green-200 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 shadow-2xl">
                    <CardContent class="py-12">
                        <div class="mb-6">
                            <div class="text-8xl mb-4 animate-bounce">🎉</div>
                            <div class="flex items-center justify-center gap-2 mb-4">
                                <Heart class="h-8 w-8 text-green-600 animate-pulse" fill="currentColor" />
                                <Sparkles class="h-8 w-8 text-green-600 animate-pulse" />
                                <Heart class="h-8 w-8 text-green-600 animate-pulse" fill="currentColor" />
                            </div>
                        </div>

                        <h3 class="text-4xl font-bold text-green-800 mb-4">Congratulations!</h3>
                        <p class="text-xl text-green-700 leading-relaxed max-w-2xl mx-auto">
                            All wedding preparations are complete! You're ready for your special day,
                            <span class="font-semibold">{{ settings.couple_name }}</span>! ♡
                        </p>
                    </CardContent>
                </Card>
            </div>

            <!-- Footer -->
            <div class="mt-16 text-center">
                <p class="text-gray-500 text-sm">
                    Made with ♡ for {{ settings.couple_name }}
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animate-bounce {
    animation: bounce 1s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(-25%);
        animation-timing-function: cubic-bezier(0.8,0,1,1);
    }
    50% {
        transform: none;
        animation-timing-function: cubic-bezier(0,0,0.2,1);
    }
}
</style>

const filteredTasks = computed(() => {
if (selectedCategory.value === 'all') {
return props.tasks
}
return props.tasks.filter(task => task.category === selectedCategory.value)
})

const getCategoryInfo = (categoryValue: string) => {
return categories.find(cat => cat.value === categoryValue) || categories[0]
}

const formatDate = (dateString: string) => {
return new Date(dateString).toLocaleDateString('en-US', {
year: 'numeric',
month: 'long',
day: 'numeric'
})
}
</script>

<template>
    <Head title="Wedding Progress - Madihah & Khairul" />

    <div class="min-h-screen bg-gradient-to-br from-rose-100 via-pink-100 to-red-100">
        <!-- Header Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-rose-500 via-pink-500 to-red-500 px-4 py-16 text-white">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-10 left-10 h-20 w-20 rounded-full bg-white/20"></div>
                <div class="absolute bottom-20 right-20 h-16 w-16 rounded-full bg-white/20"></div>
                <div class="absolute top-32 right-32 h-12 w-12 rounded-full bg-white/20"></div>
            </div>

            <div class="relative mx-auto max-w-4xl text-center">
                <div class="mb-6 flex items-center justify-center gap-3">
                    <Heart class="h-10 w-10 animate-pulse" fill="currentColor" />
                    <h1 class="text-5xl font-bold tracking-tight lg:text-7xl">
                        {{ settings.couple_name }}
                    </h1>
                    <Heart class="h-10 w-10 animate-pulse" fill="currentColor" />
                </div>

                <p class="text-2xl font-medium opacity-90 mb-8">{{ settings.hashtag }}</p>

                <div class="flex items-center justify-center gap-4 text-xl mb-8">
                    <Calendar class="h-6 w-6" />
                    <span class="font-semibold">{{ formatDate(settings.wedding_date) }}</span>
                    <Sparkles class="h-6 w-6" />
                    <span v-if="settings.is_wedding_today" class="font-bold text-yellow-300 animate-pulse">
            🎉 Wedding Day! 🎉
          </span>
                    <span v-else-if="!settings.is_wedding_past" class="font-semibold">
            Wedding Day!
          </span>
                </div>
            </div>
        </div>

        <!-- Progress Overview -->
        <div class="mx-auto max-w-5xl px-4 py-12">
            <Card class="mb-12 border-rose-200 bg-white/90 backdrop-blur-sm shadow-xl">
                <CardHeader className="text-center pb-6">
                    <CardTitle className="text-3xl text-gray-800 mb-2">Wedding Preparation Progress</CardTitle>
                    <p class="text-lg text-gray-600">Keep track of your special day preparations</p>
                </CardHeader>
                <CardContent class="pb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div class="text-center">
                            <div class="text-5xl font-bold text-green-600 mb-2">{{ stats.completed }}</div>
                            <div class="text-lg text-gray-600 font-medium">Completed</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-bold text-orange-600 mb-2">{{ stats.remaining }}</div>
                            <div class="text-lg text-gray-600 font-medium">Remaining</div>
                        </div>
                        <div class="text-center">
                            <div class="text-5xl font-bold text-rose-600 mb-2">{{ stats.percentage }}%</div>
                            <div class="text-lg text-gray-600 font-medium">Progress</div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between text-lg text-gray-700 font-medium">
                            <span>Overall Progress</span>
                            <span>{{ stats.percentage }}%</span>
                        </div>
                        <Progress :value="stats.percentage" class="h-4 bg-gray-200" />
                    </div>
                </CardContent>
            </Card>

            <!-- Category Filters -->
            <div class="mb-8 flex flex-wrap gap-3 justify-center">
                <Button
                    variant="outline"
                    size="lg"
                    :class="[
            'transition-all duration-200 text-base font-medium px-6 py-3',
            selectedCategory === 'all'
              ? 'bg-rose-500 text-white border-rose-500 shadow-lg'
              : 'bg-white/80 hover:bg-rose-50 border-rose-200'
          ]"
                    @click="selectedCategory = 'all'"
                >
                    All Tasks ({{ stats.total }})
                </Button>

                <Button
                    v-for="category in categories"
                    :key="category.value"
                    variant="outline"
                    size="lg"
                    :class="[
            'transition-all duration-200 text-base font-medium px-6 py-3',
            selectedCategory === category.value
              ? 'bg-rose-500 text-white border-rose-500 shadow-lg'
              : 'bg-white/80 hover:bg-rose-50 border-rose-200'
          ]"
                    @click="selectedCategory = category.value"
                >
                    {{ category.icon }} {{ category.label }}
                    ({{ categoryStats[category.value]?.total || 0 }})
                </Button>
            </div>

            <!-- Tasks Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <Card
                    v-for="task in filteredTasks"
                    :key="task.id"
                    :class="[
            'transition-all duration-300 hover:shadow-xl border-l-4 transform hover:-translate-y-1',
            task.is_completed
              ? 'bg-gradient-to-br from-green-50 to-emerald-50 border-l-green-400'
              : 'bg-white/90 border-l-rose-400 hover:bg-white'
          ]"
                >
                    <CardHeader class="pb-4">
                        <div class="flex items-center justify-between mb-3">
                            <Badge :class="getCategoryInfo(task.category).color" variant="secondary" class="text-sm px-3 py-1">
                                {{ getCategoryInfo(task.category).icon }} {{ getCategoryInfo(task.category).label }}
                            </Badge>
                            <CheckCircle
                                v-if="task.is_completed"
                                class="h-6 w-6 text-green-500 fill-current"
                            />
                        </div>

                        <CardTitle
                            :class="[
                'text-lg leading-tight',
                task.is_completed ? 'line-through text-gray-500' : 'text-gray-800'
              ]"
                        >
                            {{ task.title }}
                        </CardTitle>
                    </CardHeader>

                    <CardContent>
                        <p v-if="task.description" class="text-gray-600 mb-4 text-sm leading-relaxed">
                            {{ task.description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <Badge
                                :class="{
                  'bg-red-100 text-red-700 border-red-200': task.priority === 'high',
                  'bg-yellow-100 text-yellow-700 border-yellow-200': task.priority === 'medium',
                  'bg-green-100 text-green-700 border-green-200': task.priority === 'low'
                }"
                                variant="outline"
                                class="text-xs font-medium"
                            >
                                {{ task.priority.toUpperCase() }}
                            </Badge>

                            <div v-if="task.deadline" class="flex items-center gap-1 text-xs text-gray-500">
                                <Clock class="h-3 w-3" />
                                {{ formatDate(task.deadline) }}
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>

            <!-- Completion Message -->
            <div v-if="stats.percentage === 100" class="mt-16 text-center">
                <Card class="mx-auto max-w-3xl border-green-200 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 shadow-2xl">
                    <CardContent class="py-12">
                        <div class="mb-6">
                            <div class="text-8xl mb-4 animate-bounce">🎉</div>
                            <div class="flex items-center justify-center gap-2 mb-4">
                                <Heart class="h-8 w-8 text-green-600 animate-pulse" fill="currentColor" />
                                <Sparkles class="h-8 w-8 text-green-600 animate-pulse" />
                                <Heart class="h-8 w-8 text-green-600 animate-pulse" fill="currentColor" />
                            </div>
                        </div>

                        <h3 class="text-4xl font-bold text-green-800 mb-4">Congratulations!</h3>
                        <p class="text-xl text-green-700 leading-relaxed max-w-2xl mx-auto">
                            All wedding preparations are complete! You're ready for your special day,
                            <span class="font-semibold">{{ settings.couple_name }}</span>! ♡
                        </p>
                    </CardContent>
                </Card>
            </div>

            <!-- Footer -->
            <div class="mt-16 text-center">
                <p class="text-gray-500 text-sm">
                    Made with ♡ for {{ settings.couple_name }}
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animate-bounce {
    animation: bounce 1s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(-25%);
        animation-timing-function: cubic-bezier(0.8,0,1,1);
    }
    50% {
        transform: none;
        animation-timing-function: cubic-bezier(0,0,0.2,1);
    }
}
</style>
