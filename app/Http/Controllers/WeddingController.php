<?php

namespace App\Http\Controllers;

use App\Models\WeddingTask;
use App\Models\WeddingSettings;
use App\Enums\WeddingCategory;
use App\Enums\TaskPriority;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

class WeddingController extends Controller
{
    public function dashboard()
    {
        $settings = WeddingSettings::current();
        $tasks = WeddingTask::orderBy('sort_order')
            ->orderByPriority()
            ->orderBy('deadline')
            ->orderBy('created_at')
            ->get();

        $stats = WeddingTask::getCompletionStats();
        $categoryStats = WeddingTask::getCategoryStats();
        $priorityStats = WeddingTask::getPriorityStats();

        return Inertia::render('Wedding/Dashboard', [
            'settings' => $settings,
            'tasks' => $tasks,
            'stats' => $stats,
            'categoryStats' => $categoryStats,
            'priorityStats' => $priorityStats,
            'timeUntilWedding' => $settings->time_until_wedding,
            'categories' => WeddingCategory::options(),
            'priorities' => TaskPriority::options()
        ]);
    }

    public function progress()
    {
        $settings = WeddingSettings::current();
        $tasks = WeddingTask::orderBy('sort_order')
            ->orderByPriority()
            ->orderBy('deadline')
            ->orderBy('created_at')
            ->get();

        $stats = WeddingTask::getCompletionStats();
        $categoryStats = WeddingTask::getCategoryStats();
        $priorityStats = WeddingTask::getPriorityStats();

        return Inertia::render('Wedding/Progress', [
            'settings' => $settings,
            'tasks' => $tasks,
            'stats' => $stats,
            'categoryStats' => $categoryStats,
            'priorityStats' => $priorityStats,
            'timeUntilWedding' => $settings->time_until_wedding,
            'categories' => WeddingCategory::options(),
            'priorities' => TaskPriority::options()
        ]);
    }

    public function toggleTask(WeddingTask $task)
    {
        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return back()->with('message', 'Task updated successfully!');
    }

    public function updateTask(Request $request, WeddingTask $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => ['required', new Enum(WeddingCategory::class)],
            'priority' => ['required', new Enum(TaskPriority::class)],
            'deadline' => 'nullable|date',
            'notes' => 'nullable|array'
        ]);

        $task->update($validated);

        return back()->with('message', 'Task updated successfully!');
    }

    public function createTask(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => ['required', new Enum(WeddingCategory::class)],
            'priority' => ['required', new Enum(TaskPriority::class)],
            'deadline' => 'nullable|date',
            'notes' => 'nullable|array'
        ]);

        WeddingTask::create($validated);

        return back()->with('message', 'Task created successfully!');
    }

    public function deleteTask(WeddingTask $task)
    {
        $task->delete();

        return back()->with('message', 'Task deleted successfully!');
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'hashtag' => 'required|string|max:255',
            'wedding_date' => 'required|date',
            'theme_color' => 'required|string|max:7'
        ]);

        $settings = WeddingSettings::current();
        $settings->update($validated);

        return back()->with('message', 'Settings updated successfully!');
    }

    public function getCategories()
    {
        return response()->json(WeddingCategory::options());
    }

    public function getPriorities()
    {
        return response()->json(TaskPriority::options());
    }
}
