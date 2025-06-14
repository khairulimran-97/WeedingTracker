<?php

namespace App\Models;

use App\Enums\WeddingCategory;
use App\Enums\TaskPriority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeddingTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'is_completed',
        'deadline',
        'notes',
        'sort_order'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'deadline' => 'date',
        'notes' => 'array',
        'category' => WeddingCategory::class,
        'priority' => TaskPriority::class,
    ];

    protected $appends = [
        'category_display',
        'category_icon',
        'category_color',
        'priority_display',
        'priority_color'
    ];

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }

    public function scopeByCategory($query, WeddingCategory $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByPriority($query, TaskPriority $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', TaskPriority::HIGH);
    }

    public function scopeOrderByPriority($query)
    {
        return $query->orderByRaw("
            CASE priority
                WHEN 'high' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'low' THEN 3
            END
        ");
    }

    public function getCategoryDisplayAttribute(): string
    {
        return $this->category->label();
    }

    public function getCategoryIconAttribute(): string
    {
        return $this->category->icon();
    }

    public function getCategoryColorAttribute(): string
    {
        return $this->category->color();
    }

    public function getPriorityDisplayAttribute(): string
    {
        return $this->priority->label();
    }

    public function getPriorityColorAttribute(): string
    {
        return $this->priority->color();
    }

    public static function getCompletionStats(): array
    {
        $total = static::count();
        $completed = static::completed()->count();
        $remaining = $total - $completed;
        $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;

        return [
            'total' => $total,
            'completed' => $completed,
            'remaining' => $remaining,
            'percentage' => $percentage
        ];
    }

    public static function getCategoryStats(): array
    {
        return static::selectRaw('category, COUNT(*) as total, SUM(is_completed) as completed')
            ->groupBy('category')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->category->value => [
                    'total' => $item->total,
                    'completed' => $item->completed,
                    'remaining' => $item->total - $item->completed,
                    'category' => $item->category,
                ]];
            })
            ->toArray();
    }

    public static function getPriorityStats(): array
    {
        return static::selectRaw('priority, COUNT(*) as total, SUM(is_completed) as completed')
            ->groupBy('priority')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->priority->value => [
                    'total' => $item->total,
                    'completed' => $item->completed,
                    'remaining' => $item->total - $item->completed,
                    'priority' => $item->priority,
                ]];
            })
            ->toArray();
    }
}
