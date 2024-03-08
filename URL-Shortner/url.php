<?php
    require "./conn.php";

	// fetch and redirect to the URL
	if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $select = $conn->query("SELECT * FROM urls WHERE id=$id");
        $select->execute();
        $tuple = $select->fetch(PDO::FETCH_OBJ);

        header("location: ".$tuple->url);
	}

?>
