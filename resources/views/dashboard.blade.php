<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @if(Auth::user() && Auth::user()->is_admin)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Users -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-indigo-600">{{ $usersCount ?? 'N/A' }}</div>
                        <div class="text-gray-700 dark:text-gray-200 mt-2">Users</div>
                    </div>
                    <!-- Products -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-indigo-600">{{ $productsCount ?? 'N/A' }}</div>
                        <div class="text-gray-700 dark:text-gray-200 mt-2">Products</div>
                    </div>
                    <!-- Orders -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-indigo-600">{{ $ordersCount ?? 'N/A' }}</div>
                        <div class="text-gray-700 dark:text-gray-200 mt-2">Orders</div>
                    </div>
                    <!-- Categories -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                        <div class="text-3xl font-bold text-indigo-600">{{ $categoriesCount ?? 'N/A' }}</div>
                        <div class="text-gray-700 dark:text-gray-200 mt-2">Categories</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-semibold mb-4">Quick Management</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('users.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Manage Users</a>
                            <a href="{{ route('admin.products.manage') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Manage Products</a>
                            {{-- <a href="{{ route('orders.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Manage Orders</a>
                            <a href="{{ route('categories.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Manage Categories</a> --}}
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-semibold mb-4">Products by Category</h3>
                        <canvas id="productsByCategoryChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Orders by Status Chart -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-8">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col items-center">
                        <h3 class="text-2xl font-semibold mb-2 text-center w-full">Orders by Status</h3>
                        <div class="flex flex-col items-center w-full">
                            <canvas id="ordersByStatusChart" width="220" height="220"></canvas>
                            @if(empty($ordersByStatusLabels) || count($ordersByStatusLabels) === 0)
                                <p class="text-gray-500 mt-4">No order status data available.</p>
                            @endif
                            <div id="ordersByStatusLegend" class="flex flex-wrap justify-center gap-4 mt-4"></div>
                        </div>
                    </div>
                </div>
                @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Products by Category (already present)
                    const ctxProducts = document.getElementById('productsByCategoryChart').getContext('2d');
                    new Chart(ctxProducts, {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($productsPerCategory->pluck('name')) !!},
                            datasets: [{
                                label: 'Products',
                                data: {!! json_encode($productsPerCategory->pluck('count')) !!},
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: { y: { beginAtZero: true } }
                        }
                    });

                    // Orders by Status
                    const ctxOrders = document.getElementById('ordersByStatusChart').getContext('2d');
                    const ordersByStatusLabels = {!! json_encode($ordersByStatusLabels ?? []) !!};
                    const ordersByStatusData = {!! json_encode($ordersByStatusData ?? []) !!};
                    const ordersByStatusColors = [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ];
                    const ordersByStatusChart = new Chart(ctxOrders, {
                        type: 'doughnut',
                        data: {
                            labels: ordersByStatusLabels,
                            datasets: [{
                                label: 'Orders',
                                data: ordersByStatusData,
                                backgroundColor: ordersByStatusColors.slice(0, ordersByStatusLabels.length),
                                borderColor: '#fff',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: false,
                            cutout: '70%',
                            plugins: {
                                legend: { display: false }
                            }
                        }
                    });

                    // Custom legend (horizontal, below chart)
                    const legendContainer = document.getElementById('ordersByStatusLegend');
                    if (legendContainer && ordersByStatusLabels.length > 0) {
                        legendContainer.innerHTML = '';
                        ordersByStatusLabels.forEach(function(label, idx) {
                            const color = ordersByStatusColors[idx % ordersByStatusColors.length];
                            const legendItem = document.createElement('span');
                            legendItem.className = "flex items-center space-x-2";
                            legendItem.innerHTML = `<span style="display:inline-block;width:16px;height:16px;background:${color};border-radius:50%;margin-right:6px;"></span><span class="text-sm">${label}</span>`;
                            legendContainer.appendChild(legendItem);
                        });
                    }
                </script>
                @endpush

                <!-- User Registrations Over Time Chart -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-8">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-semibold mb-4">User Registrations Over Time</h3>
                        <canvas id="userRegistrationsChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-semibold mb-4">Recent Orders</h3>
                        @if(isset($recentOrders) && count($recentOrders) > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left">Order #</th>
                                        <th class="px-4 py-2 text-left">User</th>
                                        <th class="px-4 py-2 text-left">Total</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td class="px-4 py-2">{{ $order->id }}</td>
                                            <td class="px-4 py-2">{{ $order->user->name ?? 'N/A' }}</td>
                                            <td class="px-4 py-2">${{ number_format($order->total, 2) }}</td>
                                            <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                                            <td class="px-4 py-2">{{ $order->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No recent orders found.</p>
                        @endif
                    </div>
                </div>

                @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // User Registrations Over Time
                    const ctxUsers = document.getElementById('userRegistrationsChart').getContext('2d');
                    new Chart(ctxUsers, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($userRegistrationsLabels ?? []) !!},
                            datasets: [{
                                label: 'Registrations',
                                data: {!! json_encode($userRegistrationsData ?? []) !!},
                                fill: false,
                                borderColor: 'rgba(255, 159, 64, 1)',
                                tension: 0.1
                            }]
                        }
                    });
                </script>
                @endpush
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <span class="text-red-600 font-bold">You do not have permission to view this page.</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>