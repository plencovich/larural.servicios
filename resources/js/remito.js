Livewire.on('newRemito', (path) => {
    window.open(path, '_blank').focus();
});

$(() => {
    $(document).on('click', '.print-remito', function() {
        let printWindow = window.open('', 'PRINT', 'height=400,width=600');

        printWindow.document.write('<html><head><title>' + $(this).data('print-title') + '</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write('<h1>' + $(this).data('print-title') + '</h1>');
        printWindow.document.write(document.getElementById('qr-code').innerHTML);
        printWindow.document.write('</body></html>');

        printWindow.document.close(); // necessary for IE >= 10
        printWindow.focus(); // necessary for IE >= 10*/

        printWindow.print();
        printWindow.close();

        return true;
    });
})