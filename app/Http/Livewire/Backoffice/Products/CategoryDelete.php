<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use Livewire\Component;

class CategoryDelete extends Component
{

    public $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function delete()
    {
        $this->category->delete();
        $this->emit('success', __('products.categories.alert.delete.success'), sprintf(__('products.categories.alert.delete.message'), $this->category->name));
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.products.category-delete');
    }
}
