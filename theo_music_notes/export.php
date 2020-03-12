<?php
	$conn = mysqli_connect('localhost', 'root', '','theo_music_notes') or die('Connection Failed: ' . mysqli_error());
	$output = '';
	if (isset($_POST['btn_export'])) {
		$sql = "SELECT *  FROM music_notes";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if ($count > 0) {
			$output .= '<h1 class="text-center">Theology Library Music Pieces</h1>';
			$output .= '<table class="table table-border">
						<tr>
							<th>Accession No</th>
							<th>Title</th>
							<th>Publisher</th>
							<th>Copyright</th>
						</tr>';
						while ($row = mysqli_fetch_array($res)) {
							
							$output .= '
							<tr>
								<td>'.htmlspecialchars($row['AccessionNo']).'</td>
								<td>'.htmlspecialchars($row['Title']).'</td>
								<td>'.htmlspecialchars($row['Publisher']).'</td>
								<td>'.htmlspecialchars($row['Copyright']).'</td>
							</tr>';
						}
						$output .= '</table>';
						header("Content-Type: application/xls");
						header("Content-Disposition: attachment; filename=music_notes.xls");
						echo $output;
			}
		}
?>