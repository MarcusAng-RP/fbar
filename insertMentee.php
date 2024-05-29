<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fyp";

$link = mysqli_connect($host, $username, $password, $database);

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Student_ID = $_POST['Student_ID'];
    $Campaign_ID = $_POST['Campaign_ID'];

    $queryInsert = "INSERT INTO mentee_campaign (Mentee_ID, Campaign_ID) VALUES ('$Student_ID', '$Campaign_ID')";

    if (mysqli_query($link, $queryInsert)) {
        echo "Mentee added to campaign successfully!";
    } else {
        echo "Error: " . $queryInsert . "<br>" . mysqli_error($link);
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Mentee to Campaign</title>
</head>

<body>
    <h1>Add Mentee to Campaign</h1>
    <form method="post" action="insertMentee.php">
        Student ID: <input type="text" name="Student_ID" required><br>
        Campaign ID: <input type="text" name="Campaign_ID" required><br>
        <input type="submit" value="Add Mentee">
    </form>
</body>

</html>