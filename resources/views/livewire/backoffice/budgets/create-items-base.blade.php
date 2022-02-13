<div>
    <x-page-title-container>
        <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
            <x-button wire:click="$emit('customerShow', false)"
                class="btn-outline-secondary btn-icon btn-icon-start w-100 w-md-auto">
                <i class="bi bi-chevron-left"></i>
                {{ __('button.back') }}
            </x-button>

            <x-button form="budget-update" type="submit"
                class="btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto ms-2">
                <i class="bi bi-file-plus"></i>
                {{ __('button.confirms') }}
            </x-button>
        </div>
    </x-page-title-container>
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-5">
                <h2 class="small-title">{{ __('budgets.details') }}</h2>
                <div class="card">
                    <div class="card-body">
                        <x-form action="store" id="budget-update">
                            <div class="col-md-12" wire:ignore>
                                <x-select name="budget.customer_id" label="{{ __('budgets.customer') }}" class="form-control select2">
                                    @foreach ($customers as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->full_name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-md-5">
                                <div class="col-md-12" wire:ignore>
                                    <x-select name="budget.event_id" label="{{ __('budgets.event') }}" class="form-control select2">
                                        @foreach ($events as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <x-input label="{{ __('globals.date_range') }}" type="text" class="datepicker" name="date_range" timezone="{{ config('app.timezone') }}" />
                            </div>
                            <div class="col-md-2">
                                <x-input label="{{ __('budgets.discount') }}" type="number"
                                    name="budget.discount" />
                            </div>
                            <div class="col-md-12">
                                <x-input label="{{ __('budgets.observations') }}" type="text"
                                    name="budget.observations" />
                            </div>
                        </x-form>

                        <x-button type="button" wire:click="update"
                            class="btn-primary mt-4">
                            {{ __('button.save') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="mb-5">
                <h2 class="small-title">{{ __('budgets.inventory') }}</h2>
                <div class="card">
                    <div class="card-header">

                        <x-button wire:click="$emit('{{ $title }}','{{ $show }}')" type="button"
                            class="btn-primary"
                            wire:click="$emit('showModal', 'backoffice.budgets.modal', {{ $budget }})">
                            {{ __('button.add') }}
                        </x-button>

                    </div>
                    <div class="card-body">
                        @livewire('backoffice.budgets.list-items', ['budget' => $budget])
                    </div>
                    <div class="class card-footer">
                        <h3><strong>{{ __('view.budget.total') }}: ${{ $budget->total }}</strong></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        globals.initSelect2();

        // Initialize picker
        globals.initDatePicker();
    </script>
</div>
