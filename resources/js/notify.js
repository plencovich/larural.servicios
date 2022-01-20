Livewire.on('success', (title, message) => {
    jQuery.notify(
        { title: title, message: message },
        {
            type: 'success',
            delay: 5000,
        },
    );
});