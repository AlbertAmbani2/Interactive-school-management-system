<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');
include_once('index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../source/CSS/style.css">
</head>
<body>

    <div align="center">
        <img src="../images/<?php echo $check ?>.jpg" alt="<?php echo $check ?>"/>
    </div>

    <div class="header">
        <?php
        // Assuming $check is properly sanitized and validated
        $check = $_SESSION['login_id'];

        // Create connection
        $conn = new mysqli($host, $username, $password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM teachers WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $check); // Assuming 'id' is a string, use 'i' if it's an integer
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Output table header
            echo "<div class='container'>";
            echo "<table class='table'>";
            echo "<thead class='thead-light'>
                      <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Date of Birth</th>
                          <th>Email Address</th>
                          <th>Sex</th>
                          <th>Hire Date</th>
                          <th>Salary</th>
                      </tr>
                  </thead>";
            echo "<tbody>";

            // Fetch and display results
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                          <td>" . $row['id'] . "</td>
                          <td>" . $row['name'] . "</td>
                          <td>" . $row['phone'] . "</td>
                          <td>" . $row['dob'] . "</td>
                          <td>" . $row['email'] . "</td>
                          <td>" . $row['sex'] . "</td>
                          <td>" . $row['hiredate'] . "</td>
                          <td>" . $row['salary'] . "</td>
                      </tr>";
            }

            // Close the table and container
            echo "</tbody></table></div>";
        } else {
            // No results found
            echo "<div class='container'>No results found.</div>";
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
