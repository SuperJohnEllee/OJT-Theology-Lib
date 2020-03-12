<?php
	$conn = mysqli_connect('localhost', 'root', '','theo_music_notes') or die('Connection Failed: ' . mysqli_error());
	date_default_timezone_set('Asia/Manila');

	//$view_details = htmlspecialchars($_GET['view_details']);

	if (isset($_GET['delete'])) {

		$delete = htmlspecialchars($_GET['delete']);
		$delete_sql = mysqli_query($conn, "DELETE FROM music_notes WHERE MusicNotesID = '$delete'");
		echo "<script>
					alert('Successfully deleted a music piece');
			</script>
		<meta http-equiv='refresh' content='0; url=music-piece-single.php'>";
	}

	if (isset($_GET['delete_music_details'])) {

		$delete_music_details = htmlspecialchars($_GET['delete_music_details']);
		$delete_music_details_sql = mysqli_query($conn, "DELETE FROM music_book WHERE MusicBookID = '$delete_music_details'");
		echo "<script>
					alert('Successfully deleted a music book details');
			</script>
		<meta http-equiv='refresh' content='0; url=music-book.php'>";
	}

	if (isset($_GET['delete_music_book_number'])) {
		
		$delete_music_book_number = htmlspecialchars($_GET['delete_music_book_number']);
		$delete_music_book_number_sql = mysqli_query($conn, "DELETE FROM music_book_num WHERE MusicBookNumID = '$delete_music_book_number'");
		echo "<script>
					alert('Successfully deleted a music book number');
			</script>
		<meta http-equiv='refresh' content='0; url=music-book.php'>";
	}

	if (isset($_GET['return'])) {
		
		$return = htmlspecialchars($_GET['return']);
		$return_sql = mysqli_query($conn, "UPDATE Transaction SET Status = 'Returned' WHERE TransID = '$return'");
		echo "<script>
			alert('Returned music piece');
		</script>
		<meta http-equiv='refresh' content='0; url=music-piece-single.php'>";
	}

	if (isset($_GET['export_music_book'])) {
		$output = '';
		$export_music_book = htmlspecialchars($_GET['export_music_book']);
		$export_music_book_sql = "SELECT * FROM music_book INNER JOIN music_book_num USING(MusicBookNumID) WHERE MusicBookNumID = '$export_music_book'";
		$res = mysqli_query($conn, $export_music_book_sql);
		$export_music_book_row = mysqli_fetch_assoc($res);
		$count = mysqli_num_rows($res);
		if ($count > 0) {

			$output .= '<table class="table table-border">
						<tr>
							<th>Title</th>
							<th>Publisher</th>
							<th>Copyright</th>
						</tr>';
						while ($row = mysqli_fetch_array($res)) {
							
							$output .= '
							<tr>
								<td>'.htmlspecialchars($row['Title']).'</td>
								<td>'.htmlspecialchars($row['Publisher']).'</td>
								<td>'.htmlspecialchars($row['Copyright']).'</td>
							</tr>';
						}
						$output .= '</table>';
						header("Content-Type: application/xls");
						header("Content-Disposition: attachment; filename=music_notes_for_".$export_music_book_row['MusicBookNumber'].".xls");
						echo $output;
			}
	}

?>