<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Projects;

class AdminContent extends Component
{
    public $sorts = [
        1 => 'title',
        2 => 'author',
        3 => 'updated_at',
        4 => 'id',
        5 => 'category',
        6 => 'year',
    ];
    public $orders = [
        1 => 'asc',
        2 => 'desc',
    ];
    public $selected_sort = 'title' ;
    public $selected_order='asc';
    public $show_sort_modal = false;
    public $show_order_modal = false;
    public function edit()
    {
        return redirect()->route('admin.post'); // Перенаправление на страницу редактирования
    }
    public function showSortModal()
    {
        $this->show_sort_modal = !$this->show_sort_modal;
    }
    public function sortby($key)
    {
        $this->selected_sort = $this->sorts[$key];
        $this->show_sort_modal = !$this->show_sort_modal;
    }
    public function showOrderModal()
    {
        $this->show_order_modal = !$this->show_order_modal;

    }
    public function orderby($key)
    {
        $this->selected_order = $this->orders[$key];
        $this->show_order_modal = !$this->show_order_modal;
    }

    public function delete($id)
    {
        $project = Projects::find($id);
        if ($project) {
            $project->delete(); // Удаление проекта
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-content', [
            'projects' => Projects::query()
                ->orderBy($this->selected_sort,  $this->selected_order)
                ->paginate(7)
        ])->layout('components.layouts.admin');
    }
}
