<?php
	$conn = mysqli_connect('localhost', 'root', '', 'theo_music_notes');
	$output = '';
	$view_details = mysqli_real_escape_string($conn, $_GET['view_details']);
	
	if (isset($_POST['btn_export_music_books'])) {
		$sql = "SELECT *  FROM music_book INNER JOIN music_book_num USING(MusicBookNumID) WHERE MusicBookNumID = '$view_details'";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if ($count > 0) {
			$output .= '<h1 class="text-center">Theology Library Music Pieces for 
			'.$view_details_row['MusicBookNumber'].'</h1>';
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
						header("Content-Disposition: attachment; filename=music_notes_for_".$view_details_row['MusicBookNumber'].".xls");
						echo $output;
			}
		}
?>