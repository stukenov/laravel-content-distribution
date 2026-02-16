<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;

class PostsList extends Component
{

    public function render()
    {
        return view('livewire.admin.posts.posts-list')->layout('components.layouts.admin');
    }
}
