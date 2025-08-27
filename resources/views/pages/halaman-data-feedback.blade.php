@if ($errorMessage)
    <div class="alert alert-danger">
        {{ $errorMessage }}
    </div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tamu</th>
            <th>Catatan Feedback</th>
            <th>Indeks Rating</th>
            <th>Mutu Rating</th>
            <th>Predikat Rating</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($feedback as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->penjadwalanTamu->subjek_tamu ?? '-' }}</td>
                <td>{{ $item->catatan_feedback ?? '-' }}</td>
                <td>{{ $item->indeks_rating_pelayanan }}</td>
                <td>{{ $item->mutu_rating_pelayanan }}</td>
                <td>{{ $item->predikat_rating_pelayanan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data feedback</td>
            </tr>
        @endforelse
    </tbody>
</table>
