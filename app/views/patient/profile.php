<?php
include APP_DIR . 'views/templates/header.php';
?>
<?php
include APP_DIR . 'views/templates/sidenav.php';
?>
<main class="flex-1 overflow-y-auto p-8 ml-64">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900">User Profile</h1>
                <button id="editProfileBtn" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Personal Information</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">First Name</p>
                                <p id="firstName" class="font-medium text-gray-900"><?=$profile['firstname']?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Last Name</p>
                                <p id="lastName" class="font-medium text-gray-900"><?=$profile['lastname']?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Date of Birth</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Birthday</p>
                                <p id="birthday" class="font-medium text-gray-900"><?=$profile['birthday']?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Age</p>
                                <p id="age" class="font-medium text-gray-900"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Contact Information</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p id="email" class="font-medium text-gray-900"><?=$profile['email']?></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Contact Number</p>
                                <p id="contactNumber" class="font-medium text-gray-900"><?=$profile['contact_number']?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Address</h2>
                        <p id="address" class="font-medium text-gray-900"><?=$profile['address']?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2">Edit Profile</h3>
                <form id="editProfileForm" class="mt-2 space-y-4">
                    <div>
                        <label for="editFirstName" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="editFirstName" name="firstname" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                    </div>
                    <div>
                        <label for="editLastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="editLastName" name="lastname" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                    </div>
                    <div>
                        <label for="editBirthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                        <input type="date" id="editBirthday" name="birthday" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                    </div>
                    <div>
                        <label for="editAddress" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea id="editAddress" name="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3"></textarea>
                    </div>
                    <div>
                        <label for="editContactNumber" class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="tel" id="editContactNumber" name="contact_number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3">
                    </div>
                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="button" id="cancelEditBtn" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Function to calculate age based on birthday
        function calculateAge(birthday) {
            const birthDate = new Date(birthday);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();

            // Adjust age if the birthday hasn't occurred yet this year
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        // Handle edit profile form submission
        $('#editProfileForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Gather form data
            const formData = {
                firstname: $('#editFirstName').val(),
                lastname: $('#editLastName').val(),
                birthday: $('#editBirthday').val(),
                address: $('#editAddress').val(),
                contact_number: $('#editContactNumber').val()
            };

            // Make the AJAX POST request
            $.ajax({
                url: 'update-profile', // The endpoint to send the data
                type: 'POST',
                data: formData,
                dataType: 'json', // Expect a JSON response from the server
                success: function (response) {
                    if (response.success) {
                        // Update the profile details on the page dynamically
                        $('#firstName').text(formData.firstname);
                        $('#lastName').text(formData.lastname);
                        $('#birthday').text(formData.birthday);
                        $('#address').text(formData.address);
                        $('#contactNumber').text(formData.contact_number);

                        // Calculate and update age
                        const age = calculateAge(formData.birthday);
                        $('#age').text(age);

                        // Hide the modal and show success feedback
                        $('#editProfileModal').addClass('hidden');
                        Swal.fire({
                            title: 'Success!',
                            text: 'Profile updated successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message || 'Something went wrong. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseText || 'An unexpected error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        // Handle opening the edit modal
        $('#editProfileBtn').on('click', function () {
            // Prepopulate the fields with current data
            $('#editFirstName').val($('#firstName').text());
            $('#editLastName').val($('#lastName').text());
            $('#editBirthday').val($('#birthday').text());
            $('#editAddress').val($('#address').text());
            $('#editContactNumber').val($('#contactNumber').text());

            // Show the modal
            $('#editProfileModal').removeClass('hidden');
        });

        // Handle cancel button in modal
        $('#cancelEditBtn').on('click', function () {
            $('#editProfileModal').addClass('hidden');
        });

        // Calculate and display age on page load
        const birthdayText = $('#birthday').text();
        if (birthdayText) {
            const age = calculateAge(birthdayText);
            $('#age').text(age);
        }
    });
</script><?php
include APP_DIR . 'views/templates/footer.php';
?>
