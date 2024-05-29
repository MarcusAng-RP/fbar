<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "fbardb";

$link = mysqli_connect($host, $username, $password, $database);

// if (!$link) {
//     die("Connection failed: " . mysqli_connect_error());
// }


$Campaign_ID = $_GET['Campaign_ID'];


$querySelect = "
SELECT c.Claimants_NRIC, c.Claimants_name, c.Claimants_email, ca.Campaign_name, c.Claimants_Id
FROM claimants AS c
JOIN campaign_has_claimants AS cc ON cc.Claimants_Id = c.Claimants_Id
JOIN campaign AS ca ON ca.Campaign_Id = cc.Campaign_Id
WHERE cc.Campaign_Id = '$Campaign_ID';

";

$searchMentee = mysqli_query($link, $querySelect) or die(mysqli_error($link));

// while ($row = mysqli_fetch_assoc($searchMentee)) {
//     $arrResult[] = $row;
//     $Campaign_Name = $row['Campaign_name'];
// }

mysqli_close($link);

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Mentees in Campaign</title>
    <script src="https://kit.fontawesome.com/76304b6e6b.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="searchMentee.css" />
    <link rel="stylesheet" href="addMenteePage.css" />


</head>

<body>
    <?php include "addMenteePage.php" ?>


    <div class="square">
        <div class="table-container" style="margin: 10px;">
            <table>
                <?php
                if (mysqli_num_rows($searchMentee) == 0) {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                } else {
                ?>
                    <tr>
                        <th>NRIC</th>
                        <th>Name</th>
                        <th>Emails</th>
                        <th></th>
                        <th></th>

                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($searchMentee)) {
                    ?>
                        <tr>
                            <td><?php echo $row['Claimants_NRIC']; ?></td>
                            <td><?php echo $row['Claimants_name']; ?></td>
                            <td><?php echo $row['Claimants_email']; ?></td>
                            <td>
                                <button class="edit-button" onclick="location.href='editMenteeInfo.php?Claimants_ID=<?php echo $row['Claimants_Id']; ?>&Campaign_ID=<?php echo $Campaign_ID; ?>&Campaign_Name=<?php echo $row['Campaign_name'];; ?>'">
                                    <i class="fas fa-edit"></i>

                                </button>
                            </td>
                            <td>
                                <button class="add-button" onclick="location.href='addMenteeToCampaign.php?Claimants_ID=<?php echo $row['Claimants_Id']; ?>&Campaign_ID=<?php echo $Campaign_ID; ?>'">
                                    <i class="fas fa-ticket-alt"></i>

                                </button>
                            </td>

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