<?php

namespace App\Enums;

enum TaskPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::LOW => 'bg-green-100 text-green-700 border-green-200',
            self::MEDIUM => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            self::HIGH => 'bg-red-100 text-red-700 border-red-200',
        };
    }

    public function textColor(): string
    {
        return match ($this) {
            self::LOW => 'text-green-600',
            self::MEDIUM => 'text-yellow-600',
            self::HIGH => 'text-red-600',
        };
    }

    public function sortOrder(): int
    {
        return match ($this) {
            self::HIGH => 1,
            self::MEDIUM => 2,
            self::LOW => 3,
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->map(fn(self $priority) => [
                'value' => $priority->value,
                'label' => $priority->label(),
                'color' => $priority->color(),
                'textColor' => $priority->textColor(),
                'sortOrder' => $priority->sortOrder(),
            ])
            ->toArray();
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function sorted(): array
    {
        return collect(self::cases())
            ->sortBy('sortOrder')
            ->values()
            ->toArray();
    }
}
