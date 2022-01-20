<div>
    <x-page-title-container>
        <div class="col-12 text-end">
            <x-buttons.create form="budget-update" />
        </div>
    </x-page-title-container>
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-5">
                <h2 class="small-title">{{ __('zones.sub-zones.add') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <x-form action="store" id="budget-update">
                            <div class="col-md-12">
                                <x-select name="budget.customer_id" label="{{ __('budgets.customersId') }}">
                                    @foreach ($customers as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-md-5">
                                <x-input label="{{ __('budgets.eventName') }}" type="text" name="budget.event_name" />
                            </div>
                            <div class="col-md-4">
                                <x-input label="{{ __('budgets.eventAt') }}" type="text" name="budget.event_at" />
                            </div>
                            <div class="col-md-3">
                                <x-input label="{{ __('budgets.disccount') }}" type="text" name="budget.disccount" />
                            </div>
                            <div class="col-md-12">
                                <x-input label="{{ __('budgets.observations') }}" type="text"
                                    name="budget.observations" />
                            </div>
                            <div class="col-12">
                                <x-buttons.create type="button"
                                    wire:click="$emit('showModal', 'backoffice.budgets.modal', {{ $budget }})" />
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
                <h2 class="small-title">{{ __('zones.sub-zones.add') }}</h2>
                <div class="card">
                    <div class="card-body">
                        @livewire('backoffice.budgets.list-items')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
