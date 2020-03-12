<?php
	$conn = mysqli_connect('localhost', 'root', '', 'university_acquisition');
	date_default_timezone_set('Asia/Manila');


	if (isset($_GET['delete'])) {

		$delete = htmlspecialchars($_GET['delete']);
		$delete_sql = mysqli_query($conn, "DELETE FROM univ_acquisition WHERE AcquisitionID = '$delete'");
		echo "<script>
					alert('Successfully deleted a book');
			</script>
		<meta http-equiv='refresh' content='0; url=index.php'>";
	}
?>