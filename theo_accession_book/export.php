<?php
	
	$conn = mysqli_connect('localhost', 'root', '','theo_accession_book') or die('Connection Failed: ' . mysqli_error());
	$output = '';
	if (isset($_POST['btn_export'])) {
		$sql = "SELECT *  FROM accession_book";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if ($count > 0) {
				
			$output .= '<table class="table table-border">
						<tr>
							<th>Accession No</th>
							<th>Author</th>
							<th>Title</th>
							<th>Copyright</th>
							<th>Pages</th>
							<th>Publishers</th>
							<th>Grant, Gift or Purchase</th>
							<th>Price</th>
							<th>Donor</th>
						</tr>';
						while ($row = mysqli_fetch_array($res)) {
							
							$output .= '
							<tr>
								<td>'.htmlspecialchars($row['AccessionNo']).'</td>
								<td>'.htmlspecialchars($row['Author']).'</td>
								<td>'.htmlspecialchars($row['Title']).'</td>
								<td>'.htmlspecialchars($row['Copyright']).'</td>
								<td>'.htmlspecialchars($row['Pages']).'</td>
								<td>'.htmlspecialchars($row['Publishers']).'</td>
								<td>'.htmlspecialchars($row['Type']).'</td>
								<td>'.htmlspecialchars($row['Price']).'</td>
								<td>'.htmlspecialchars($row['Donor']).'</td>
							</tr>';
						}
						$output .= '</table>';
						header("Content-Type: application/xls");
						header("Content-Disposition: attachment; filename=accession_book.xls");
						echo $output;
			}
		}
?>