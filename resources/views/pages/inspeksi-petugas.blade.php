<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspection Scheduling Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>
<body class="bg-gray-50 font-sans">
    <x-navbar />
    <x-sidebar />

    <div class="content-wrapper ml-0 md:ml-64 transition-all duration-300" id="content-wrapper">
        <!-- Header with Breadcrumb and Date Picker -->
        <div class="px-6 py-4 bg-white">
                <div class="breadcrumb">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                    <i class="fas fa-home mr-2"></i> Dashboard
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400"></i>
                                    <span class="ml-1 text-sm font-medium text-blue-500 md:ml-2">
                                        <i class="fas fa-eye mr-2"></i>Inspeksi Gedung
                                    </span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
        </div>

        <!-- Content Area -->
        <div class="p-6">
            <!-- Stats Cards -->
            {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Inspeksi</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ count($inspeksi) }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                            <i class="fas fa-building text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Inspections Completed</p>
                            <p class="text-2xl font-semibold text-gray-800">24</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-500">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Inspections</p>
                            <p class="text-2xl font-semibold text-gray-800">8</p>
                        </div>
                        <div class="p-3 rounded-full bg-orange-100 text-orange-500">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Inspection Table -->
            <div class="bg-white rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">    Inspeksi Gedung - {{ $bulan }} {{ $tahun }}
                        <span class="text-sm text-gray-500">({{ count($inspeksi) }} Inspeksi Sedang Dibuka)</span>
 </h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gedung
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Inspeksi Dibuka
                                </th>

                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Lihat Detail
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($inspeksi as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-building text-blue-500"></i>
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('tampil.detail.inspeksi', $item->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                                {{ $item->gedung->nama_gedung }}
                                            </a>
                                            <div class="text-sm text-gray-500">{{ $item->gedung->lokasi }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('tampil.detail.inspeksi', $item->id) }}" class="text-blue-600 hover:text-blue-900" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Previous
                        </a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Next
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="{{ asset('js/components.js') }}"></script>
    <script src="{{ asset('js/inspeksi-petugas.js') }}"></script>
    

</body>
</html>