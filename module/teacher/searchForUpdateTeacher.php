<?php
include_once('main.php');
include_once('../../service/mysqlcon.php');

$string = "<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Password</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Gender</th>
    <th>DOB</th>
    <th>Address</th>
</tr>";

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$check = mysqli_real_escape_string($conn, $check); // Sanitize input to prevent SQL injection

$sql = "SELECT * FROM teachers WHERE id='$check';";
$result = $conn->query($sql);

if (!$result) {
    die('Error in SQL query: ' . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    $string .= "<tr>
        <td><input value='" . $row['id'] . "' name='id' readonly ></td>
        <td><input type='text' value='" . $row['name'] . "' name='name' readonly></td>
        <td><input type='text' value='" . $row['password'] . "' name='password'></td>
        <td><input type='text' value='" . $row['phone'] . "' name='phone'></td>
        <td><input type='text' value='" . $row['email'] . "' name='email'></td>
        <td><input type='text' value='" . $row['sex'] . "' name='gender' readonly></td>
        <td><input type='text' value='" . $row['dob'] . "' name='dob' readonly></td>
        <td><input type='text' value='" . $row['address'] . "' name='address'></td>
    </tr>";
}

echo $string . "<input type='submit' name='submit' value='Submit'>";

// Close the connection
$conn->close();
?>

<!--<input type="submit" value="Submit">
<input type="text" name="fname"><br>-->
