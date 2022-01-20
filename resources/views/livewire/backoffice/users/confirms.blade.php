@section('title', __('users.welcome'))
<div>
    <x-page-title-container>

    </x-page-title-container>

    <x-scroll-section>
        <x-form action="store">
            <p class="text-alternate mb-4">Para poder continuar debe crear una nueva contraseña.</p>
            <div class="col-md-6">
                <x-input label="{{ __('users.password') }}" type="password" name="password" />
            </div>
            <div class="col-md-6">
                <x-input label="{{ __('users.password_confirm') }}" type="password" name="passwordConfirm" />
            </div>
            <div class="col-12">
                <x-buttons.confirm />
            </div>
        </x-form>
    </x-scroll-section>
</div>
