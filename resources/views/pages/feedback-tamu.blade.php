    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_penjadwalan_tamu" value="{{ $tamu->id }}">

        <div>
            <label for="catatan_feedback">Catatan Feedback:</label><br>
            <textarea name="catatan_feedback" id="catatan_feedback" rows="3" 
                @if($feedbackExists) disabled @endif
            >{{ old('catatan_feedback', $feedback->catatan_feedback ?? '') }}</textarea>
        </div>

        <div>
            <label for="indeks_rating_pelayanan">Indeks Rating Pelayanan (0-100):</label><br>
            <input type="number" step="0.01" name="indeks_rating_pelayanan" id="indeks_rating_pelayanan"
                value="{{ old('indeks_rating_pelayanan', $feedback->indeks_rating_pelayanan ?? '') }}"
                @if($feedbackExists) readonly @endif
                required
            >
        </div>

        <button type="submit" @if($feedbackExists) disabled @endif>Kirim Feedback</button>

        @if($feedbackExists)
            <p style="color: red; margin-top: 10px;">
                Feedback sudah dikirim dan tidak bisa diubah lagi.
            </p>
        @endif
    </form>
