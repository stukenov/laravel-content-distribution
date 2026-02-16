<?php

namespace App\Livewire;

use App\Models\Projects;
use Livewire\Component;

class Slider extends Component
{

    public $backgroundImages = [
        'http://distribution.kaztrk.kz/en/uploads/posts/2025-02/1740121852_the-girl-next-door-whats-new.jpg',
        'http://distribution.kaztrk.kz/en/uploads/posts/2025-02/1740144299_tbndeg-shyndyk-whats-new.jpg',
        'http://distribution.kaztrk.kz/en/uploads/posts/2025-02/1740121960_children-of-destiny-whats-new.jpg',
        'http://distribution.kaztrk.kz/en/uploads/posts/2024-11/1732796856_stay-with-me-whats-new.png',
        'http://distribution.kaztrk.kz/en/uploads/posts/2023-10/1697630523_klt.jpeg',
    ];


    public function render()
    {
        return view('livewire.slider', ['images' =>Projects::where('slider', 1)->get()]);

    }
}
