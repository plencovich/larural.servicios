<div>
    <x-page-title-container>
        <div class="col-12 text-end">
            <x-buttons.edit form="budget-update" />
        </div>
    </x-page-title-container>
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-5">
                <h2 class="small-title">{{ __('budgets.edit') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <x-form action="store" id="budget-update">
                            <div class="col-md-12">
                                <x-select name="budget.customer_id" label="{{ __('budgets.customer') }}">
                                    @foreach ($customers as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-md-5">
                                <x-input label="{{ __('budgets.event-name') }}" type="text" name="budget.event_name" />
                            </div>
                            <div class="col-md-4">
                                <x-input label="{{ __('budgets.date') }}" type="text" name="budget.event_at" />
                            </div>
                            <div class="col-md-3">
                                <x-input label="{{ __('budgets.discount') }}" type="text" name="budget.disccount" />
                            </div>
                            <div class="col-md-12">
                                <x-input label="{{ __('budgets.observations') }}" type="text"
                                    name="budget.observations" />
                            </div>
                            <div class="col-12">
                                <x-buttons.button type="button"
                                    wire:click="$emit('showModal', 'backoffice.budgets.modal', {{ $budget }})">
                                    {{ __('button.add-sub-zone') }}
                                </x-buttons.button>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-5">
                <h2 class="small-title">{{ __('zones.sub-zones.list') }}</h2>
                <div class="card">
                    <div class="card-body">
                        @livewire('backoffice.budgets.list-items', ['budget' => $budget])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
