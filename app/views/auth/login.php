<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Appointment System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <?php
        include APP_DIR.'views/templates/nav_auth.php';
        ?>

    <main class="flex-grow flex items-center justify-center p-4">
        <div class="bg-white shadow-md rounded-lg w-full max-w-md p-8">
            <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
            <p class="text-center text-gray-600 mb-6">Enter your email and password to login</p>
            <form id="loginForm" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
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
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Login
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center">
                <a href="/auth/password-reset" class="text-sm text-blue-600 hover:text-blue-800">
                    Forgot your password?
                </a>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: '/auth/login',
                    method: 'POST',
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function(response) {

                        var parsedResponse = typeof response === "string" ? JSON.parse(response) : response;
                        console.log(parsedResponse.success); // Access success property
                        console.log(parsedResponse.message); // Access message property
                        console.log(parsedResponse.role); // Access message property

                        if(parsedResponse.success) {
                            if(parsedResponse.role === "admin") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'You have successfully logged in.'
                                }).then(() => {
                                    console.log("LOGGING IN AS ADMIN");
                                    window.location.href = '/admin/dashboard';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'You have successfully logged in.'
                                }).then(() => {
                                    window.location.href = '/home';
                                });
                            }

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid credentials!',
                                text: 'The email and password does not match to our system.'
                            }).then(() => {
                                window.location.href = '/auth/login';
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr.responseJSON?.message || 'Something went wrong!',
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>