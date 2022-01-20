@section('title', __('view.setting_social_network'))
@section('breadcrumb')
    {{ Breadcrumbs::render('social-networks') }}
@endsection
<div>
    <section class="scroll-section">
        <div class="card">
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form wire:submit.prevent="store" method="POST" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_whatsapp') }}</label>
                        <input class="form-control @error('socialWhatsapp') is-invalid @enderror" type="text"
                            wire:model.defer="socialWhatsapp" />
                        @error('socialWhatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_facebook') }}</label>
                        <input class="form-control @error('socialFacebook') is-invalid @enderror" type="text"
                            wire:model.defer="socialFacebook" />
                        @error('socialFacebook')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_instagram') }}</label>
                        <input class="form-control @error('socialInstagram') is-invalid @enderror" type="text"
                            wire:model.defer="socialInstagram" />
                        @error('socialInstagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_twitter') }}</label>
                        <input class="form-control @error('socialTwitter') is-invalid @enderror" type="text"
                            wire:model.defer="socialTwitter" />
                        @error('socialTwitter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_telegram') }}</label>
                        <input class="form-control @error('socialTelegram') is-invalid @enderror" type="text"
                            wire:model.defer="socialTelegram" />
                        @error('socialTelegram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_skype') }}</label>
                        <input class="form-control @error('socialSkype') is-invalid @enderror" type="text"
                            wire:model.defer="socialSkype" />
                        @error('socialSkype')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_linkedin') }}</label>
                        <input class="form-control @error('socialLinkedin') is-invalid @enderror" type="text"
                            wire:model.defer="socialLinkedin" />
                        @error('socialLinkedin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('view.social_youtube') }}</label>
                        <input class="form-control @error('socialYoutube') is-invalid @enderror" type="text"
                            wire:model.defer="socialYoutube" />
                        @error('socialYoutube')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{ __('button.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
