<html>
<head>
<Title>Registration Form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search here!</h1>
    <p>Enter a name and/or email and/or company you wish to search for and then, click <strong>Submit</strong> to search.</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Name <input type="text" name="name" id="name"/></br>
      Email <input type="text" name="email" id="email"/></br>
      Company Name <input type="text" name="company" id="company"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-north-b.cloudapp.net";
    $user = "b7878b9b1e9748";
    $pwd = "50883fe3";
    $db = "carterrAt0XtOdIf";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Capture form data
    if(!empty($_POST)) {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = date("Y-m-d");
        $company = $_POST['company'];     

    }
    catch(Exception $e) {
        die(var_dump($e));
    }

    }

    // Retrieve data
    

    $sql_select = "SELECT * FROM registration_tbl WHERE name LIKE CONCAT ('%',?,'%')";
    
//AND email LIKE '%{$email}%' AND company LIKE '%{$company}%'";

	 $stmt->bindValue("1", $name);
	 $stmt->execute();


     $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll();

    if(count($registrants) > 0) {
        echo "<h2>Search Results</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th>";
        echo "<th>Company</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td>";
            echo "<td>".$registrant['company']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Your search did not match any records</h3>";
    }
?>
</body>
</html>