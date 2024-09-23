<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Choose an Option</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

  <style>
    body {
      background-color: #f5f5dc; /* Beige background */
      font-family: 'Arial', sans-serif;
    }
    
    .choice-container {
      background-color: #f8f4e3; /* Light beige */
      border: 2px solid #d2b48c; /* Beige tone border */
      padding: 20px;
      text-align: center;
      transition: all 0.3s ease-in-out;
      cursor: pointer;
      border-radius: 10px;
    }

    .choice-container:hover {
      background-color: #e9e1c1; /* Slightly darker beige */
      box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
      transform: translateY(-10px);
    }

    .choice-title {
      font-size: 1.6rem;
      font-weight: bold;
      color: #5a4630; /* Dark brown text */
      margin-bottom: 10px;
    }

    .choice-container i {
      font-size: 3rem;
      color: #8b6f44; /* Brown icons */
      margin-bottom: 10px;
      transition: color 0.3s ease;
    }

    .choice-container:hover i {
      color: #b29568; /* Lighter brown on hover */
    }

    .choice-description {
      font-size: 1.1rem;
      color: #6d552e; /* Complementary text color */
    }

    /* Additional classes for complex effects */
    .container-transition {
      opacity: 0;
      transform: translateY(50px);
      animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .choice-container:active {
      transform: scale(0.98); /* Slight shrink effect when clicked */
    }

  </style>
</head>
<body>

<div class="container mt-5 container-transition">
  <h2 class="text-center mb-4" style="color: #5a4630;">What would you like to do?</h2>

  <div class="row justify-content-center">
    <!-- Send a Message container -->
    <div class="col-md-4 mb-4">
      <a href="contact.php" class="text-decoration-none">
        <div class="choice-container shadow">
          <i class="bi bi-envelope"></i>
          <div class="choice-title">Send a Message</div>
          <p class="choice-description">Click here to send us a message or ask a question.</p>
        </div>
      </a>
    </div>

    <!-- Login container -->
    <div class="col-md-4 mb-4">
      <a href="login.php" class="text-decoration-none" id="login-link">
        <div class="choice-container shadow">
          <i class="bi bi-box-arrow-in-right"></i>
          <div class="choice-title">Login to the System</div>
          <p class="choice-description">Click here to log in to your account.</p>
        </div>
      </a>
    </div>
  </div>
</div>

<!-- JavaScript for complex behavior -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Add hover effects using JavaScript
    let containers = document.querySelectorAll('.choice-container');
    containers.forEach(function(container) {
      container.addEventListener('mouseenter', function() {
        container.style.borderColor = "#b29568"; // Light beige border on hover
      });
      container.addEventListener('mouseleave', function() {
        container.style.borderColor = "#d2b48c"; // Reset to original beige
      });
    });

    // Show alert on message click
    document.getElementById('message-link').addEventListener('click', function(event) {
      event.preventDefault();
      alert('You are about to send a message!');
      setTimeout(function() {
        window.location.href = "contact.php";
      }, 1000);
    });

    // Login container hover effect
    document.getElementById('login-link').addEventListener('mouseenter', function() {
      this.querySelector('i').style.transform = 'rotate(20deg)';
    });
    document.getElementById('login-link').addEventListener('mouseleave', function() {
      this.querySelector('i').style.transform = 'rotate(0deg)';
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
