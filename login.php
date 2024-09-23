<?php
session_start();

if (isset($_POST['login'])) {
    // Google reCAPTCHA credentials
    $recaptcha_secret = "6Ld9yUoqAAAAACkaXsg08Vp2dfEBKuP4UM89NfEA";
    $recaptcha_response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

    // Verify reCAPTCHA
    if (!empty($recaptcha_response)) {
        $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        
        if ($verify_response !== false) {
            $response_data = json_decode($verify_response, true);
        
            if ($response_data['success']) {
                
            } else {
                $user = "Yugin";
                $pass = "ugn";
                $username = $_POST['username'];
                $password = $_POST['password'];

                if ($user === $username) {
                    if ($pass === $password) {
                        echo "<script>window.location.href = './home.php'</script>";
                    } else {
                        echo "<script>alert('Your password is incorrect');</script>";
                    }
                } else {
                    echo "<script>alert('Your username is incorrect');</script>";
                }
            }
        } else {
            echo "<script>alert('Unable to verify reCAPTCHA at the moment. Please try again later.');</script>";
        }
    } else {
        echo "<script>alert('Please complete the reCAPTCHA.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5dc; /* Beige background */
            font-family: Arial, sans-serif;
        }
        .card {
            background-color: #f9f4d0; /* Light beige card */
            border: 1px solid #d2b48c; /* Beige border */
        }
        .form-control {
            background-color: #fff3e0; /* Light beige input */
            border-color: #d2b48c;
        }
        .btn-primary {
            background-color: #a67b5b;
            border-color: #8a5d3b;
        }
        .btn-primary:hover {
            background-color: #8a5d3b;
            border-color: #764c2d;
        }
        .btn-secondary {
            background-color: #c6b096;
            border-color: #a78a72;
        }
        .btn-secondary:hover {
            background-color: #a78a72;
        }
        .loading-spinner {
            display: none;
            margin-top: 10px;
        }
        .g-recaptcha {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Login</h4>

                    <!-- Login Form -->
                    <form id="loginForm" action="" method="POST" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        </div>

                        <center>
                            <div class="g-recaptcha" data-sitekey="6Ld9yUoqAAAAACkaXsg08Vp2dfEBKuP4UM89NfEA"></div>
                        </center>

                        <div class="d-grid mt-3">
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                            <div class="loading-spinner">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Back Button -->
                    <div class="d-grid mt-3">
                        <button onclick="window.location.href='index.php'" class="btn btn-secondary">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function validateForm() {
        // Get form elements
        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;
        
        if (username === '' || password === '') {
            alert('Please fill out both fields.');
            return false;
        }
        
        // Display loading spinner
        document.querySelector('.loading-spinner').style.display = 'block';
        return true;
    }
</script>

</body>
</html>
