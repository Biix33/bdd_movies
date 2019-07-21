document.addEventListener('DOMContentLoaded', () => {
    const $formUpdate = document.querySelector('#form-update');
    const $btnUpdate = document.querySelector('#btn-update');

    $formUpdate.style.display = "none";

    $btnUpdate.addEventListener('click', function() {
        $formUpdate.style.display = "block";
        this.style.display = 'none';
    });
});

