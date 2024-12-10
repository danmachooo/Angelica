<?php
include APP_DIR.'views/templates/header.php';
?>
<?php
include APP_DIR.'views/templates/sidenav_admin.php';
?>
<main class="flex-1 overflow-y-auto p-8 ml-64">
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Our Services</h1>
    <!-- Service button -->
        <button id="addServiceBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center mb-6">
            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Service
        </button>
    <!-- END Service button -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach($services as $service): ?>
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800"><?=$service['name']?></h2>
            </div>
            <p class="text-gray-600 mb-4"><?= $service['description'] ?></p>
            <div class="flex items-center text-gray-700 mb-2">
                <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Duration: <?=$service['duration']?> minutes
            </div>
            <div class="flex items-center text-gray-700">
                <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Price: ₱<?=$service['duration']?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div id="addServiceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Add Service</h3>
                <form id="serviceForm" class="space-y-4">
                    <div>
                        <label for="serviceName" class="block text-sm font-medium text-gray-700 mb-1">Service Name</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="text" id="serviceName" name="serviceName" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Enter service name">
                        </div>
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (minutes)</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="number" id="duration" name="duration" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Enter duration">
                        </div>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input type="number" id="price" name="price" step="0.01" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Enter price">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                            </div>
                            <textarea id="description" name="description" rows="3" required class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Enter service description"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="button" id="cancelBtn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2 transition duration-300 ease-in-out">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out">Add Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const modal = $('#addServiceModal');
        const addServiceBtn = $('#addServiceBtn');
        const cancelBtn = $('#cancelBtn');
        const serviceForm = $('#serviceForm');

        // Function to open the modal
        function openModal() {
            modal.removeClass('hidden');
        }

        // Function to close the modal
        function closeModal() {
            modal.addClass('hidden');
            serviceForm[0].reset(); // Reset the form when closing the modal
        }

        // Event listener for the add service button
        addServiceBtn.on('click', openModal);

        // Event listener for the cancel button
        cancelBtn.on('click', closeModal);

        // Event listener for the form submission
        serviceForm.on('submit', function(e) {
            e.preventDefault();
            
            // Collect form data
            const formData = {
                serviceName: $('#serviceName').val(),
                duration: $('#duration').val(),
                price: $('#price').val(),
                description: $('#description').val()
            };

            // Send AJAX request
            $.ajax({
                url: '<?= site_url('admin/services/add-service') ?>', // Replace with your actual endpoint
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Service added successfully!');
                        closeModal();
                        // Optionally, refresh the page or update the service list
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
                    console.error(xhr.responseText);
                }
            });
        });

        // Close the modal if clicked outside
        $(window).on('click', function(event) {
            if (event.target === modal[0]) {
                closeModal();
            }
        });
    });
</script>

<?php
include APP_DIR.'views/templates/footer.php';
?>
