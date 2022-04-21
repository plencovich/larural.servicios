<?php

namespace App\Http\Livewire\Backoffice\Budgets;

use App\Models\Budget;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\SubZone;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Modal extends Component
{
    use AuthorizesRequests;

    public $budget;
    public $zone = '';
    public $subZone = '';
    public $product_id = '';
    public $productQty;
    public $productPrice = '';
    public $discount = 0;

    protected $listeners = ['updateSelect' => 'updateSelect'];

    public function mount(Budget $budget)
    {
        $this->budget = $budget;
    }

    public function rules()
    {
        // $product = Product::find($this->product_id);
        // $max = '0';
        // if ($product) {
        //     $max = $product->quantity;
        // $max = $product->availableStockForDateRange($this->budget->event_from, $this->budget->event_to);
        // }

        $this->emit('resetSelect2');

        return [
            'zone' => ['required'],
            'subZone' => ['required'],
            'product_id' => ['required', Rule::unique('items')->where(fn ($query) => $query->where('budget_id', $this->budget->id))],
            'productQty' => ['required', 'numeric', 'min:0'],
            'productPrice' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public function updated($propertyName)
    {
        // Validate stock on quantity update
        $this->notEnoughStockWarning($propertyName);

        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->authorize('view', $this->budget);
        $this->validate();

        $this->budget->items()->create([
            'zone_name' => $this->zone,
            'sub_zone_name' => $this->subZone,
            'product_id' => $this->product_id,
            'product_qty' => $this->productQty,
            'product_price' => $this->productPrice,
            'discount' => $this->discount,
        ]);
        $this->reset(
            'zone',
            'subZone',
            'product_id',
            'productQty',
            'productPrice',
            'discount',
        );
        $this->emit('refresh');
        $this->emit('refreshBudgetTotal');
        $this->emit('resetSelect2');
    }

    public function render()
    {
        $this->authorize('view', $this->budget);
        $zones = Zone::all();
        $subZones = SubZone::where('zone_id', $this->zone)->get();
        $prices = ProductPrice::where('product_id', $this->product_id)->get();

        // Only products for rent
        $products = Product::forRent()
            ->whereDoesntHave('productReservations', fn ($q) => $q->where('budget_id', $this->budget->id))
            ->get();
        return view('livewire.backoffice.budgets.modal', compact('zones', 'products', 'subZones', 'prices'));
    }

    /**
     * Update select 2 model
     *
     * @return mixed
     */
    public function updateSelect($property, $value)
    {
        $this->$property = $value;

        // Validate stock on quantity update
        $this->notEnoughStockWarning($property);

        $this->emit('resetSelect2');
    }

    /*
    |--------------------------------------------------------------------------
    | Private method
    |--------------------------------------------------------------------------
    */
    /**
     * Get warning if product doesn't have enough stock
     *
     * @return mixed
     */
    private function notEnoughStockWarning($propertyName)
    {
        if ($propertyName == 'productQty') {
            // Find product
            $product = Product::find($this->product_id);

            if ($product) {
                // Get the available stock of the product for the budget's date range
                $missingStockPerDay = $product->availableStockForDateRange($this->budget->event_from, $this->budget->event_to)->filter(fn ($stock) => $stock < $this->$propertyName);

                // If there are missing stocks per day, proceed with warning
                if (filled($missingStockPerDay)) {
                    // Initialize waning text
                    $warning = '<p>' . __('budgets.alert.warning.not-enough-stock') . '</p>';

                    // Loop through each day
                    foreach ($missingStockPerDay as $day => $stock) {
                        // Format the day
                        $formattedDay = (new Carbon($day))->isoFormat('LL');

                        // Get the warnings
                        $warning .= '<li>' . $formattedDay  . ': ' . $stock . "\n</li>";
                    }

                    // Emit the warning
                    $this->emit('alert-message', 'warning', __('warning.warning'), $warning);
                }
            }
        }
    }
}
