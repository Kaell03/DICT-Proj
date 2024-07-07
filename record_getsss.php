<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>


  <div class="container">
    <div style=" justify-content:space-between; align-items: center;">
    <section>
   
    <h1 style=" font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"> Welcome to the Records Website</h1>
    <style>
   body {
    background-image: url("localhost/records_get/dictoffice.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }
    header h1 {
      margin: 0; /* Remove any margin */
      padding-top: 10px; /* Adjust the top padding as needed */
    }
  </style>
    <p>This website serves as a repository of records for various categories.</p>
    <p>Here, you can access and view different types of records, including:</p>
   
    <ul>
      <li>Travel Order</li>
      <li>Purchase Request</li>
      <li>Abstract Order</li>
    </ul>

    <p>Please note that the records available on this website are intended for official or legal documents only.</p>
    <p>Feel free to explore the collection and make use of the search and filtering features to find the records you are interested in.</p>
  </section>
   
    
    
    
    </div>
    <table>

      <thead>
        <th>Name </th>
        <th>Control Number</th>
        <th>Type</th>
        <th>Particulars</th>
        <th>Designation</th>
        <th>Destination</th>
        <th>Actions</th>


      </thead>

      <tbody>
        <tr>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
        </tr>
        <tr>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
        </tr>
        <tr>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
        </tr>
        <tr>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
          <td>s</td>
        </tr>
        <!-- <?php

        $connection = new mysqli('localhost', 'root', '', 'file_bank');
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }
        $query = "SELECT * FROM records";
        $query_run = mysqli_query($connection, $query);
        if (mysqli_num_rows($query_run) > 0) {
          // echo "titeng galet";
          foreach ($query_run as $row) {
            $ids = $row['control_number'];
            ?>
<tr>
  <td><?php echo $row['name_of_personnel']; ?></td>
  <td><?php echo $row['control_number']; ?></td>
  <td><?php echo $row['type']; ?></td>
  <td><?php echo $row['particulars']; ?></td>
  <td><?php echo $row['designation']; ?></td>
  <td><?php echo $row['destination']; ?></td>
  <td><button onclick="prev_cont('<?php echo $row['control_number']; ?>')">update</button></td>
</tr>

<?php
          }
        }
        ?> -->

        <script>
          function prev_cont(id) {
            window.alert(id);
          }
        </script>


      </tbody>
    </table>

    <h2 class="update">Update Record</h2>


    <div class="dropdown">

      <input type="text" id="input">

      <select name="" id="">

        <option value="particulars">Particulars</option>
        <option value="designation">Designation</option>
        <option value="destination">Destination</option>
      </select>

      To:<input type="text">
    </div>
    <div class="centered-button-container">
      <button class="centered-button">Save</button>
    </div>
  </div>

  </div>
</body>

</html>