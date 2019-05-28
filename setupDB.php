<?php
//I certify that this submission is my own original work Danielle Hyland R01852274
	$servername = "localhost";
	$username = "jim";
	$password = "mypasswd";
	//$dbname = "capstone";


	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//Create cameras database
	$sql = "CREATE DATABASE cameras";
	if ($conn->query($sql) === TRUE) {
		echo "Database created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
	}

	//Connect to database
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) die ("Connection failed: " . $conn->connect_error);


	//Creates the cameras TABLE
	$query = "CREATE TABLE cameras (
		id VARCHAR(25) PRIMARY KEY,
		brand VARCHAR(128) NOT NULL,
		model VARCHAR(128) NOT NULL,
		MP FLOAT NOT NULL,
		focusPoints INT NOT NULL,
		sensorFormat VARCHAR(4) NOT NULL,
		description VARCHAR(255)
	)";

	//actually runs the query in the database
	$result = $conn->query($query);
	if ($conn->query($sql) === TRUE) {
        echo "Table cameras created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
	
	//Inserts first record into the cameras table
	$query = "INSERT INTO cameras VALUES('ND610', 'Nikon', 'D610', 24.3, 39, 'FX', 'The power of a pro-level Nikon FX-format camera is attainable in a compact, lightweight full-frame HD-SLR body.')";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed");

	//Inserts second record into the cameras table
	$query = "INSERT INTO cameras VALUES('ND750', 'Nikon', 'D750', 24.3, 51, 'FX', 'For those who find inspiration everywhere, who switch between stills and video without missing a beat, who want the look only a full-frame DSLR can achieve and who love sharing their shots, the D750 is the tool to unleash your artistry. ')";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed");

	//Inserts third record into the cameras table
	$query = "INSERT INTO cameras VALUES('ND850', 'Nikon', 'D850', 24.3, 51, 'FX', 'For those who find inspiration everywhere, who switch between stills and video without missing a beat, who want the look only a full-frame DSLR can achieve and who love sharing their shots, the D750 is the tool to unleash your artistry. ')";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed");



	//Creates the users table
	$query = "CREATE TABLE users (
		username VARCHAR(128) PRIMARY  KEY,
		email  VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL
	  )";
	//actually runs the query in the database
	$result = $conn->query($query);
		if ($conn->query($sql) === TRUE) {
			echo "Table users created successfully";
		} else {
			echo "Error creating table: " . $conn->error;
	}

	//Inserts record into the users table
	$query = "INSERT INTO users VALUES('user1', 'email@none.com', 'Password123')";
	$result = $conn->query($query);

	//closes the connections
	$result->close();
	$conn->close();
?>
	