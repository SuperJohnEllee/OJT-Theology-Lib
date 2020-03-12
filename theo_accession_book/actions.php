<?php
	$conn = mysqli_connect('localhost', 'root', '','theo_accession_book') or die('Connection Failed: ' . mysqli_error());
	date_default_timezone_set('Asia/Manila');

	if (isset($_GET['withdraw'])) {
		
		$withdraw = htmlspecialchars($_GET['withdraw']);
		$withdraw_sql = mysqli_query($conn, "UPDATE accession_book SET BookStatus = 'Withdraw', DateWithdraw = NOW() WHERE AccessionBookID = '$withdraw'");
		echo "<script>
			alert('Successfully withdraw a book');
		</script>
		<meta http-equiv='refresh' content='0; url=index.php'>";
	}

	if (isset($_GET['delete'])) {

		$delete = htmlspecialchars($_GET['delete']);
		$delete_sql = mysqli_query($conn, "DELETE FROM accession_book WHERE AccessionBookID = '$delete'");
		echo "<script>
					alert('Successfully deleted a book');
			</script>
		<meta http-equiv='refresh' content='0; url=index.php'>";
	}
?>