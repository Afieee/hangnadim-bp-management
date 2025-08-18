<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>


<body>
<x-navbar :user="$user" />
<x-sidebar />

    <!-- Content Wrapper -->
    <div class="content-wrapper" id="content-wrapper">
        <!-- Breadcrumb Navigation -->
        <div class="breadcrumb-container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                    <li class="active"><i class="fas fa-eye"></i> Overview</li>
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
<x-footer />


<script src="{{ asset('js/components.js') }}"></script>
</body>

</html>