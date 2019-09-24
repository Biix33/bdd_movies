$(() => {
    const $formUpdate = $('#form-update');
    const $btnUpdate = $('#btn-update');

    $formUpdate.css('display', 'none');

    $btnUpdate.on('click', function() {
        $formUpdate.fadeIn('slow');
        $(this).fadeOut('slow');
    });
});

