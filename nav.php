<?php
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sinhala:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Noto Sans Sinhala', sans-serif;

        }
        .navbar-brand {
            margin-left: auto;
            margin-right: auto;
            font-size: xx-large;
        }
        .navbar {
            background-color: #333;
            padding: 10px;
        }
        .navbar h3 {
            color: #ffffff;
            margin-bottom: 20px;
        }
        .navbar a {
            color: #ffffff;
            display: inline-block;
            padding: 10px;
            margin-right: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        #success-bar {
       position: fixed;
       top: 0;       /* Position at the very top */
       left: 0;      /* Position at the very left */
       width: 100%;   /* Full width */
       z-index: 1000; /* Make sure it stays on top */
       display: none;  /* Hide by default */
         background-color: #4CAF50; /* Green background */
            color: white; /* White text color */
            text-align: center; /* Centered text */
            padding: 10px; /* Padding */
   }

        /* CSS for floating bars */
   .floating-bar {
     position: fixed;
     top: 0;       
     left: 0;      
     width: 100%; 
     z-index: 1000; 
     display: none;  
     animation: slideDown 0.5s ease-in-out; /* Add animation (optional) */
     animation: fadeInOut 3s ease-in-out; /* Total animation duration is 3s */ 
    color: white; /* White text color */
    text-align: center; /* Centered text */
    padding: 10px; /* Padding */
   } 
   #update-success, #add-success { 
       background-color: #d4edda; /* Light Green for success */ 
       border-color: #c3e6cb; 
       color: #155724; 
   } 
   #update-fail, #add-fail { 
     background-color: #f8d7da; /* Light Red for fail */ 
     border-color: #f5c6cb; 
     color: #721c24; 
   }
    tr:hover {
    /* background-color: #f0f0f5; Light gray highlight on hover */
    cursor: pointer;  /* Change cursor to hand icon */
}
table { 
        border-collapse: collapse; /* Improves the look of tables by default */
        width: 100%; 
    }
thead { 
        background-color: #333; /* Dark background color for the header */
        color: white; /* White text color */
        /* cursor: none; Default cursor for the header */
    }

    th, td {
        border: 0px ;
        padding: 8px; 
        text-align: left; 
    }

   /* Keyframes for animation (optional) */ 
   @keyframes slideDown {
     0% { transform: translateY(-50px); opacity: 0; }
     100% { transform: translateY(0); opacity: 1; } 
   }
   /* Keyframes for animation */ 
    @keyframes fadeInOut {
    0% { transform: translateY(-50px); opacity: 0; } /* Start faded out, above */
    20% { transform: translateY(0); opacity: 1; }     /* Fade in and move down */ 
    80% { transform: translateY(0); opacity: 1; }     /* Stay visible for a duration */
    100% { transform: translateY(-50px); opacity: 0; } /* Fade out and move up */
    }


    </style>
</head>
<body>
    <!-- <nav class="navbar">
        <h1 class="navbar-brand mx-auto">NBS ERP Dashboard</h1>

        <a class="nav-link" href="addnew.php">Add New Employee</a>
    </nav> -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient">
        <div class="container-fluid">
        <h1 class="navbar-brand mx-auto">NBS ERP Dashboard</h1>
            <!-- <a class="navbar-brand mx-auto" href="index.php">NBS ERP Dashboard</a> -->
            <a class="btn btn-outline-primary" href="addnew.php">Add New Employee</a>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
