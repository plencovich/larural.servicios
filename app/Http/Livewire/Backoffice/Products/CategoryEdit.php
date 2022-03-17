<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CategoryEdit extends Component
{
    use AuthorizesRequests;

    public $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function rules()
    {
        return [
            'category.name' => ['required', 'unique:categories,name,' . $this->category->id],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->authorize('update', $this->category);
        $this->validate();
        $this->category->save();
        $this->emit('success', __('products.categories.alert.edit.success'), sprintf(__('products.categories.alert.edit.message'), $this->category->name));
        $this->reset();
        $this->emit('hideModal');
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.products.category-edit');
    }
}
