<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
     <style type="text/css">
       h1 {
  background-image: url("image01.jpg");
  background-size: cover;
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  height: 100px;
  width: 100%;
  text-align: center;
  font-family: "Roboto", sans-serif; /* Example using a web font */
  font-size: 3em; /* Adjust font size as needed */
  font-weight: bold;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}

        .data {
            margin: 20px auto;
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .form-container {
            margin: 20px auto;
            width: 80%;
            text-align: center;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="password"]:focus {
            outline: none;
            border-color: darkred;
        }

        .form-container input[type="submit"] {
            background-color: darkred;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #8B0000;
        }
    </style>
</head>
<body>
    <div class="image">
        <h1>Welcome Our SQL Query Builder Page</h1>
    </div>
    
    <div class="form-container">
        <form method="post" action="">
            <label for="dbname">Enter Database Name:</label>
            <input type="text" id="dbname" name="dbname" required><br>
            <label for="username">Enter Database Username:</label>
            <input type="text" id="username" name="username" required><br>
             <label for="username">Enter Database Password:</label>
            <input type="text" id="password" name="password"><br>
             <label for="username">Enter Database Table Name:</label>
            <input type="text" id="table" name="table" required><br>
             <label for="column">Enter Column Names (comma-separated):</label>
            <input type="text" id="columns" name="columns" required><br>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="data">
        <h2>Here your Database Details: </h2>
      <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; // Database server (usually 'localhost')
    $username = $_POST['username'];    // Database username
    $password = $_POST['password'];    // Database password
    $dbname = $_POST['dbname']; // Name of the database


      if($password == "NULL") {
      $pass = " ";
    } 

    else {
       $pass = $password;
    }

    // Create connection
    $conn = new mysqli($servername, $username, trim($pass), $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $table = $_POST['table'];
    $columns = $_POST['columns'];
    $column_array = explode(',', $columns); // Convert comma-separated string to array

    // Generate SQL query with dynamic columns
    if($columns == "All") {
      $sql = "SELECT * FROM $table";
    } 

    else {
        $sql = "SELECT " . implode(',', $column_array) . " FROM $table";
    }

    // Execute query
    $result = $conn->query($sql);

    echo "<table>"; // opening table tag

    // Output column headers
    echo "<tr>";
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        foreach ($row as $key => $value) {
            echo "<th>$key</th>";
        }
    }
    echo "</tr>";

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>"; // opening table row tag
            foreach ($row as $key => $value) {
                echo "<td>" . $value . "</td>"; // Output data for each column
            }
            echo "</tr>"; // closing table row tag
        }
    } else {
        echo "<tr><td colspan='" . count($column_array) . "'>0 results</td></tr>"; // table row for no results
    }

    echo "</table>"; // closing table tag

    $conn->close(); // Close the database connection
}
?>


    </div>

    <div class="Home Book Pic"></div>

    <footer></footer>

</body>
</html>
