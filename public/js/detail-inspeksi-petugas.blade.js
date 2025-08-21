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
