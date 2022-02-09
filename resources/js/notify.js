Livewire.on('success', (title, message) => {
    jQuery.notify(
        { title: title, message: message },
        {
            type: 'success',
            delay: 5000,
        },
    );
});
Livewire.on('alert-message', (type, title, message) => {
    jQuery.notify(
        { title: title, message: message },
        {
            type: type,
            delay: 5000,
        },
    );
});