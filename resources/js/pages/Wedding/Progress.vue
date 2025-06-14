<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { computed, ref, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Progress } from '@/components/ui/progress'
import { Heart, Calendar, CheckCircle, Clock, Sparkles, Star } from 'lucide-vue-next'
import type { WeddingPageProps } from '@/types'

interface Props extends WeddingPageProps {}

const props = defineProps<Props>()

const selectedCategory = ref('all')
const currentTime = ref(new Date())
const clickedCard = ref(null)
const clickedCategory = ref(false)
const togglingTasks = ref(new Set())

// Update time every second for live countdown
let timeInterval: NodeJS.Timeout | null = null

onMounted(() => {
    timeInterval = setInterval(() => {
        currentTime.value = new Date()
    }, 1000)
})

onUnmounted(() => {
    if (timeInterval) {
        clearInterval(timeInterval)
    }
})

const filteredTasks = computed(() => {
    if (selectedCategory.value === 'all') {
        return props.tasks
    }
    return props.tasks.filter(task => task.category === selectedCategory.value)
})

const countdown = computed(() => {
    const weddingDate = new Date(props.settings.wedding_date)
    const now = currentTime.value
    const timeDiff = weddingDate.getTime() - now.getTime()

    if (timeDiff <= 0) {
        return { days: 0, hours: 0, minutes: 0, seconds: 0, isToday: true }
    }

    const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24))
    const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
    const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60))
    const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000)

    return { days, hours, minutes, seconds, isToday: false }
})

const backgroundFlowers = computed(() => [
    { emoji: '🌸', position: 'top-1/6 right-1/3', opacity: 'opacity-15', animation: 'animate-float-slow-reverse', class: 'flower-sakura', color: 'text-pink-300', size: 'text-2xl' },
    { emoji: '🌹', position: 'top-2/3 left-1/6', opacity: 'opacity-15', animation: 'animate-float-medium-reverse', class: 'flower-rose', color: 'text-rose-300', size: 'text-xl' },
    { emoji: '🌺', position: 'top-1/3 left-1/2', opacity: 'opacity-10', animation: 'animate-float-fast-reverse', class: 'flower-blossom', color: 'text-pink-400', size: 'text-lg' },
    { emoji: '🌸', position: 'bottom-1/4 right-1/6', opacity: 'opacity-15', animation: 'animate-float-slow', class: 'flower-cherry', color: 'text-pink-300', size: 'text-xl' },
    { emoji: '🌷', position: 'top-1/5 left-2/3', opacity: 'opacity-10', animation: 'animate-float-medium', class: 'flower-tulip', color: 'text-red-300', size: 'text-lg' },
    { emoji: '🌺', position: 'bottom-1/3 left-1/3', opacity: 'opacity-15', animation: 'animate-float-fast', class: 'flower-hibiscus', color: 'text-pink-400', size: 'text-2xl' },
    { emoji: '🌸', position: 'top-3/5 right-2/3', opacity: 'opacity-10', animation: 'animate-float-slow-reverse', class: 'flower-peony', color: 'text-rose-300', size: 'text-lg' },
    { emoji: '🪷', position: 'top-1/8 left-3/4', opacity: 'opacity-12', animation: 'animate-float-medium', class: 'flower-lotus', color: 'text-purple-300', size: 'text-xl' },
    { emoji: '🌼', position: 'bottom-1/5 right-2/5', opacity: 'opacity-13', animation: 'animate-float-fast-reverse', class: 'flower-daisy', color: 'text-yellow-300', size: 'text-lg' },
    { emoji: '🌻', position: 'top-2/5 right-1/8', opacity: 'opacity-11', animation: 'animate-float-slow', class: 'flower-sunflower', color: 'text-yellow-400', size: 'text-2xl' },

    // Additional flowers (11-50)
    { emoji: '🌸', position: 'top-1/7 left-1/7', opacity: 'opacity-12', animation: 'animate-float-medium', class: 'flower-1', color: 'text-pink-200', size: 'text-lg' },
    { emoji: '🌼', position: 'top-1/4 right-1/4', opacity: 'opacity-13', animation: 'animate-float-fast', class: 'flower-2', color: 'text-yellow-400', size: 'text-xl' },
    { emoji: '🌹', position: 'bottom-2/5 left-2/5', opacity: 'opacity-14', animation: 'animate-float-slow', class: 'flower-3', color: 'text-rose-400', size: 'text-2xl' },
    { emoji: '🌷', position: 'top-2/7 right-1/5', opacity: 'opacity-12', animation: 'animate-float-fast', class: 'flower-4', color: 'text-red-400', size: 'text-lg' },
    { emoji: '🌺', position: 'bottom-1/7 right-1/3', opacity: 'opacity-15', animation: 'animate-float-slow-reverse', class: 'flower-5', color: 'text-pink-500', size: 'text-xl' },
    { emoji: '🌻', position: 'top-1/9 left-2/3', opacity: 'opacity-11', animation: 'animate-float-medium-reverse', class: 'flower-6', color: 'text-yellow-500', size: 'text-2xl' },
    { emoji: '🌼', position: 'top-1/6 left-1/2', opacity: 'opacity-10', animation: 'animate-float-slow', class: 'flower-7', color: 'text-yellow-300', size: 'text-lg' },
    { emoji: '🌸', position: 'bottom-1/5 left-1/5', opacity: 'opacity-12', animation: 'animate-float-medium', class: 'flower-8', color: 'text-pink-300', size: 'text-xl' },
    { emoji: '🪷', position: 'top-1/3 right-1/6', opacity: 'opacity-14', animation: 'animate-float-fast', class: 'flower-9', color: 'text-purple-400', size: 'text-2xl' },
    { emoji: '🌷', position: 'bottom-1/6 right-2/3', opacity: 'opacity-13', animation: 'animate-float-slow-reverse', class: 'flower-10', color: 'text-red-300', size: 'text-lg' },

    ...Array.from({ length: 100 }, (_, i) => ({
        emoji: ['🌸', '🌺', '🌼', '🌷', '🌻', '🪷', '🌹'][i % 7],
        position: `top-${(i % 6) + 1}/6 ${i % 2 === 0 ? 'left' : 'right'}-${(i % 5) + 1}/6`,
        opacity: `opacity-${10 + (i % 6)}`,
        animation: ['animate-float-slow', 'animate-float-medium', 'animate-float-fast'][i % 3] + (i % 2 === 0 ? '' : '-reverse'),
        class: `flower-extra-${i + 11}`,
        color: ['text-pink-300', 'text-pink-400', 'text-rose-300', 'text-red-300', 'text-yellow-300', 'text-yellow-400', 'text-purple-300'][i % 7],
        size: ['text-lg', 'text-xl', 'text-2xl'][i % 3]
    }))
])

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    })
}

const handleCardClick = (taskId: string) => {
    clickedCard.value = taskId
    // Create ripple effect
    setTimeout(() => {
        clickedCard.value = null
    }, 600)
}

const handleCategoryChange = () => {
    clickedCategory.value = true
    setTimeout(() => {
        clickedCategory.value = false
    }, 300)
}

const toggleTaskCompletion = (task: any) => {
    // Prevent multiple rapid clicks
    if (togglingTasks.value.has(task.id)) {
        return
    }

    togglingTasks.value.add(task.id)

    // Use Inertia to make the request
    router.post(route('tasks.toggle', task.id), {}, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            // Remove from toggling set after success
            togglingTasks.value.delete(task.id)
        },
        onError: () => {
            // Remove from toggling set on error
            togglingTasks.value.delete(task.id)
        }
    })
}
</script>

<template>
    <Head title="Wedding Progress - Madihah & Khairul" />

    <div class="min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-red-50 relative overflow-hidden">
        <!-- Flowers -->
        <div
            v-for="(flower, index) in backgroundFlowers"
            :key="`flower-${index}`"
            :class="['absolute',
            flower.position,
            flower.opacity,
            flower.animation
        ]"
        >
            <div :class="[flower.class, flower.color, flower.size]">{{ flower.emoji }}</div>
        </div>

        <!-- Header Section -->
        <div class="relative overflow-hidden bg-gradient-to-br from-rose-400 via-pink-500 to-red-500 px-4 py-12 sm:py-16 text-white">
            <div class="absolute inset-0">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute top-5 sm:top-10 left-5 sm:left-10 h-12 sm:h-20 w-12 sm:w-20 rounded-full bg-white/20 animate-pulse"></div>
                <div class="absolute bottom-10 sm:bottom-20 right-10 sm:right-20 h-8 sm:h-16 w-8 sm:w-16 rounded-full bg-white/20 animate-pulse delay-300"></div>
                <div class="absolute top-20 sm:top-32 right-20 sm:right-32 h-6 sm:h-12 w-6 sm:w-12 rounded-full bg-white/20 animate-pulse delay-700"></div>
            </div>

            <div class="relative mx-auto max-w-4xl text-center">
                <div class="mb-4 sm:mb-6 flex items-center justify-center gap-2 sm:gap-3">
                    <Heart
                        class="h-6 w-6 sm:h-10 sm:w-10 animate-heartbeat cursor-pointer hover:scale-110 active:scale-125 transition-transform duration-200"
                        fill="currentColor"
                        @click="handleCardClick('heart-left')"
                    />
                    <h1 class="text-3xl sm:text-5xl lg:text-7xl font-bold tracking-tight">
                        {{ settings.couple_name }}
                    </h1>
                    <Heart
                        class="h-6 w-6 sm:h-10 sm:w-10 animate-heartbeat cursor-pointer hover:scale-110 active:scale-125 transition-transform duration-200"
                        fill="currentColor"
                        @click="handleCardClick('heart-right')"
                    />
                </div>

                <p class="text-lg sm:text-2xl font-medium opacity-90 mb-6 sm:mb-8">{{ settings.hashtag }}</p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 text-base sm:text-xl mb-6 sm:mb-8">
                    <div class="flex items-center gap-2">
                        <Calendar class="h-5 w-5 sm:h-6 sm:w-6" />
                        <span class="font-semibold">{{ formatDate(settings.wedding_date) }}</span>
                    </div>
                </div>

                <!-- Enhanced Countdown -->
                <div v-if="!countdown.isToday && !settings.is_wedding_past" class="bg-white/20 backdrop-blur-sm rounded-2xl p-4 sm:p-6 mx-4 sm:mx-8 cursor-pointer hover:bg-white/30 transition-all duration-300" @click="handleCardClick('countdown')">
                    <p class="text-sm sm:text-base font-medium mb-3 sm:mb-4 opacity-90">Our special day countdown</p>
                    <div class="grid grid-cols-4 gap-2 sm:gap-4">
                        <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer" @click.stop="handleCardClick('countdown-days')">
                            <div class="text-2xl sm:text-4xl font-bold mb-1">{{ countdown.days }}</div>
                            <div class="text-xs sm:text-sm opacity-80">Days</div>
                        </div>
                        <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer" @click.stop="handleCardClick('countdown-hours')">
                            <div class="text-2xl sm:text-4xl font-bold mb-1">{{ countdown.hours }}</div>
                            <div class="text-xs sm:text-sm opacity-80">Hours</div>
                        </div>
                        <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer" @click.stop="handleCardClick('countdown-minutes')">
                            <div class="text-2xl sm:text-4xl font-bold mb-1">{{ countdown.minutes }}</div>
                            <div class="text-xs sm:text-sm opacity-80">Minutes</div>
                        </div>
                        <div class="text-center hover:scale-110 transition-transform duration-200 cursor-pointer" @click.stop="handleCardClick('countdown-seconds')">
                            <div class="text-2xl sm:text-4xl font-bold mb-1">{{ countdown.seconds }}</div>
                            <div class="text-xs sm:text-sm opacity-80">Seconds</div>
                        </div>
                    </div>
                </div>

                <div v-else-if="countdown.isToday || settings.is_wedding_today" class="bg-gradient-to-r from-yellow-300 to-orange-300 text-orange-800 rounded-2xl p-4 sm:p-6 mx-4 sm:mx-8 animate-bounce">
                    <div class="text-2xl sm:text-4xl font-bold">🎉 Wedding Day! 🎉</div>
                    <p class="text-sm sm:text-base mt-2">Today is your special day!</p>
                </div>
            </div>
        </div>

        <!-- Compact Progress Overview -->
        <div class="mx-auto max-w-6xl px-4 py-8 sm:py-12">
            <Card class="mb-8 border-rose-200 bg-white/90 backdrop-blur-sm shadow-lg">
                <CardHeader class="text-center pb-3 sm:pb-4">
                    <CardTitle class="text-xl sm:text-2xl text-gray-800 mb-1">Preparation Progress</CardTitle>
                </CardHeader>
                <CardContent class="pb-4 sm:pb-6">
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 mb-4 sm:mb-6">
                        <div class="text-center cursor-pointer hover:scale-105 active:scale-110 transition-transform duration-200" @click="handleCardClick('completed')">
                            <div class="text-2xl sm:text-3xl font-bold text-green-600 mb-1 hover:animate-bounce">{{ stats.completed }}</div>
                            <div class="text-sm sm:text-base text-gray-600">Done</div>
                        </div>
                        <div class="text-center cursor-pointer hover:scale-105 active:scale-110 transition-transform duration-200" @click="handleCardClick('remaining')">
                            <div class="text-2xl sm:text-3xl font-bold text-orange-600 mb-1 hover:animate-bounce">{{ stats.remaining }}</div>
                            <div class="text-sm sm:text-base text-gray-600">Left</div>
                        </div>
                        <div class="text-center cursor-pointer hover:scale-105 active:scale-110 transition-transform duration-200" @click="handleCardClick('percentage')">
                            <div class="text-2xl sm:text-3xl font-bold text-rose-600 mb-1 hover:animate-bounce">{{ stats.percentage }}%</div>
                            <div class="text-sm sm:text-base text-gray-600">Complete</div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between text-sm sm:text-base text-gray-700 font-medium">
                            <span>Overall Progress</span>
                            <span>{{ stats.percentage }}%</span>
                        </div>
                        <Progress :value="stats.percentage" class="h-3 bg-gray-200" />
                    </div>
                </CardContent>
            </Card>

            <!-- Category Filter Dropdown -->
            <div class="mb-6 sm:mb-8 flex justify-center">
                <div class="relative w-full max-w-md">
                    <select
                        v-model="selectedCategory"
                        @change="handleCategoryChange"
                        :class="[
                            'w-full px-4 py-3 pr-10 text-sm font-medium bg-white/90 border-2 border-rose-200 rounded-xl shadow-lg focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition-all duration-200 appearance-none cursor-pointer hover:bg-white hover:shadow-xl active:scale-95',
                            clickedCategory ? 'animate-category-click' : ''
                        ]"
                    >
                        <option value="all" class="py-2">
                            ✨ All Tasks ({{ stats.total }})
                        </option>
                        <option
                            v-for="category in categories"
                            :key="category.value"
                            :value="category.value"
                            class="py-2"
                        >
                            {{ category.icon }} {{ category.label }} ({{ categoryStats[category.value]?.total || 0 }})
                        </option>
                    </select>

                    <!-- Custom dropdown arrow with animation -->
                    <div :class="[
                        'absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none transition-transform duration-200',
                        clickedCategory ? 'animate-heart-beat' : ''
                    ]">
                        <Heart class="h-5 w-5 text-rose-400" fill="currentColor" />
                    </div>
                </div>
            </div>

            <!-- Tasks Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <Card
                    v-for="task in filteredTasks"
                    :key="task.id"
                    @click="handleCardClick(task.id)"
                    :class="[
                        'transition-all duration-300 hover:shadow-xl border-l-4 border-r-4 transform hover:-translate-y-1 cursor-pointer active:scale-95 relative overflow-hidden',
                        task.is_completed
                            ? 'bg-gradient-to-br from-green-50 to-emerald-50 border-l-green-400 border-r-green-400'
                            : 'bg-white/90 border-l-rose-400 border-r-rose-400 hover:bg-white',
                        clickedCard === task.id ? 'animate-card-click' : ''
                    ]"
                >
                    <!-- Click ripple effect -->
                    <div v-if="clickedCard === task.id" class="absolute inset-0 bg-gradient-to-br from-rose-200/30 to-pink-200/30 animate-ripple pointer-events-none"></div>

                    <CardHeader class="pb-3 sm:pb-4">
                        <div class="flex items-center justify-between mb-2 sm:mb-3">
                            <Badge
                                :class="task.category_color"
                                variant="secondary"
                                class="text-xs px-2 py-1 cursor-pointer hover:scale-105 active:scale-110 transition-transform duration-200"
                                @click.stop="handleCardClick(`category-${task.id}`)"
                            >
                                {{ task.category_icon }} {{ task.category_display }}
                            </Badge>

                            <!-- Checkbox for task completion -->
                            <div class="flex items-center gap-2">
                                <label class="relative inline-flex items-center cursor-pointer" @click.stop>
                                    <input
                                        type="checkbox"
                                        :checked="task.is_completed"
                                        :disabled="togglingTasks.has(task.id)"
                                        @change="toggleTaskCompletion(task)"
                                        class="sr-only peer"
                                    />
                                    <div :class="[
                                        'relative w-6 h-6 rounded-lg border-2 transition-all duration-200 flex items-center justify-center',
                                        task.is_completed
                                            ? 'bg-green-500 border-green-500 text-white'
                                            : 'bg-white border-gray-300 hover:border-rose-400',
                                        togglingTasks.has(task.id) ? 'opacity-50 cursor-not-allowed' : 'hover:scale-110 active:scale-125'
                                    ]">
                                        <CheckCircle
                                            v-if="task.is_completed"
                                            class="h-4 w-4 fill-current"
                                        />
                                        <div
                                            v-else-if="togglingTasks.has(task.id)"
                                            class="w-3 h-3 border-2 border-rose-400 border-t-transparent rounded-full animate-spin"
                                        ></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <CardTitle
                            :class="[
                                'text-base sm:text-lg leading-tight',
                                task.is_completed ? 'line-through text-gray-500' : 'text-gray-800'
                            ]"
                        >
                            {{ task.title }}
                        </CardTitle>
                    </CardHeader>

                    <CardContent>
                        <p v-if="task.description" class="text-gray-600 mb-3 sm:mb-4 text-sm leading-relaxed">
                            {{ task.description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <Badge
                                :class="task.priority_color"
                                variant="outline"
                                class="text-xs font-medium cursor-pointer hover:scale-105 active:scale-110 transition-transform duration-200"
                                @click.stop="handleCardClick(`priority-${task.id}`)"
                            >
                                {{ task.priority_display }}
                            </Badge>

                            <div v-if="task.deadline" class="flex items-center gap-1 text-xs text-gray-500 cursor-pointer hover:scale-105 transition-transform duration-200" @click.stop="handleCardClick(`deadline-${task.id}`)">
                                <Clock class="h-3 w-3" />
                                <span class="hidden sm:inline">{{ formatDate(task.deadline) }}</span>
                                <span class="sm:hidden">{{ new Date(task.deadline).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) }}</span>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>

            <!-- Completion Message -->
            <div v-if="stats.percentage === 100" class="mt-12 sm:mt-16 text-center">
                <Card class="mx-auto max-w-3xl border-green-200 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 shadow-2xl">
                    <CardContent class="py-8 sm:py-12">
                        <div class="mb-4 sm:mb-6">
                            <div class="text-6xl sm:text-8xl mb-3 sm:mb-4 animate-bounce">🎉</div>
                            <div class="flex items-center justify-center gap-2 mb-3 sm:mb-4">
                                <Heart class="h-6 w-6 sm:h-8 sm:w-8 text-green-600 animate-pulse" fill="currentColor" />
                                <Sparkles class="h-6 w-6 sm:h-8 sm:w-8 text-green-600 animate-pulse" />
                                <Heart class="h-6 w-6 sm:h-8 sm:w-8 text-green-600 animate-pulse" fill="currentColor" />
                            </div>
                        </div>

                        <h3 class="text-2xl sm:text-4xl font-bold text-green-800 mb-3 sm:mb-4">Congratulations!</h3>
                        <p class="text-lg sm:text-xl text-green-700 leading-relaxed max-w-2xl mx-auto px-4">
                            All wedding preparations are complete! You're ready for your special day,
                            <span class="font-semibold">{{ settings.couple_name }}</span>! ♡
                        </p>
                    </CardContent>
                </Card>
            </div>

            <!-- Footer -->
            <div class="mt-12 sm:mt-16 text-center">
                <p class="text-gray-500 text-sm">
                    Made with ♡ for {{ settings.couple_name }}
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.animate-heartbeat {
    animation: heartbeat 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animate-category-click {
    animation: category-click 0.3s ease-out;
}

.animate-card-click {
    animation: card-click 0.6s ease-out;
}

.animate-heart-beat {
    animation: heart-beat 0.3s ease-out;
}

.animate-ripple {
    animation: ripple 0.6s ease-out;
}

.animate-spin-once {
    animation: spin-once 0.5s ease-out;
}

.animate-float-slow {
    animation: float 6s ease-in-out infinite;
}

.animate-float-medium {
    animation: float 4s ease-in-out infinite;
}

.animate-float-fast {
    animation: float 3s ease-in-out infinite;
}

.animate-float-slow-reverse {
    animation: float-reverse 7s ease-in-out infinite;
}

.animate-float-medium-reverse {
    animation: float-reverse 5s ease-in-out infinite;
}

.animate-float-fast-reverse {
    animation: float-reverse 4s ease-in-out infinite;
}

/* Flower animations */
.flower-sakura, .flower-rose, .flower-blossom, .flower-cherry, .flower-tulip, .flower-hibiscus, .flower-peony {
    animation-delay: var(--delay, 0s);
    filter: drop-shadow(0 0 4px rgba(0, 0, 0, 0.1));
}

.flower-sakura {
    --delay: 0.5s;
    animation: float-and-rotate 8s ease-in-out infinite;
}

.flower-rose {
    --delay: 1s;
    animation: float-reverse 6s ease-in-out infinite;
}

.flower-blossom {
    --delay: 1.5s;
    animation: float-and-sway 7s ease-in-out infinite;
}

.flower-cherry {
    --delay: 2s;
    animation: float 5s ease-in-out infinite;
}

.flower-tulip {
    --delay: 0.3s;
    animation: float-and-rotate 9s ease-in-out infinite;
}

.flower-hibiscus {
    --delay: 2.5s;
    animation: float-reverse 6s ease-in-out infinite;
}

.flower-peony {
    --delay: 1.8s;
    animation: float-and-sway 8s ease-in-out infinite;
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animate-bounce {
    animation: bounce 1s infinite;
}

@keyframes heartbeat {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

@keyframes category-click {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(0.95);
        box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.3);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes card-click {
    0% {
        transform: scale(1);
    }
    25% {
        transform: scale(0.98) rotate(1deg);
    }
    50% {
        transform: scale(1.02) rotate(-0.5deg);
    }
    75% {
        transform: scale(0.99) rotate(0.5deg);
    }
    100% {
        transform: scale(1) rotate(0deg);
    }
}

@keyframes heart-beat {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.3);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes ripple {
    0% {
        opacity: 0;
        transform: scale(0);
    }
    20% {
        opacity: 1;
        transform: scale(1);
    }
    100% {
        opacity: 0;
        transform: scale(1.5);
    }
}

@keyframes spin-once {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
}

@keyframes float-reverse {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(15px) rotate(-3deg);
    }
}

@keyframes float-and-rotate {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    25% {
        transform: translateY(-15px) rotate(90deg);
    }
    50% {
        transform: translateY(-25px) rotate(180deg);
    }
    75% {
        transform: translateY(-15px) rotate(270deg);
    }
}

@keyframes float-and-sway {
    0%, 100% {
        transform: translateY(0px) translateX(0px) rotate(0deg);
    }
    25% {
        transform: translateY(-10px) translateX(5px) rotate(2deg);
    }
    50% {
        transform: translateY(-20px) translateX(0px) rotate(0deg);
    }
    75% {
        transform: translateY(-10px) translateX(-5px) rotate(-2deg);
    }
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

/* Smooth scrolling for mobile */
@media (max-width: 640px) {
    .overflow-x-auto {
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
    }

    .overflow-x-auto::-webkit-scrollbar {
        height: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: transparent;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 2px;
    }
}
</style>
