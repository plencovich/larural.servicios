<?php

namespace App\Http\Livewire\Backoffice\Products;

use App\Models\Category;
use Livewire\Component;

class CategoryCreate extends Component
{

    public $name;

    public function rules()
    {
        return [
            'name' => ['required', 'unique:categories,name'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        Category::create([
            'name' => $this->name,
        ]);
        $this->emit('success', __('products.categories.alert.create.success'), sprintf(__('products.categories.alert.create.message'), $this->name));
        $this->reset();
        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.backoffice.products.category-create');
    }
}
