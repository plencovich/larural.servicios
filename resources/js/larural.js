Livewire.on('resetSelect2', () => {
    $('select.select2').select2('destroy');

    $('select.select2').select2(globals.select2Options());
});