<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Inspeksi Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361EE;
            --primary-dark: #3A56D4;
            --secondary: #6C63FF;
            --accent: #FF6B6B;
            --light: #F8FAFF;
            --dark: #1E293B;
            --gray: #64748B;
            --gray-light: #E2E8F0;
            --success: #10B981;
            --border-radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F1F5F9;
            margin: 0;
            padding: 40px 20px;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 640px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .email-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 40px 30px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .email-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .email-header::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .logo-container {
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .logo i {
            font-size: 36px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .email-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
            position: relative;
            z-index: 2;
        }
        
        .email-subtitle {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
            max-width: 80%;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .email-body {
            padding: 40px;
        }
        
        .notification-card {
            background: var(--light);
            border-radius: var(--border-radius);
            padding: 24px;
            margin-bottom: 30px;
            border-left: 4px solid var(--primary);
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        
        .notification-icon {
            font-size: 24px;
            color: var(--primary);
            background: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.15);
        }
        
        .notification-content {
            flex: 1;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 30px;
        }
        
        .info-item {
            background: var(--light);
            padding: 20px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            border: 1px solid var(--gray-light);
        }
        
        .info-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .info-label {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 8px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .highlight {
            color: var(--primary);
            font-weight: 700;
        }
        
        .action-button {
            display: block;
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            text-align: center;
            font-weight: 600;
            margin: 30px 0;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .action-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition);
        }
        
        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
        }
        
        .action-button:hover::before {
            left: 100%;
        }
        
        .action-button i {
            margin-right: 8px;
        }
        
        .url-alternative {
            text-align: center;
            color: var(--gray);
            font-size: 14px;
            padding: 20px;
            background: var(--light);
            border-radius: var(--border-radius);
            margin-bottom: 20px;
        }
        
        .url-alternative a {
            color: var(--primary);
            word-break: break-all;
            text-decoration: none;
            font-weight: 500;
        }
        
        .email-footer {
            background: var(--light);
            padding: 30px;
            text-align: center;
            font-size: 13px;
            color: var(--gray);
            border-top: 1px solid var(--gray-light);
        }
        
        .social-links {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 16px;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        
        .social-links a:hover {
            transform: translateY(-3px);
            color: white;
            background: var(--primary);
        }
        
        .footer-links {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .footer-links a {
            color: var(--gray);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer-links a:hover {
            color: var(--primary);
        }
        
        .warning-note {
            background: #FFF9ED;
            border-left: 4px solid #FFB020;
            padding: 16px;
            margin-top: 25px;
            border-radius: 4px;
            font-size: 13px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        
        .warning-note i {
            color: #FFB020;
            font-size: 18px;
        }
        
        @media (max-width: 640px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .email-header, .email-body {
                padding: 25px 20px;
            }
            
            .email-title {
                font-size: 24px;
            }
            
            .notification-card {
                flex-direction: column;
                text-align: center;
            }
            
            .social-links {
                gap: 12px;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <h1 class="email-title">Jadwal Inspeksi Baru</h1>
            <p class="email-subtitle">Anda memiliki jadwal inspeksi baru yang perlu ditinjau</p>
        </div>
        
        <div class="email-body">
            <div class="notification-card">
                <div class="notification-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="notification-content">
                    <p>Untuk Semua Petugas Inspeksi, Sebuah jadwal inspeksi baru telah dibuat oleh Kepala Seksi dan memerlukan perhatian Anda. Silakan login ke sistem untuk melihat detail lengkap dan mengambil tindakan yang diperlukan.</p>
                </div>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">ID INSPEKSI</div>
                    <div class="info-value highlight"><strong>INS-{{ $inspeksi->id }}</strong></div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">NAMA GEDUNG</div>
                    <div class="info-value">{{ $inspeksi->gedung->nama_gedung }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">PENJADWAL</div>
                    <div class="info-value">{{ $inspeksi->user->name }}</div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">STATUS</div>
                    <div class="info-value highlight">Menunggu Tindakan</div>
                </div>
            </div>
            
            <a href="{{ url('/login') }}" class="action-button">
                <i class="fas fa-sign-in-alt"></i> Login ke Sistem
            </a>
            
            <div class="url-alternative">
                <p>Jika tombol di atas tidak bekerja, salin dan tempel URL berikut di browser Anda:</p>
                <a href="{{ url('/login') }}">{{ url('/login') }}</a>
            </div>
            
            <div class="warning-note">
                <i class="fas fa-exclamation-circle"></i>
                <div>Email ini dikirim secara otomatis. Mohon tidak membalas email ini. Jika Anda merasa tidak seharusnya menerima email ini, silakan abaikan.</div>
            </div>
        </div>
        
        <div class="email-footer">
            <p>© {{ date('Y') }} BP Company. All rights reserved.</p>
            
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
            
            <div class="footer-links">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Bantuan</a>
                <a href="#">Kontak Kami</a>
            </div>
        </div>
    </div>
</body>
</html>