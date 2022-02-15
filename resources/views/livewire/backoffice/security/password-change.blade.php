@section('title', __('view.security'))
<div>
    <section class="scroll-section" id="filled">
        <h2 class="small-title">{{ __('view.password_change') }}</h2>
        <div class="card mb-5">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form wire:submit.prevent="change" method="POST">
                    <div class="mb-3">
                        <label class="form-label">{{ __('view.password_current') }}</label>
                        <input class="form-control @error('passwordCurrent') is-invalid @enderror" type="password"
                            wire:model.defer="passwordCurrent" />
                        @error('passwordCurrent')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('view.password_new') }}</label>
                        <input class="form-control @error('passwordNew') is-invalid @enderror" type="password"
                            wire:model.defer="passwordNew" />
                        @error('passwordNew')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('view.password_confirm') }}</label>
                        <input class="form-control @error('passwordConfirm') is-invalid @enderror" type="password"
                            wire:model.defer="passwordConfirm" />
                        <div id="passwordHelpBlock" class="form-text">
                            {{ __('passwords.password_requirements') }}
                        </div>
                        @error('passwordConfirm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">{{ __('button.change') }}</button>
                </form>
            </div>
        </div>
    </section>
</div>
