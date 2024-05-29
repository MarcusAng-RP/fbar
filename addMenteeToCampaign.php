<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fyp";

$Student_ID = $_GET['Student_ID'];
$Campaign_ID = $_GET['Campaign_ID'];

$link = mysqli_connect($host, $username, $password, $database);


$queryInsert = "INSERT INTO mentee_campaign (Mentee_ID, Campaign_ID) VALUES ($Student_ID, $Campaign_ID)";
mysqli_query($link, $queryInsert) or die(mysqli_error($link));


$querySelect = "SELECT m.Student_ID, m.Name, m.Diploma, m.School FROM mentee m
                JOIN mentee_campaign mc ON m.Student_ID = mc.Mentee_ID
                WHERE mc.Campaign_ID = $Campaign_ID";
$campaignMentees = mysqli_query($link, $querySelect) or die(mysqli_error($link));

$arrCampaignMentees = [];
while ($row = mysqli_fetch_assoc($campaignMentees)) {
    $arrCampaignMentees[] = $row;
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Campaign Mentees</title>
    <link rel="stylesheet" href="searchMentee.css">
</head>

<body>
    <h1>Campaign Mentees</h1>

    <div class="table-container">
        <table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Diploma</th>
                <th>School</th>
            </tr>
            <?php
            foreach ($arrCampaignMentees as $row) {
            ?>
                <tr>
                    <td><?php echo $row['Student_ID']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Diploma']; ?></td>
                    <td><?php echo $row['School']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <h2>Total Mentees: <?php echo count($arrCampaignMentees); ?></h2>
</body>

</html>