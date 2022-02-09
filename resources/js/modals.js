
let modalsElement = document.getElementById('laravel-livewire-modals');


modalsElement.addEventListener('hidden.bs.modal', () => {
    Livewire.emit('resetModal');
});


Livewire.on('showBootstrapModal', () => {
    let modal = bootstrap.Modal.getInstance(modalsElement);

    if (!modal) {
        modal = new bootstrap.Modal(modalsElement);
    }

    if ($('.select2').length) {
        $('.select2').select2({
            language: "es",
            dropdownParent: $(modalsElement),
            width: '100%'
        });
        $('.select2').on('change', function (e) {
            var data = $(this).select2("val");
            Livewire.emit('updateSelect',$(this).attr('name'), data);
        });
    }

    modal.show();
});

Livewire.on('hideModal', () => {
    let modal = bootstrap.Modal.getInstance(modalsElement);

    modal.hide();
});
