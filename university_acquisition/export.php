<?php
	
	$conn = mysqli_connect('localhost', 'root', '', 'university_acquisition');
	$output = '';
	if (isset($_POST['btn_export'])) {
		$sql = "SELECT * FROM univ_acquisition ORDER BY AcquisitionID DESC";
		$res = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($res);
		if ($count > 0) {
				
			$output .= '<table class="table table-border">
						<tr>
							<th>Author</th>
							<th>Title</th>
							<th>Copyright</th>
							<th>Price</th>
							<th>Requested By</th>
							<th>Department</th>
							<th>Dealer</th>
							<th>Delivery Receipt No</th>
						</tr>';
						while ($row = mysqli_fetch_array($res)) {
							
							$output .= '
							<tr>
								<td>'.htmlspecialchars($row['Author']).'</td>
								<td>'.htmlspecialchars($row['Title']).'</td>
								<td>'.htmlspecialchars($row['Copyright']).'</td>
								<td>'.htmlspecialchars($row['Price']).'</td>
								<td>'.htmlspecialchars($row['RequestedBy']).'</td>
								<td>'.htmlspecialchars($row['Department']).'</td>
								<td>'.htmlspecialchars($row['Dealer']).'</td>
								<td>'.htmlspecialchars($row['DeliveryReceiptNo']).'</td>
							</tr>';
						}
						$output .= '</table>';
						header("Content-Type: application/xls");
						header("Content-Disposition: attachment; filename=university_aquisition_books(unpaid).xls");
						echo $output;
			}
		}
?>