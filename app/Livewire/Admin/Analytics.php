<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Projects;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class Analytics extends Component
{
    public $totalProjects;
    public $totalUsers;
    public $projectsByCategory;
    public $popularTags;
    public $recentProjects;
    public $projectsByYear;
    public $projectsByCountry;
    
    public function mount()
    {
        // Общая статистика
        $this->totalProjects = Projects::count();
        $this->totalUsers = User::count();
        
        // Проекты по категориям
        $this->projectsByCategory = Category::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->get();
            
        // Популярные теги
        $this->popularTags = Tag::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->limit(10)
            ->get();
            
        // Последние добавленные проекты
        $this->recentProjects = Projects::latest()
            ->limit(5)
            ->get();
            
        // Статистика по годам
        $this->projectsByYear = Projects::select('year', DB::raw('count(*) as count'))
            ->whereNotNull('year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
            
        // Статистика по странам
        $this->projectsByCountry = Projects::select('country', DB::raw('count(*) as count'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();
    }
    
    public function render()
    {
        return view('livewire.admin.analytics')->layout('components.layouts.admin');
    }
} 