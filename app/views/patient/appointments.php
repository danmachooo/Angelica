<?php
include APP_DIR.'views/templates/header.php';
?>
<?php
include APP_DIR.'views/templates/sidenav.php';
?>
<main class="flex-1 overflow-y-auto p-8 ml-64">

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Appointments</h1>
    
    <!-- Book Appointment Button -->
    <button id="bookAppointmentBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center mb-6">
        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Book Appointment
    </button>
    <!-- Appointments List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if(isset($appointments)) {?>
        <?php foreach($appointments as $app): ?>
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-xl font-semibold text-gray-800"><?= html_escape($app['service_name']) ?></h2>
            </div>
            <div class="space-y-2">
                <div class="flex items-center text-gray-600">
                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Duration: <?= $app['service_duration'] ?> minutes
                </div>
                <div class="flex items-center text-gray-600">
                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Price: ₱<?= $app['service_price'] ?>
                </div>
                <div class="flex items-center text-gray-600">
                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Date: <?= $app['appointment_date']?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } else {?>
            <h3 class="text-lg leading-6 font-medium text-gray-900">No Appointment</h3>
        <?php }?>

    </div>
</main>

</div>

<!-- Book Appointment Modal -->
<div id="bookAppointmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Book an Appointment</h3>
            <div class="mt-2 px-7 py-3">
                <form id="appointmentForm" class="space-y-4">
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700">Service</label>
                        <select id="service" name="service" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option name="service" id="service" value="">Select a service</option>
                            <?php if(isset($services)) {?>
                                <?php foreach($services as $service): ?>
                                    <option value="<?= $service['id']?>"><?= $service['name'] ?></option>
                                <?php endforeach; ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label for="appointment_date" class="block text-sm font-medium text-gray-700">Appointment Date</label>
                        <input type="datetime-local" id="appointment_date" name="appointment_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" id="cancelBtn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        const modal = document.getElementById('bookAppointmentModal');
        const bookBtn = document.getElementById('bookAppointmentBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const appointmentForm = document.getElementById('appointmentForm');

        bookBtn.onclick = function() {
            modal.classList.remove('hidden');
        }

        cancelBtn.onclick = function() {
            modal.classList.add('hidden');
        }

        appointmentForm.onsubmit = function(e) {
            e.preventDefault();
            
            const formData = new FormData(appointmentForm);
            
            // Show loading indicator
            Swal.fire({
                title: 'Booking Appointment',
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send AJAX request for booking appointment
            fetch('<?= site_url('patient/book-appointment') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // If appointment booking is successful, create an invoice
                    const invoiceData = new FormData();
                    invoiceData.append('appointment_id', data.appointment_id);
                    invoiceData.append('service_id', formData.get('service'));
                    return fetch('<?= site_url('patient/create-invoice') ?>', {
                        method: 'POST',
                        body: invoiceData
                    });
                } else {
                    throw new Error(data.message || 'Failed to book appointment');
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(invoiceData => {
                if (invoiceData.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Appointment booked and invoice created successfully.',
                    }).then(() => {
                        // Close the modal and refresh the page
                        modal.classList.add('hidden');
                        location.reload();
                    });
                } else {
                    throw new Error(invoiceData.message || 'Failed to create invoice');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.log(error   )
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.message || 'An unexpected error occurred. Please try again later.',
                });
            });
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
<?php
include APP_DIR.'views/templates/footer.php';
?>
