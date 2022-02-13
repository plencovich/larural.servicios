
let modalsElement = document.getElementById('laravel-livewire-modals');


if (modalsElement) {
    modalsElement.addEventListener('hidden.bs.modal', () => {
        Livewire.emit('resetModal');
    });
}


Livewire.on('showBootstrapModal', () => {
    let modal = bootstrap.Modal.getInstance(modalsElement);

    if (!modal) {
        modal = new bootstrap.Modal(modalsElement);
    }

    if (document.getElementById('laravel-livewire-modals')) {
        document.getElementById('laravel-livewire-modals').addEventListener('shown.bs.modal', function (event) {
            // Initialize picker
            globals.initDatePicker();
        })
    }

    globals.initSelect2();

    modal.show();
});

Livewire.on('hideModal', () => {
    let modal = bootstrap.Modal.getInstance(modalsElement);

    modal.hide();
});
