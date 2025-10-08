<table border="1" cellspacing="0" cellpadding="8" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>No</th>
            <th>Plat Kendaraan</th>
            <th>Tipe Kendaraan</th>
            <th>Tanggal Pencatatan Pajak</th>
            <th>Dicatat Oleh</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historiPajak as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kendaraan->plat_kendaraan ?? '-' }}</td>
                <td>{{ $item->kendaraan->tipe_kendaraan ?? '-' }}</td>
                <td>
                    {{ $item->catatan_pencatatan_pajak
                        ? \Carbon\Carbon::parse($item->catatan_pencatatan_pajak)->translatedFormat('d F Y')
                        : '-' }}
                </td>
                <td>{{ $item->user->name ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
