<?php

namespace App\Http\Livewire\Backoffice\Events;

use App\Models\Item;
use App\Models\Event;
use Livewire\Component;

class PrintInventory extends Component
{
    public $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.backoffice.events.print-inventory', [
            'items' => Item::with(['product'])
                ->whereIn('budget_id', $this->event->budgets->pluck('id')->all())
                ->groupBy('product_id')
                ->selectRaw('*, sum(product_qty) as total_products')
                ->get()
        ])->layout('layout_blank');
    }
}
