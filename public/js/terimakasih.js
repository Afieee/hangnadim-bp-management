        // Set flag bahwa feedback sudah dikirim
        sessionStorage.setItem('feedbackSubmitted', 'true');
        
        // Manipulasi history untuk mencegah back button
        history.pushState(null, null, location.href);
        window.onpopstate = function(event) {
            history.go(1);
            alert('Feedback sudah dikirim. Form tidak dapat diisi kembali.');
        };
        
        // Fungsi untuk menutup window (jika di mobile/dialog)
        function closeWindow() {
            // Coba tutup window (berhasil jika dibuka dengan window.open)
            if (window.opener || window.history.length > 1) {
                window.close();
            } else {
                alert('Terima kasih atas feedback Anda. Anda dapat menutup halaman ini.');
            }
        }
        
        // Mencegah pengiriman form ganda
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
