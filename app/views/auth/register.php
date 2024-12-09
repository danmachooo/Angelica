<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="icon" type="image/png" href="<?=base_url();?>public/img/favicon.ico"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="<?=base_url();?>public/css/main.css" rel="stylesheet">
    <link href="<?=base_url();?>public/css/style.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <?php
    include APP_DIR.'views/templates/nav_auth.php';
    ?>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <?php flash_alert(); ?>
                            <form id="regForm" method="POST" action="<?=site_url('auth/register');?>">
                            <?php csrf_field(); ?>
                                <div class="row mb-3">
                                    <label for="firstname" class="col-md-4 col-form-label text-md-end">First Name</label>
                                    <div class="col-md-6">
                                        <input id="firstname" type="text" class="form-control" name="firstname" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-end">Last Name</label>
                                    <div class="col-md-6">
                                        <input id="lastname" type="text" class="form-control" name="lastname" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="address" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="birthday" class="col-md-4 col-form-label text-md-end">Birthday</label>
                                    <div class="col-md-6">
                                        <input id="birthday" type="date" class="form-control" name="birthday" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="contact_number" class="col-md-4 col-form-label text-md-end">Contact Number</label>
                                    <div class="col-md-6">
                                        <input id="contact_number" type="text" class="form-control" name="contact_number" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $(function() {
            var regForm = $("#regForm")
                if(regForm.length) {
                    regForm.validate({
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
                    })
                }
        })
    </script>
</body>
</html>