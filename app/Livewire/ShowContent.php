<?php

namespace App\Livewire;

use AllowDynamicProperties;
use Livewire\Component;
use App\Models\Projects;
use App\Models\Category;

#[AllowDynamicProperties] class ShowContent extends Component
{
    public $category;
    public $category_name;
    public $category_id;
    public $categories_with_projects = [];

    public function mount($category = null)
    {
        $this->category = $category;
    }

    public function render()
    {
        // Если категория не выбрана, загружаем все категории с их проектами
        if ($this->category === null) {
            $categories = Category::all();
            foreach ($categories as $category) {
                $this->categories_with_projects[] = [
                    'name' => $category->name,
                    'projects' => Projects::where('category_id', $category->id)->get()
                ];
            }
            return view('livewire.show-content')->layout('components.layouts.guest');
        } else {
            // Если категория выбрана, находим её
            $category = Category::where('name', $this->category)->first();
            if ($category) {
                $this->category_name = $category->name;
                $this->category_id = $category->id;
                // Загружаем проекты для выбранной категории
                $this->projects = Projects::where('category_id', $category->id)->get();
            }
            return view('livewire.content')->layout('components.layouts.guest');
        }
    }
}

