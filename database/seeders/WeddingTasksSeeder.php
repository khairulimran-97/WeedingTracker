<?php

namespace Database\Seeders;

use App\Models\WeddingTask;
use App\Models\WeddingSettings;
use App\Enums\WeddingCategory;
use App\Enums\TaskPriority;
use Illuminate\Database\Seeder;

class WeddingTasksSeeder extends Seeder
{
    public function run(): void
    {
        WeddingSettings::create([
            'bride_name' => 'Madihah',
            'groom_name' => 'Khairul',
            'hashtag' => '#KhairulMadihah',
            'wedding_date' => '2025-12-26',
            'theme_color' => '#E8B4B8'
        ]);

        $tasks = [
            // Kursus Kahwin
            [
                'title' => 'Kursus Kahwin',
                'description' => 'Menghadiri kursus pra-perkahwinan',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-06-26',
                'sort_order' => 0
            ],

            // Legal
            [
                'title' => 'Daftar Kahwin',
                'description' => 'Pendaftaran perkahwinan di pejabat agama',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-09-01',
                'sort_order' => 1
            ],
            [
                'title' => 'Sijil Nikah',
                'description' => 'Dapatkan sijil perkahwinan rasmi',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-10-01',
                'sort_order' => 2
            ],
            [
                'title' => 'Dokumen Sokongan',
                'description' => 'Lengkapkan semua borang dan surat sokongan',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-08-15',
                'sort_order' => 3
            ],
            [
                'title' => 'Pemeriksaan Kesihatan',
                'description' => 'Jalani pemeriksaan kesihatan pra-nikah',
                'category' => WeddingCategory::LEGAL,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-08-01',
                'sort_order' => 4
            ],

            // Attire
            [
                'title' => 'Baju Pengantin (Lelaki)',
                'description' => 'Tempah pakaian pengantin lelaki',
                'category' => WeddingCategory::ATTIRE,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-12-10',
                'sort_order' => 5
            ],
            [
                'title' => 'Baju Pengantin (Perempuan)',
                'description' => 'Tempah pakaian pengantin perempuan',
                'category' => WeddingCategory::ATTIRE,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-12-10',
                'sort_order' => 6
            ],

            // Jewelry
            [
                'title' => 'Cincin Kahwin (Perempuan)',
                'description' => 'Beli cincin untuk pengantin perempuan',
                'category' => WeddingCategory::JEWELRY,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-10-15',
                'sort_order' => 7
            ],
            [
                'title' => 'Cincin Kahwin (Lelaki)',
                'description' => 'Beli cincin untuk pengantin lelaki',
                'category' => WeddingCategory::JEWELRY,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-10-15',
                'sort_order' => 8
            ],

            // Photography
            [
                'title' => 'Jurugambar',
                'description' => 'Tempah jurugambar profesional untuk majlis',
                'category' => WeddingCategory::PHOTOGRAPHY,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-11-15',
                'sort_order' => 9
            ],

            // Services
            [
                'title' => 'Makeup Pengantin',
                'description' => 'Solekan dan dandanan pengantin',
                'category' => WeddingCategory::SERVICES,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-12-25',
                'sort_order' => 10
            ],

            // Food
            [
                'title' => 'Katering (Pihak Perempuan)',
                'description' => 'Tempah makanan untuk majlis pihak perempuan',
                'category' => WeddingCategory::FOOD,
                'priority' => TaskPriority::HIGH,
                'deadline' => '2025-12-15',
                'sort_order' => 11
            ],

            // Decoration
            [
                'title' => 'Pelamin (Perempuan)',
                'description' => 'Dekorasi pelamin untuk pihak perempuan',
                'category' => WeddingCategory::DECORATION,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-12-20',
                'sort_order' => 12
            ],
            [
                'title' => 'Pelamin (Lelaki)',
                'description' => 'Dekorasi pelamin untuk pihak lelaki',
                'category' => WeddingCategory::DECORATION,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-12-20',
                'sort_order' => 13
            ],
            [
                'title' => 'Welcome Board',
                'description' => 'Papan sambutan tetamu di majlis',
                'category' => WeddingCategory::DECORATION,
                'priority' => TaskPriority::LOW,
                'deadline' => '2025-12-23',
                'sort_order' => 14
            ],

            // Stationery
            [
                'title' => 'Kad Kahwin',
                'description' => 'Cetak dan edarkan kad jemputan',
                'category' => WeddingCategory::STATIONERY,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-09-30',
                'sort_order' => 15
            ],

            // Gifts
            [
                'title' => 'Doorgift (Lelaki)',
                'description' => 'Hadiah untuk tetamu pihak lelaki',
                'category' => WeddingCategory::GIFTS,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-12-20',
                'sort_order' => 16
            ],
            [
                'title' => 'Doorgift (Perempuan)',
                'description' => 'Hadiah untuk tetamu pihak perempuan',
                'category' => WeddingCategory::GIFTS,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-12-20',
                'sort_order' => 17
            ],
            [
                'title' => 'Akad Nikah - Bayaran Tok Imam',
                'description' => 'Hadiah tradisional untuk tok imam dan orang penting',
                'category' => WeddingCategory::GIFTS,
                'priority' => TaskPriority::MEDIUM,
                'deadline' => '2025-12-24',
                'sort_order' => 18
            ]
        ];

        foreach ($tasks as $task) {
            WeddingTask::create(array_merge([
                'is_completed' => false
            ], $task));
        }
    }
}
