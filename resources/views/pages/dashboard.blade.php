<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>
<style>
    /* Modern Toast Notification */
    .toast {
        position: fixed;
        top: 20px; /* Changed from 50% to 20px from top */
        left: 50%;
        transform: translateX(-50%) scale(0.8); /* Removed Y translation */
        background-color: #fff;
        color: #333;
        padding: 20px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
        z-index: 9999;
        opacity: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        border-left: 5px solid #4CAF50;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-width: 350px;
        width: 90%;
    }

    /* Show toast with animation */
    .toast.show {
        opacity: 1;
        transform: translateX(-50%) scale(1); /* Removed Y translation */
    }

    /* Checkmark icon container */
    .toast-icon {
        width: 40px;
        height: 40px;
        background-color: #4CAF50;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
    }

    /* Checkmark animation */
    .toast-icon::before {
        content: "";
        position: absolute;
        width: 20px;
        height: 10px;
        border-left: 3px solid white;
        border-bottom: 3px solid white;
        transform: rotate(-45deg) scale(0);
        top: 12px;
        left: 8px;
        transition: transform 0.3s ease 0.2s;
    }

    .toast.show .toast-icon::before {
        transform: rotate(-45deg) scale(1);
    }

    /* Toast content */
    .toast-content {
        flex-grow: 1;
    }

    /* Toast title */
    .toast-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: #222;
    }

    /* Close button */
    .toast-close {
        background: none;
        border: none;
        color: #999;
        font-size: 18px;
        cursor: pointer;
        padding: 5px;
        margin-left: 10px;
        transition: color 0.2s;
    }

    .toast-close:hover {
        color: #666;
    }

    /* Progress bar */
    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 100%;
        background-color: rgba(76, 175, 80, 0.2);
    }

    .toast-progress::before {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        height: 100%;
        width: 100%;
        background-color: #4CAF50;
        animation: progress 3s linear forwards;
    }
</style>

<body>
<x-navbar :user="$user" />
<x-sidebar />
@if(session('success'))
<div id="toast" class="toast">
    <div class="toast-icon">
        <i class="fas fa-check" style="color: white; display: none;"></i>
    </div>
    <div class="toast-content">
        <div class="toast-title">Success!</div>
        <div class="toast-message">{{ session('success') }}</div>
    </div>
    <button class="toast-close">&times;</button>
    <div class="toast-progress"></div>
</div>
@endif
    <!-- Content Wrapper -->
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    {{-- <li class="active"><i class="fas fa-eye"></i> Overview</li> --}}
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <div class="card">
                <h2><i class="fas fa-star"></i> Welcome to NexusDash</h2>
                <p>This modern dashboard provides you with all the tools you need to manage your business efficiently.
                    The intuitive interface and powerful analytics will help you make data-driven decisions. Customize
                    your experience using the settings panel.</p>
            </div>

            <div class="card">
                <h2><i class="fas fa-bolt"></i> Recent Activity</h2>
                <p>Your business has seen a 24% growth in the last quarter. New customer acquisitions are up by 15%
                    compared to last month. Check the analytics section for detailed breakdowns of your performance
                    metrics.</p>
            </div>

            <div class="card">
                <h2><i class="fas fa-chart-line"></i> Key Statistics</h2>
                <p>Current month revenue: $48,372 (↑12%). Active users: 1,842 (↑8%). Conversion rate: 3.2% (↑0.4%).
                    These metrics indicate strong growth across all key performance indicators.</p>
            </div>
        </div>


<script src="{{ asset('js/components.js') }}"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        if(toast) {
            // Show toast with animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);
            
            // Close toast when close button is clicked
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                toast.classList.remove('show');
            });
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });
</script>

</html>