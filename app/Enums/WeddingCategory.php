<?php

namespace App\Enums;

enum WeddingCategory: string
{
    case LEGAL = 'legal';
    case ATTIRE = 'attire';
    case JEWELRY = 'jewelry';
    case SERVICES = 'services';
    case FOOD = 'food';
    case DECORATION = 'decoration';
    case STATIONERY = 'stationery';
    case GIFTS = 'gifts';
    case VENUE = 'venue';
    case PHOTOGRAPHY = 'photography';

    public function label(): string
    {
        return match ($this) {
            self::LEGAL => 'Majlis Agama',
            self::ATTIRE => 'Pakaian',
            self::JEWELRY => 'Barang Kemas',
            self::SERVICES => 'Perkhidmatan',
            self::FOOD => 'Makanan & Minuman',
            self::DECORATION => 'Dekorasi',
            self::STATIONERY => 'Percetakan & Kad',
            self::GIFTS => 'Hadiah & Cenderamata',
            self::VENUE => 'Lokasi Majlis',
            self::PHOTOGRAPHY => 'Fotografi',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::LEGAL => '📋',
            self::ATTIRE => '👗',
            self::JEWELRY => '💍',
            self::SERVICES => '🎵',
            self::FOOD => '🍽️',
            self::DECORATION => '🌸',
            self::STATIONERY => '💌',
            self::GIFTS => '🎁',
            self::VENUE => '🏛️',
            self::PHOTOGRAPHY => '📸',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::LEGAL => 'bg-blue-100 text-blue-800',
            self::ATTIRE => 'bg-pink-100 text-pink-800',
            self::JEWELRY => 'bg-yellow-100 text-yellow-800',
            self::SERVICES => 'bg-purple-100 text-purple-800',
            self::FOOD => 'bg-orange-100 text-orange-800',
            self::DECORATION => 'bg-green-100 text-green-800',
            self::STATIONERY => 'bg-indigo-100 text-indigo-800',
            self::GIFTS => 'bg-red-100 text-red-800',
            self::VENUE => 'bg-gray-100 text-gray-800',
            self::PHOTOGRAPHY => 'bg-cyan-100 text-cyan-800',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->map(fn(self $category) => [
                'value' => $category->value,
                'label' => $category->label(),
                'icon' => $category->icon(),
                'color' => $category->color(),
            ])
            ->toArray();
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
