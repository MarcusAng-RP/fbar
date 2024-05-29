<?php

// $NRIC_Input = $_POST['NRIC_Input'];
// $Campaign_ID = $_GET['Campaign_ID'];

$NRIC_Input = isset($_POST['NRIC_Input']) ? mysqli_real_escape_string($link, $_POST['NRIC_Input']) : '';
$Campaign_ID = isset($_GET['Campaign_ID']) ? mysqli_real_escape_string($link, $_GET['Campaign_ID']) : '';

$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

$querySelect = "SELECT * FROM claimants WHERE Claimants_NRIC = $NRIC_Input";

$searchClaimant = mysqli_query($link, $querySelect) or die(mysqli_error($link));


mysqli_close($link);


$arrResult = [];

while ($row = mysqli_fetch_assoc($searchClaimant)) {
    $arrResult[] = $row;
}


?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title></title>
    <link rel="stylesheet" href="searchMentee.css" />
    <link rel="stylesheet" href="addMenteePage.css" />
</head>

<body>


    <?php include "addMenteePage.php" ?>

    <div class="square">
        <div class="table-container">
            <table>
                <?php
                if (empty($arrResult)) {
                    echo "<tr><td colspan='5'>No record are found</td></tr>";
                } else {
                ?>
                    <tr>
                        <th>Claimant ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($arrResult as $row) {
                        $claimantId = isset($row['Claimants_Id']) ? $row['Claimants_Id'] : 'N/A';
                        $claimantName = isset($row['Claimants_name']) ? $row['Claimants_name'] : 'N/A';
                        $claimantEmail = isset($row['Claimants_email']) ? $row['Claimants_email'] : 'N/A';
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($claimantId); ?></td>
                            <td><?php echo htmlspecialchars($claimantName); ?></td>
                            <td><?php echo htmlspecialchars($claimantEmail); ?></td>
                            <td><button class="add-button" onclick="location.href='addMenteeToCampaign.php?Claimants_ID=<?php echo htmlspecialchars($claimantId); ?>&Campaign_ID=<?php echo htmlspecialchars($Campaign_ID); ?>'">Add</button></td>
                            <td><button class="edit-button" onclick="location.href='addMenteeToCampaign.php?Claimants_ID=<?php echo htmlspecialchars($claimantId); ?>&Campaign_ID=<?php echo htmlspecialchars($Campaign_ID); ?>'">Edit</button></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>