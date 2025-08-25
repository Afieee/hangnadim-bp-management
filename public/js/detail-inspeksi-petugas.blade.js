        $(document).on('change', '.status-dropdown', function () {
            let field = $(this).data('field');
            let value = $(this).val();
            let id = $(this).data('id');

            $.ajax({
                url: `/inspeksi/${id}/update-field`,
                type: 'PUT',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    field: field,
                    value: value
                },
                success: function (response) {
                    $('#update-message').stop(true, true).fadeIn().delay(5500).fadeOut();
                },
                error: function () {
                    alert('❌ Gagal memperbarui data.');
                }
            });
        });







    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        if(toast) {
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast when close button is clicked
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.classList.remove('show');
            });
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });