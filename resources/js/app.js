import './bootstrap';

function bindDeleteConfirmation() {
    document.querySelectorAll('.delete-confirm').forEach(button => {
        button.removeEventListener('click', handleDelete); // prevent duplicate binding
        button.addEventListener('click', handleDelete);
    });
}

function handleDelete(e) {
    e.preventDefault();
    const form = this.closest('form');

    Swal.fire({
        title: 'Hapus Data Pegawai?',
        text: 'Semua data pegawai ini akan terhapus.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    bindDeleteConfirmation();

    // Re-bind after DataTables redraws
    $('#pegawai-table').on('draw.dt', function () {
        bindDeleteConfirmation();
    });
});
