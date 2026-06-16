
<!DOCTYPE html>
<html>
<head>
    <title>Display</title>
    <style>
        body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
            }

            #title {
                text-align: center;
                font-size: 2em;
                padding: 20px;
                color: #004688;
                font-weight: bold;
            }

            #table-container {
                overflow-x: auto; /* add horizontal scrolling */
                max-width: 100%; /* specify max-width */
            }

            table {
                border: 3px solid #666;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #666;
                text-align: left;
                padding: 5px;
                word-wrap: break-word; /* break words properly on small screens */
                width: auto; /* set width of table cells to auto */
            }

            th {
                background-color: #004688;
                color: #fff;
                text-align: center;
            }

            tr:nth-child(even) {
                background-color: #e8e8e8;
            }

            .update,
            .delete {
                display: inline-block;
                width: 80px;
                height: 19px;
                border: none;
                border-radius: 5px;
                color: white;
                font-weight: bold;
                text-align: center;
                line-height: 19px;
                text-decoration: none;
                margin: 5px;
            }

            .update {
                background: green;
            }

            .delete {
                background: red;
            }


    </style>
</head>
<body>
    <?php
    require_once "admin_config.php";

    // Check if the database connection is successful
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM students";
    $data = $db->query($query);

    // Check if the query was successful
    if (!$data) {
        echo "Error: " . $query . "<br>" . $db->error;
    } else {
        $total = $data->rowCount();

        if ($total != 0) {
            echo "<div id='title'>Displaying All Records</div>";
            echo "<div id='table-container'>";
            echo "<center>";
            echo "<table border='3' cellspacing='10' width='100%'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Student ID</th>";
            echo "<th>Password</th>";
            echo "<th>Gender</th>";
            echo "<th>DOB</th>";
            echo "<th>Address</th>";
            echo "<th>Category</th>";
            echo "<th>Sports</th>";
            echo "<th>Email</th>";
            echo "<th>Mobile No</th>";
            echo "<th>Image</th>";
            echo "<th>Sign</th>";
            echo "<th style='width:15%'>Operations</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($result = $data->fetch(PDO::FETCH_ASSOC)) {
                $imagePath = '/sports_ms/Registration/uploads/' . $result['image'];
                $signPath = '/sports_ms/Registration/uploads/' . $result['sign'];

                if (file_exists($_SERVER["DOCUMENT_ROOT"] . $imagePath)) {
                    $displayImage = "<img src = '" . $imagePath . "' alt='Student Image' height='100px' width='100px'>";
                } else {
                    $displayImage = "Image file not found: " . $imagePath;
                }

                if (file_exists($_SERVER["DOCUMENT_ROOT"] . $signPath)) {
                    $displaySign = "<img src = '" . $signPath . "' alt='Student Signature' height='100px' width='100px'>";
                } else {
                    $displaySign = "Sign file not found: " . $signPath;
                }

                echo "<tr>";
                echo "<td>" . $result['first_name'] . "</td>";
                echo "<td>" . $result['last_name'] . "</td>";
                echo "<td>" . $result['student_id'] . "</td>";
                echo "<td>" . $result['password'] . "</td>";
                echo "<td>" . $result['gender'] . "</td>";
                echo "<td>" . $result['dob'] . "</td>";
                echo "<td>" . $result['address'] . "</td>";
                echo "<td>" . $result['category'] . "</td>";
                echo "<td>" . $result['sports'] . "</td>";
                echo "<td>" . $result['email'] . "</td>";
                echo "<td>" . $result['mobile'] . "</td>";
                echo "<td>" . $displayImage . "</td>";
                echo "<td>" . $displaySign . "</td>";
                echo "<td>";
                echo "<a href='update_design.php?id=" . $result['student_id'] . "'><button class='update'>Update</button></a>";
                echo "<a href='delete.php?id=" . $result['student_id'] . "' class='delete' onclick='return checkdelete()'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</center>";
            echo "</div>";
        } else {
            echo "<h2>No records found</h2>";
        }
    }

    // Close the database connection
    $db = null;
    ?>

    <script>
        function checkdelete() {
            return confirm('Are you sure to delete this record ?');
        }
    </script>
</body>
</html>