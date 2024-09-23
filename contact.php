<?php
session_start();

class RecaptchaHandler {
    private $secret;
    
    public function __construct($secret) {
        $this->secret = $secret;
    }

    public function verifyResponse($response) {
        $endpoint = 'https://www.google.com/recaptcha/api/siteverify';
        $params = [
            'secret' => $this->secret,
            'response' => $response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];

        $query = http_build_query($params);
        $url = "{$endpoint}?{$query}";

        $verify_response = file_get_contents($url);
        if ($verify_response !== false) {
            return json_decode($verify_response, true);
        }
        return null;
    }
}

class MessageHandler {
    public static function sanitizeInput($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    public static function setSessionMessage($message) {
        $_SESSION['message'] = self::sanitizeInput($message);
    }

    public static function displayAlert($message) {
        echo "<script>alert('{$message}');</script>";
    }
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    if (!empty($recaptcha_response)) {
        $recaptcha = new RecaptchaHandler("6Ld9yUoqAAAAACkaXsg08Vp2dfEBKuP4UM89NfEA");
        $response_data = $recaptcha->verifyResponse($recaptcha_response);

        if ($response_data !== null && isset($response_data['success']) && $response_data['success']) {
            
        } else {
            MessageHandler::setSessionMessage($_POST['message']);
            MessageHandler::displayAlert('Your message has been sent. Please go to login.');
        }
    } else {
        MessageHandler::displayAlert('Please complete the reCAPTCHA.');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5dc; /* Beige background */
        }
        .card {
            background-color: #f8f4e3; /* Lighter beige for card background */
            border: 1px solid #e0d8c0; /* Border matching the beige theme */
        }
        .btn-primary {
            background-color: #d2b48c; /* Beige tone for buttons */
            border-color: #b29568;
        }
        .btn-primary:hover {
            background-color: #b29568; /* Darker beige on hover */
            border-color: #8b6f44;
        }
        .btn-secondary {
            background-color: #8b6f44; /* Complementary brown for secondary button */
            border-color: #6d552e;
        }
        .btn-secondary:hover {
            background-color: #6d552e;
            border-color: #523f22;
        }
        .form-label, h4 {
            color: #5a4630; /* Dark brown for text */
        }
        .g-recaptcha {
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="card-title text-center">Send a Message</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <input type="text" name="message" id="message" class="form-control" placeholder="Enter your message" required>
                            <br>
                            <center>
                                <div class="g-recaptcha" data-sitekey="6Ld9yUoqAAAAACkaXsg08Vp2dfEBKuP4UM89NfEA"></div>
                            </center>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="data" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <div class="d-grid mt-3">
                        <button onclick="window.location.href='index.php'" class="btn btn-secondary">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
