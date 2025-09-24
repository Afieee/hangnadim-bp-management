<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Feedback Form - AEROCITY BP Batam</title>
    <link rel="icon" href="{{ asset('/storage/images/logo_bp.png') }}" type="image/png">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Montserrat:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/feedback-tamu.css') }}">

</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('/storage/images/logo_bp.png') }}" alt="Logo BP Batam">
            </div>
            <h1>Formulir Umpan Balik</h1>
            <p class="subtitle">Kami menghargai masukan Anda untuk meningkatkan pelayanan kami</p>
            <div class="guest-name">Terima kasih kepada Bapak/Ibu: <strong>{{ $tamu->subjek_tamu }}<strong></div>
        </div>

        <div class="form-container">
            <!-- Overlay untuk status loading dan form disabled -->
            <div class="form-disabled-overlay" id="formOverlay"
                style="display: {{ $feedbackExists ? 'flex' : 'none' }};">
                @if ($feedbackExists)
                    <div
                        style="text-align: center; padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                            fill="none" stroke="#4caf50" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <h2 style="color: #4caf50; margin: 15px 0 10px;">Feedback Telah Dikirim</h2>
                        <p style="color: #666;">Terima kasih atas partisipasi Anda. Formulir ini sudah tidak dapat
                            diubah.</p>
                        <p style="color: #666; margin-top: 10px; font-size: 14px;">
                            <a href="{{ route('feedback.thankyou') }}" style="color: #0d47a1;">Kembali ke halaman terima
                                kasih</a>
                        </p>
                    </div>
                @else
                    <div class="loading-spinner"></div>
                    <p>Memeriksa status feedback...</p>
                @endif
            </div>

            <p>Mohon meluangkan waktu untuk mengisi formulir feedback terkait kepuasan dari fasilitas dan juga pelayanan
                kami dari tim AEROCITY-BP Batam.</p>

            <form action="{{ route('feedback.store') }}" method="POST" id="feedbackForm">
                @csrf
                <input type="hidden" name="id_penjadwalan_tamu" value="{{ $tamu->id }}">

                <div class="form-group">
                    <label for="perwakilan_atau_pengisi">Perwakilan atau Pengisi:</label>
                    <input type="text" name="perwakilan_atau_pengisi" id="perwakilan_atau_pengisi"
                        value="{{ old('perwakilan_atau_pengisi', $feedback->perwakilan_atau_pengisi ?? '') }}"
                        @if ($feedbackExists) disabled @endif placeholder="Masukkan nama perwakilan">
                </div>


                <div class="form-group">
                    <label for="catatan_feedback">Catatan Feedback:</label>
                    <textarea name="catatan_feedback" id="catatan_feedback" rows="4" @if ($feedbackExists) disabled @endif
                        placeholder="Silakan berikan masukan berharga Anda mengenai pelayanan kami">{{ old('catatan_feedback', $feedback->catatan_feedback ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="indeks_rating_pelayanan">Indeks Rating Pelayanan:</label>
                    <div class="rating-container">
                        <!-- Slider -->
                        <input type="range" min="0" max="100" step="1"
                            id="indeks_rating_pelayanan_slider" class="rating-slider"
                            value="{{ old('indeks_rating_pelayanan', $feedback->indeks_rating_pelayanan ?? 50) }}"
                            @if ($feedbackExists) disabled @endif oninput="updateRatingValue(this.value)">

                        <!-- Nilai Rating yang tampil -->
                        <div class="rating-value" id="ratingValue">
                            {{ old('indeks_rating_pelayanan', $feedback->indeks_rating_pelayanan ?? 50) }}
                        </div>

                        <div class="rating-labels">
                            <span>0 (Tidak Puas)</span>
                            <span>100 (Sangat Puas)</span>
                        </div>
                    </div>

                    <!-- Hidden input untuk memastikan nilai terkirim -->
                    <input type="hidden" name="indeks_rating_pelayanan" id="indeks_rating_pelayanan_hidden"
                        value="{{ old('indeks_rating_pelayanan', $feedback->indeks_rating_pelayanan ?? 50) }}">
                </div>


                <button type="submit" class="submit-btn" id="submitButton"
                    @if ($feedbackExists) disabled @endif>
                    @if ($feedbackExists)
                        Feedback Sudah Dikirim
                    @else
                        Kirim Feedback
                    @endif
                </button>

                @if ($feedbackExists)
                    <div class="feedback-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <p>Feedback sudah dikirim pada {{ $feedback->created_at->format('d M Y H:i') }} dan tidak bisa
                            diubah lagi. Terima kasih atas partisipasi Anda.</p>
                    </div>
                @endif
            </form>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} AEROCITY-BP Batam. All rights reserved.</p>
        </div>
    </div>

    <script>
        function updateRatingValue(value) {
            document.getElementById('ratingValue').textContent = value;
            document.getElementById('indeks_rating_pelayanan_hidden').value = value;
        }

        // Fungsi untuk memeriksa status feedback
        async function checkFeedbackStatus() {
            try {
                const response = await fetch('{{ route('feedback.check-status', $tamu->id) }}', {
                    headers: {
                        'Cache-Control': 'no-cache, no-store, must-revalidate',
                        'Pragma': 'no-cache',
                        'Expires': '0'
                    }
                });
                const data = await response.json();

                if (data.feedback_exists) {
                    disableForm();
                    // Set session storage untuk mencegah form diisi ulang
                    sessionStorage.setItem('feedbackSubmitted', 'true');
                }
            } catch (error) {
                console.error('Error checking feedback status:', error);
            }
        }

        // Fungsi untuk menonaktifkan form
        function disableForm() {
            document.getElementById('catatan_feedback').disabled = true;
            document.getElementById('indeks_rating_pelayanan_slider').disabled = true;
            document.getElementById('submitButton').disabled = true;
            document.getElementById('submitButton').textContent = 'Feedback Sudah Dikirim';

            // Tampilkan overlay
            document.getElementById('formOverlay').style.display = 'flex';

            // Hentikan polling jika ada
            if (window.feedbackPolling) {
                clearInterval(window.feedbackPolling);
            }
        }

        // Saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const ratingValue = "{{ old('indeks_rating_pelayanan', $feedback->indeks_rating_pelayanan ?? 50) }}";
            updateRatingValue(ratingValue);

            // Periksa sessionStorage untuk status feedback
            if (sessionStorage.getItem('feedbackSubmitted') === 'true') {
                disableForm();
                return;
            }

            // Periksa status feedback saat halaman dimuat
            checkFeedbackStatus();

            // Deteksi ketika pengguna kembali ke halaman ini (navigation back)
            window.addEventListener('pageshow', function(event) {
                // Jika halaman dimuat dari cache (back/forward navigation)
                if (event.persisted) {
                    checkFeedbackStatus();
                }
            });

            // Deteksi perubahan visibilitas halaman
            document.addEventListener('visibilitychange', function() {
                if (!document.hidden) {
                    // Halaman kembali terlihat, periksa status
                    checkFeedbackStatus();
                }
            });

            // Nonaktifkan form jika feedback sudah ada
            @if ($feedbackExists)
                disableForm();
                sessionStorage.setItem('feedbackSubmitted', 'true');
            @else
                // Cek status feedback setiap 3 detik (fallback)
                window.feedbackPolling = setInterval(checkFeedbackStatus, 3000);
            @endif

            // Mencegah form dikirim jika sudah ada feedback
            document.getElementById('feedbackForm').addEventListener('submit', function(e) {
                if (document.getElementById('submitButton').disabled) {
                    e.preventDefault();
                    alert('Feedback sudah dikirim dan tidak dapat diubah.');
                }
            });
        });
    </script>
</body>

</html>
