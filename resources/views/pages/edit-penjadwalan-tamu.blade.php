<div class="container mt-4">
    <h3>Edit Penjadwalan Tamu</h3>

    <form action="{{ route('pengunaan.update', $encryptedId) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Level Tamu</label>
            <input type="text" name="level_tamu" class="form-control"
                value="{{ old('level_tamu', $penjadwalan->level_tamu) }}" required>
        </div>

        <div class="mb-3">
            <label>Subjek Tamu</label>
            <input type="text" name="subjek_tamu" class="form-control"
                value="{{ old('subjek_tamu', $penjadwalan->subjek_tamu) }}" required>
        </div>

        <div class="mb-3">
            <label>Instansi</label>
            <input type="text" name="instansi" class="form-control"
                value="{{ old('instansi', $penjadwalan->instansi) }}" required>
        </div>

        <div class="mb-3">
            <label>Waktu Penggunaan Gedung</label>
            <input type="datetime-local" name="waktu_penggunaan_gedung" class="form-control"
                value="{{ old('waktu_penggunaan_gedung', $penjadwalan->waktu_penggunaan_gedung ? date('Y-m-d\TH:i', strtotime($penjadwalan->waktu_penggunaan_gedung)) : '') }}">
        </div>

        <div class="mb-3">
            <label>Waktu Selesai Penggunaan Gedung</label>
            <input type="datetime-local" name="waktu_selesai_penggunaan_gedung" class="form-control"
                value="{{ old('waktu_selesai_penggunaan_gedung', $penjadwalan->waktu_selesai_penggunaan_gedung ? date('Y-m-d\TH:i', strtotime($penjadwalan->waktu_selesai_penggunaan_gedung)) : '') }}">
        </div>

        <div class="mb-3">
            <label>Kode Penerbangan</label>
            <input type="text" name="kode_penerbangan" class="form-control"
                value="{{ old('kode_penerbangan', $penjadwalan->kode_penerbangan) }}">
        </div>

        <div class="mb-3">
            <label>Kode Bandara Asal</label>
            <input type="text" name="kode_bandara_asal" class="form-control"
                value="{{ old('kode_bandara_asal', $penjadwalan->kode_bandara_asal) }}">
        </div>

        <div class="mb-3">
            <label>Lembar Disposisi (PDF)</label><br>
            @if ($penjadwalan->lembar_disposisi)
                {{-- Link file lama --}}
                <a href="{{ asset('storage/' . $penjadwalan->lembar_disposisi) }}" target="_blank">
                    📄 Lihat file lama
                </a><br>
                {{-- Hidden input untuk mempertahankan file lama --}}
                <input type="hidden" name="lembar_disposisi_lama" value="{{ $penjadwalan->lembar_disposisi }}">
            @endif
            <input type="file" name="lembar_disposisi" class="form-control mt-2" accept="application/pdf">
        </div>

        {{-- ✅ Field baru --}}
        <div class="mb-3">
            <label for="narahubung_pihak_tamu">Nama Narahubung Pihak Tamu</label>
            <input type="text" name="narahubung_pihak_tamu" id="narahubung_pihak_tamu" class="form-control"
                value="{{ old('narahubung_pihak_tamu', $penjadwalan->narahubung_pihak_tamu) }}"
                placeholder="Masukkan Nama Narahubung Pihak Tamu">
        </div>

        <div class="mb-3">
            <label for="no_handphone_narahubung">No. Handphone Narahubung</label>
            <input type="text" name="no_handphone_narahubung" id="no_handphone_narahubung" class="form-control"
                value="{{ old('no_handphone_narahubung', $penjadwalan->no_handphone_narahubung) }}"
                placeholder="Masukkan No. Handphone Narahubung 08xxxxxxxxxx">
        </div>

        <div class="mb-3">
            <label for="email_narahubung">Email Narahubung</label>
            <input type="email" name="email_narahubung" id="email_narahubung" class="form-control"
                value="{{ old('email_narahubung', $penjadwalan->email_narahubung) }}"
                placeholder="Masukkan Email Narahubung">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
