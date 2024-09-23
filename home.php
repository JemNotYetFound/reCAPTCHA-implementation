<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5dc; /* Beige background */
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #5b4423; /* Dark brown text */
        }
        .btn-secondary {
            background-color: #c6b096; /* Light beige button */
            border-color: #a78a72;
        }
        .btn-secondary:hover {
            background-color: #a78a72; /* Darker beige on hover */
        }
    </style>
</head>
<body>
    <h1 style="text-align:center; font-size:50px;">The Message is: <?php echo htmlspecialchars($_SESSION['message']); ?></h1>
    <br>
    <center><button onclick="window.location.href='index.php'" class="btn btn-secondary">Back</button></center>
</body>
</html>
