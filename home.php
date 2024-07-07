<?php
// include 'connections.php';
include 'resource/php/header_out.php';
include 'resource/php/connections.php';


?>

<!DOCTYPE html>
<html>

<head>
  <title></title>
</head>

<body>
  <div class="container">
    <!-- <img class="logo" src="resource/img/logo_only.png" alt="Logo"> -->

    <h2 class="title" style="">CONTROL NUMBER GENERATOR</h2>

    <div class="line"></div>
    <div class="department">
      <h4>DEPARTMENT OF INFORMATION AND COMMUNICATIONS TECHNOLOGY</h4>
    </div>

    <!-- <div class="welcome">
      <p>Welcome to our website, your ultimate destination for streamlined administrative processes and enhanced
        productivity. We are thrilled to present a comprehensive suite of innovative solutions designed to revolutionize
        the way you handle travel orders, purchased requests, and abstract orders. With our state-of-the-art Control
        Number Generator, you can bid farewell to manual errors and delays, as it automates the generation of control
        numbers with utmost accuracy and efficiency. Join us on this digital journey and unlock the power of seamless
        paperwork management, enabling you to focus on what truly matters - driving your organization forward. Explore
        our website and embark on a new era of administrative excellence.</p>
    </div> -->
  </div>
</body>

<style>
    body {
      display: flex;
      flex-direction: column;
      background-image: url("gif_bg2.gif");
      background-repeat: no-repeat;
      background-size: cover;
      align-items: center;
      justify-content: center;
    }

    .container {
      margin: 3%;
      background-color: rgba(255, 255, 255, 0.9);
      padding: 20px;
      width: 100%;
      opacity: 0.99;
    }

    .logo {
      max-width: 220px;
      margin-bottom: 20px;
      border-radius: 100px;
      margin-left: 40%;
      margin-bottom: 0;
    }

    /* .control-number-generator {
      text-align: center;
      font-size: 1cm;
    } */

    .department {
      text-align: center;
      font-size: 0.58cm;
      margin-bottom: 0.005mm;
    }

    .welcome {
      text-align: center;
      font-size: 0.6cm;
      margin-left: 2in;
      margin-right: 2in;
    }

    /* .line {
      border-top: 2px solid black;
      width: 100%;
    } */

    .title{
        font-size: 60px;
        text-align: center;
    }
  </style>
</html>