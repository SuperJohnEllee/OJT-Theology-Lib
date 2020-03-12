<?php
	if($_POST["action"] == "add_books") {
		
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);
		$request_by = mysqli_real_escape_string($conn, $_POST['request_by']);
		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$dealer = mysqli_real_escape_string($conn, $_POST['dealer']);
		$deliv_rec_no = mysqli_real_escape_string($conn, $_POST['deliv_rec_no']);
		$conn = mysqli_connect('localhost', 'root', 
			'', 'university_acquisition');

		$insert_query = mysqli_query($conn, "INSERT INTO univ_acquisition(Author, Title, Copyright, Price, RequestedBy, Department, Dealer, DeliveryReceiptNo)
			VALUES('$author', '$title', '$copyright', '$price', '$request_by', '$department', '$dealer', '$deliv_rec_no')");


		if ($insert_query) {
			echo "2";
		}
		else{
			echo "1";
		}
	}
?>