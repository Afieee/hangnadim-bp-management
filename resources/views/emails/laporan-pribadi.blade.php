<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pribadi - Bukti Kerusakan</title>
    <style>
        :root {
            --primary: #2563EB;
            --primary-dark: #1D4ED8;
            --primary-light: #93C5FD;
            --secondary: #3B82F6;
            --accent: #60A5FA;
            --light: #F0F9FF;
            --dark: #1E293B;
            --gray: #64748B;
            --gray-light: #E2E8F0;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --border-radius: 12px;
            --shadow: 0 10px 30px rgba(37, 99, 235, 0.08);
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
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.15);
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
        
        .chip {
            display: inline-block;
            padding: 6px 12px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 20px;
            color: white;
        }
        
        .chip-biru {
            background-color: var(--primary);
        }
        
        .chip-kuning {
            background-color: var(--warning);
        }
        
        .chip-hijau {
            background-color: var(--success);
        }
        
        .chip-merah {
            background-color: var(--danger);
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
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
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
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
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
            border-left: 4px solid var(--warning);
            padding: 16px;
            margin-top: 25px;
            border-radius: 4px;
            font-size: 13px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        
        .warning-note i {
            color: var(--warning);
            font-size: 18px;
        }
        
        .detail-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .detail-list li {
            margin: 12px 0;
            padding: 12px 16px;
            background: var(--light);
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
        }
        
        .detail-list strong {
            min-width: 150px;
            color: var(--gray);
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
            
            .detail-list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .detail-list strong {
                min-width: unset;
            }
        }
    </style>
    
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            <h1 class="email-title">Laporan Pribadi - Bukti Kerusakan</h1>
            <p class="email-subtitle">Laporan kerusakan baru memerlukan perhatian Anda</p>
        </div>
        
        <div class="email-body">
            <div class="notification-card">
                <div class="notification-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="notification-content">
                    <p>Halo Kepada Semua Staff Pelaksana & Kepala Seksi, Mohon Untuk Segera Ditindak. Berikut detail laporan pribadi yang baru saja diunggah.</p>
                </div>
            </div>
            
            <ul class="detail-list">
                <li><strong>Objek:</strong> {{ $data['judul_bukti_kerusakan'] }}</li>
                <li><strong>Deskripsi Kerusakan:</strong> {{ $data['deskripsi_bukti_kerusakan'] }}</li>
                <li><strong>Lokasi Detail:</strong> {{ $data['lokasi_bukti_kerusakan'] }}</li>
                <li><strong>Tipe Kerusakan:</strong> {{ $data['tipe_kerusakan'] }}</li>
                <li><strong>Pelapor:</strong> {{ $data['nama_pelapor'] }}</li>
            </ul>
            
            <a href="{{ url('/') }}" class="action-button">
                <i class="fas fa-clipboard-list"></i> Lihat Detail Laporan
            </a>
            
            <div class="warning-note">
                <i class="fas fa-exclamation-circle"></i>
                <div>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</div>
            </div>
        </div>
        
        <!-- Footer sama dengan template pertama -->
    </div>
</body>
</html>