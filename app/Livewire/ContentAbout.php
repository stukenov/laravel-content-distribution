<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Projects;

class ContentAbout extends Component
{
    public $project;

    public function mount($name)
    {
        $this->project = Projects::where('title', $name)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.content-about')->layout('components.layouts.guest');
    }
}
