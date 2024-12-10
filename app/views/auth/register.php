<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Appointment System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
<?php
        include APP_DIR.'views/templates/nav_auth.php';
        ?>

    <main class="flex-grow flex items-center justify-center p-4">
        <div class="bg-white shadow-md rounded-lg w-full max-w-md p-8">
            <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
            <p class="text-center text-gray-600 mb-6">Create your account</p>
            <form id="regForm" class="space-y-4">
                <div>
                    <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="firstname" name="firstname" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="John">
                    </div>
                </div>
                <div>
                    <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="lastname" name="lastname" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Doe">
                    </div>
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-home text-gray-400"></i>
                        </div>
                        <input type="text" id="address" name="address" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="123 Main St, City, Country">
                    </div>
                </div>
                <div>
                    <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-birthday-cake text-gray-400"></i>
                        </div>
                        <input type="date" id="birthday" name="birthday" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="you@example.com">
                    </div>
                </div>
                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="text" id="contact_number" name="contact_number" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="1234567890">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="••••••••">
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="••••••••">
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#regForm").validate({
                rules: {
                    firstname: {
                        required: true,
                    },
                    lastname: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    contact_number: {
                        required: true,
                        digits: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    }
                },
                messages: {
                    firstname: {
                        required: "Please input your first name.",
                    },
                    lastname: {
                        required: "Please input your last name.",
                    },
                    address: {
                        required: "Please input your address.",
                    },
                    email: {
                        required: "Please input your email address.",
                        email: "Please enter a valid email address."
                    },
                    contact_number: {
                        required: "Please input your contact number.",
                        digits: "Please enter only numbers."
                    },
                    password: {
                        required: "Please input your password",
                        minlength: jQuery.validator.format("Password must be at least {0} characters.")
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        minlength: jQuery.validator.format("Password must be at least {0} characters."),
                        equalTo: "Passwords do not match."
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: '/auth/register',
                        method: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'You have successfully registered.',
                            }).then(() => {
                                window.location.href = '/home';
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: xhr.responseJSON?.message || 'Something went wrong!',
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>