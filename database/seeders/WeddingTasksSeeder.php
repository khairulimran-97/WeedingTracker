<?php

namespace Database\Seeders;

use App\Models\WeddingTask;
use App\Models\WeddingSettings;
use App\Enums\WeddingCategory;
use App\Enums\TaskPriority;
use Illuminate\Database\Seeder;

class WeddingTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create wedding settings
        WeddingSettings::create([
            'bride_name' => 'Madihah',
            'groom_name' => 'Khairul',
            'hashtag' => '#KhairulMadihah',
            'wedding_date' => '2024-12-25',
            'theme_color' => '#E8B4B8'
        ]);

        // Wedding tasks based on the image provided
        $tasks = [
            // Legal tasks
            [
                'title' => 'Nikah (Solemnization)',
                'description' => 'Complete the Islamic marriage ceremony',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-20',
                'sort_order' => 1
            ],
            [
                'title' => 'Daftar Kahwin',
                'description' => 'Register marriage with local authorities',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-22',
                'sort_order' => 2
            ],
            [
                'title' => 'Marriage Certificate',
                'description' => 'Obtain official marriage certificate',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::MEDIUM,
                'is_completed' => true,
                'deadline' => '2024-12-30',
                'sort_order' => 3
            ],
            [
                'title' => 'Legal Documentation',
                'description' => 'Complete all required legal paperwork',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::MEDIUM,
                'is_completed' => true,
                'deadline' => '2024-12-15',
                'sort_order' => 4
            ],

            // Attire tasks
            [
                'title' => 'Baju Pengantin (Lelaki)',
                'description' => 'Groom\'s traditional wedding attire',
                'category' => WeddingCategory::ATTIRE,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-20',
                'sort_order' => 5
            ],
            [
                'title' => 'Baju Pengantin (Perempuan)',
                'description' => 'Bride\'s traditional wedding attire',
                'category' => WeddingCategory::ATTIRE,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-20',
                'sort_order' => 6
            ],

            // Jewelry tasks
            [
                'title' => 'Cincin (Perempuan)',
                'description' => 'Wedding ring for the bride',
                'category' => WeddingCategory::JEWELRY,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-15',
                'sort_order' => 7
            ],
            [
                'title' => 'Cincin (Lelaki)',
                'description' => 'Wedding ring for the groom',
                'category' => WeddingCategory::JEWELRY,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-15',
                'sort_order' => 8
            ],

            // Services tasks
            [
                'title' => 'Photographer',
                'description' => 'Professional wedding photography services',
                'category' => WeddingCategory::SERVICES,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-10',
                'sort_order' => 9
            ],
            [
                'title' => 'Makeup Pengantin',
                'description' => 'Bridal makeup and styling services',
                'category' => WeddingCategory::SERVICES,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-24',
                'sort_order' => 10
            ],

            // Food task
            [
                'title' => 'Catering',
                'description' => 'Wedding reception catering services',
                'category' => WeddingCategory::FOOD,
                'priority' => TaskPriority::HIGH,
                'is_completed' => true,
                'deadline' => '2024-12-20',
                'sort_order' => 11
            ],

            // Decoration tasks
            [
                'title' => 'Pelamin (Perempuan)',
                'description' => 'Bridal dais decoration',
                'category' => WeddingCategory::DECORATION,
                'priority' => TaskPriority::MEDIUM,
                'is_completed' => true,
                'deadline' => '2024-12-24',
                'sort_order' => 12
            ],
            [
                'title' => 'Pelamin (Lelaki)',
                'description' => 'Groom\'s dais decoration',
                'category' => WeddingCategory::DECORATION,
                'priority' => TaskPriority::MEDIUM,
                'is_completed' => true,
                'deadline' => '2024-12-24',
                'sort_order' => 13
            ],
            [
                'title' => 'Welcome Board',
                'description' => 'Wedding welcome signage',
                'category' => WeddingCategory::DECORATION,
                'priority' => TaskPriority::LOW,
                'is_completed' => true,
                'deadline' => '2024-12-24',
                'sort_order' => 14
            ],

            // Stationery task
            [
                'title' => 'Kad Kahwin',
                'description' => 'Wedding invitation cards',
                'category' => WeddingCategory::STATIONERY,
                'priority' => TaskPriority::MEDIUM,
                'is_completed' => true,
                'deadline' => '2024-11-30',
                'sort_order' => 15
            ],

            // Gifts tasks
            [
                'title' => 'Doorprit (Lelaki)',
                'description' => 'Gifts for groom\'s family and guests',
                'category' => WeddingCategory::GIFTS,
                'priority' => TaskPriority::MEDIUM,
                'is_completed' => true,
                'deadline' => '2024-12-20',
                'sort_order' => 16
            ],
            [
                'title' => 'Ahwa Hituah - Bunga Toh Imam',
                'description' => 'Traditional ceremonial flowers and gifts',
                'category' => WeddingCategory::GIFTS,
                'priority' => TaskPriority::MEDIUM,
                'is_completed' => true,
                'deadline' => '2024-12-24',
                'sort_order' => 17
            ]
        ];

        foreach ($tasks as $task) {
            WeddingTask::create($task);
        }
    }
}
