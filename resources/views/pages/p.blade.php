                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <h2>Status Komponen</h2>
                    <div id="update-message" style="margin-top:10px; color:green; font-weight:bold; display:none;">
                        ✅ Data berhasil diperbarui
                    </div>
                    <div class="status-select">
                        <p><strong>Furniture:</strong></p>
                        <select name="furniture" class="status-dropdown border rounded px-2 py-1" data-field="furniture" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->furniture }}">{{ $inspeksi->furniture }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Fire System:</strong></p>
                        <select name="fire_system" class="status-dropdown border rounded px-2 py-1" data-field="fire_system" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->fire_system }}">{{ $inspeksi->fire_system }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Bangunan:</strong></p>
                        <select name="bangunan" class="status-dropdown border rounded px-2 py-1" data-field="bangunan" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->bangunan }}">{{ $inspeksi->bangunan }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Mekanikal Elektrikal:</strong></p>
                        <select name="mekanikal_elektrikal" class="status-dropdown border rounded px-2 py-1" data-field="mekanikal_elektrikal" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->mekanikal_elektrikal }}">{{ $inspeksi->mekanikal_elektrikal }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>IT:</strong></p>
                        <select name="it" class="status-dropdown border rounded px-2 py-1" data-field="it" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->it }}">{{ $inspeksi->it }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Interior:</strong></p>
                        <select name="interior" class="status-dropdown border rounded px-2 py-1" data-field="interior" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->interior }}">{{ $inspeksi->interior }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Eksterior:</strong></p>
                        <select name="eksterior" class="status-dropdown border rounded px-2 py-1" data-field="eksterior" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->eksterior }}">{{ $inspeksi->eksterior }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

                    <div class="status-select">
                        <p><strong>Sanitasi:</strong></p>
                        <select name="sanitasi" class="status-dropdown border rounded px-2 py-1" data-field="sanitasi" data-id="{{ $inspeksi->id }}">
                            <option value="{{ $inspeksi->sanitasi }}">{{ $inspeksi->sanitasi }}</option>
                            <option value="Baik">Baik</option>
                            <option value="Sedang Diperbaiki">Sedang Diperbaiki</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Sudah Diperbaiki">Sudah Diperbaiki</option>
                        </select>
                    </div>

        <script>
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
        </script>
