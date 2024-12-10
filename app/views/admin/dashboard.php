<?php
include APP_DIR.'views/templates/header.php';
?>
<?php
include APP_DIR.'views/templates/sidenav_admin.php';
?>
<main class="flex-1 overflow-y-auto p-8 ml-64">

<div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Users Card -->
            <div id="total-users-card" class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Users</h2>
                <p id="total-users" class="text-3xl font-bold text-blue-600">Loading...</p>
            </div>
            
            <!-- Total Appointments Card -->
            <div id="total-appointments-card" class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Appointments</h2>
                <p id="total-appointments" class="text-3xl font-bold text-green-600">Loading...</p>
            </div>
            
            <!-- Total Services Card -->
            <div id="total-services-card" class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Total Services</h2>
                <p id="total-services" class="text-3xl font-bold text-purple-600">Loading...</p>
            </div>
        </div>
        
        <!-- Top 3 Most Booked Services Graph -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Top 3 Most Booked Services</h2>
            <div id="chart-container" class="w-full h-64">
                <canvas id="servicesChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.min.js"></script>
    <script>
    const API_URL = '<?= site_url('admin/') ?>'; // Replace with your API endpoint.

    async function fetchDashboardData() {
        try {
            // Fetch total users
            const usersResponse = await fetch(`${API_URL}count-users`);
            const usersData = await usersResponse.json();
            document.getElementById('total-users').textContent = usersData.count || 0;

            // Fetch total appointments
            const appointmentsResponse = await fetch(`${API_URL}count-appointments`);
            const appointmentsData = await appointmentsResponse.json();
            document.getElementById('total-appointments').textContent = appointmentsData.count || 0;

            // Fetch total services
            const servicesCountResponse = await fetch(`${API_URL}top-services`);
            const servicesCountData = await servicesCountResponse.json();
            document.getElementById('total-services').textContent = servicesCountData.count || 0;

            // Fetch top services
            const servicesResponse = await fetch(`${API_URL}top-services`);
            const servicesData = await servicesResponse.json();
            
            if (servicesData.top_services && servicesData.top_services.length > 0) {
                const topServices = servicesData.top_services;
                createServicesChart(topServices);
            } else {
                document.getElementById('chart-container').innerHTML = '<p class="text-gray-500">No data available</p>';
            }
        } catch (error) {
            console.error('Error fetching dashboard data:', error);
            document.getElementById('total-users').textContent = 'Error';
            document.getElementById('total-appointments').textContent = 'Error';
            document.getElementById('total-services').textContent = 'Error';
            document.getElementById('chart-container').innerHTML = '<p class="text-red-500">Error loading chart data</p>';
        }
    }

    function createServicesChart(services) {
        const ctx = document.getElementById('servicesChart').getContext('2d');
        const chartData = {
            labels: services.map(service => service.name),
            datasets: [{
                label: 'Number of Bookings',
                data: services.map(service => service.bookings),
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(139, 92, 246, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(139, 92, 246, 1)'
                ],
                borderWidth: 1
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Bookings'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Services'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // Call the function to fetch data when the page loads
    document.addEventListener('DOMContentLoaded', fetchDashboardData);
    </script>

    <?php
include APP_DIR.'views/templates/footer.php';
?>
