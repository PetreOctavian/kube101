<!DOCTYPE html>
<html lang="en">
<head>
	<title>Transactions</title>
	<link rel="stylesheet" type="text/css" href="../styles/Transactions.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
    include("../sources/Navbar.php");
?>

    <?php
        
        include_once 'SQL_Connection.php';
        //session_start();

        if (isset($_SESSION['connected_user_ID'])) {
            $id = $_SESSION['connected_user_ID'];

            $sql_get_connected_user_data_from_ID = "SELECT * from logindata where `ID` = '$id'";
            $query_get_connected_user_data_from_ID = mysqli_query($conn, $sql_get_connected_user_data_from_ID);
            if (!$query_get_connected_user_data_from_ID) {
                exit("Couln't extract data from logged user based on his id for navbar");
            }
            $final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);
        
            $username = $final['username'];
            $type = $final['user type'];
            if ($type == "admin") {
                $sql_get_transactions = "SELECT * from transactions";
            } elseif ($type == "user") {
                $sql_get_transactions = "SELECT * from transactions where `username` = '$username'";
            }
        


            $query_get_transactions = mysqli_query($conn, $sql_get_transactions);
            if (!$query_get_transactions) {
                exit("Couln't extract data from logged user based on his id for navbar");
            }
            //$final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);
            echo '<center>
                <table>
                    <tr>
                        <th>Nr. crt.</td>
                        <th>Command code</th>
                        <th>Command time</th>
                        <th>Command price</th>		
                    </tr>';
            $index = 1;
            while ($row = mysqli_fetch_assoc($query_get_transactions)) {
                echo    '<tr>
                        <td>' . $index . '</td>
                        <td>' . $row['code'] . '</td>
                        <td>' . $row['time'] . '</td>
                        <td>' . $row['money'] .' &#8364</td>                     
                    </tr>';
                $index++;
            }
            echo '  </table>
            </center>';
        }

    ?>
        
    
	
		
		
		
	    

</body>