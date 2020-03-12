<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); 
	$conn = mysqli_connect('localhost', 'root', '', 'theo_accession_book');
		$select_sql = mysqli_query($conn, "SELECT AccessionBookID FROM accession_book");
		$select_count = mysqli_num_rows($select_sql);
	?>
</head>
<body class="cyan lighten-5">
	<?php include('include/navbar.php'); ?>
		<div class="page-header">
			<h1 class="text-center">Theology Library Accession Book Profiling</h1>
		</div>
		<hr>
			<ul class="nav nav-tabs md-tabs nav-justified">
				 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#addBooks" role="tab"><span class="fa fa-plus"></span> Add Accession Books</a>
            	 </li>
            	 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#viewBooks" role="tab"><span class="fa fa-eye"></span> View Accession Books</a>
            	 </li>
			</ul>
			<div class="tab-content card">
				<div class="tab-pane fade in show active" id="addBooks" role="tabpanel">
				<h1 class="text-center">You inserted <span class="badge badge-primary"><?php echo $select_count; ?></span> books</h1>
				<form method="post">
				<div class="row">
                    <div class="md-form col-6">
                        <i class="fa fa-hashtag prefix dark-text"></i>
                        <input type="text" name="accession_no" id="accession_no" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="accession_no">Accession Number</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="author" id="author" required>
                    	<label data-error="wrong" data-success="right" for="author">Author</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-header prefix dark-text"></i>
                    	<input type="text" name="title" id="title" required>
                    	<label>Title</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-copyright prefix dark-text"></i>
                    	<input type="text" name="copyright" id="copyright" required>
                    	<label data-error="wrong" data-success="right" for="copyright">Copyright</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-hashtag prefix dark-text"></i>
                    	<input type="text" name="pages" id="author" required>
                    	<label data-error="wrong" data-success="right" for="pages">Pages</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-users prefix dark-text"></i>
                    	<input type="text" name="publisher" id="author" required>
                    	<label data-error="wrong" data-success="right" for="publisher">Publishers</label>
                    </div>
                    <div class="md-form col-6">
                    	<select class="browser-default custom-select" name="type">
  							<option selected>Grant/Gift/Purchase</option>
  							<option value="Grant">Grant</option>
  							<option value="Gift">Gift</option>
  							<option value="Purchase">Purchase</option>
						</select>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-money prefix dark-text"></i>
                    	<input type="text" name="price" id="price">
                    	<label data-error="wrong" data-success="right" for="price">Price</label>
                    </div>
                    <div class="md-form col-5">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="donor" id="donor">
                    	<label data-error="wrong" data-success="right" for="donor">Donor</label>
                    </div>
                    <!--<div class="md-form col-6">
                    	<i class="fa fa-info-circle prefix dark-text"></i>
                    	<input type="text" name="status" id="status">
                    	<label data-error="wrong" data-success="right" for="status">Status</label>
                    </div> -->
                    	<div class="md-form col-6">
                    		<button type="submit" class="btn btn-success" name="add_book" id="add_book"><span class="fa fa-plus"></span> Add</button>
                    	</div>
                    </div>
                </form>
            </div>
    <div class="tab-pane fade" id="viewBooks">
    	<form method="get">
				<div class="form-group col-md-9">
					<div class="input-group">
						<input class="form-control" type="search" id="myInput" onkeyup="myFunction()" name="book_search" placeholder="Search">
							<button class="btn btn-default" type="submit" name="btn_search"><span class="fa fa-search icon"></span> Search</button>
					</div>
				</div>
			</form>
			<form method="post" action="export.php">
				<button class="btn btn-primary" type="submit" name="btn_export"><span class="fa fa-cloud-download"></span> Export</button>
			</form>
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<!--<button class="btn blue-gradient" onclick="window.print()"><span class="fa fa-print"></span> Print</button> -->
				<thead class="thead-dark">
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
						<!--<th>Status</th>
						<th>Date of Withdraw</th> -->
						<th class="text-center" colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$conn = mysqli_connect('localhost', 'root', '','theo_accession_book') or die('Connection Failed: ' . mysqli_error());

						if(isset($_GET['btn_search'])){

							$search = mysqli_real_escape_string($conn, $_GET['book_search']);
							$search_sql = mysqli_query($conn, 
								"SELECT * FROM accession_book 
									WHERE AccessionNo LIKE '%$search%' 
									OR Author LIKE '%$search%'
									OR Title LIKE '%$search%'
									OR Donor LIKE '%$search%'
									OR Publishers LIKE '%$search%'");
							$count = mysqli_num_rows($search_sql);

							if ($count > 0) {
								while ($search_row = mysqli_fetch_assoc($search_sql)) {
									echo "<tr><td>".htmlspecialchars($search_row['AccessionNo'])."</td>";
									echo "<td>".htmlspecialchars($search_row['Author'])."</td>";
									echo "<td>".htmlspecialchars($search_row['Title'])."</td>";
									echo "<td>".htmlspecialchars($search_row['Copyright'])."</td>";
									echo "<td>".htmlspecialchars($search_row['Pages'])."</td>";
									echo "<td>".htmlspecialchars($search_row['Publishers'])."</td>";
									echo "<td>".htmlspecialchars($search_row['Type'])."</td></tr>";
									echo "<td>".htmlspecialchars($search_row['Price'])."</td>";
									echo "<td>".htmlspecialchars($search_row['Donor'])."</td>";
									echo "<td><a class='btn btn-primary' href='edit_book.php?edit=".$search_row['AccessionBookID']."></a></td>";
									echo "<td <a class='btn btn-primary' href='actions.php?delete=".$search_row['AccessionBookID']."></a></td></tr>";
								}
								echo "
								<div class='card green lighten-3'>
                      				<div class='card-body text-center'>
                        			<h1 class='card-title'><span class='fa fa-check'></span>".$count." results found</h1>
                      				</div>
                    			</div>";
							} else {
							echo "<tr><td colspan='11'>
							<div class='card amber lighten-2'>
                      			<div class='card-body text-center'>
                        			<h1 class='card-title'><span class='fa fa-warning'></span> Keyword '$search' was not found</h1>
                      			</div>
                    		</div>";
                    	}
					} else { ?>
							<?php
							$viewbook_sql = mysqli_query($conn, "SELECT * FROM accession_book");
							$view_count = mysqli_num_rows($viewbook_sql);

							if ($view_count > 0) {
								while ($view_row = mysqli_fetch_assoc($viewbook_sql)) {
									?>
									<tr>
										<td style="font-size: 25px;" class="font-weight-bold"><?php echo $view_row['AccessionNo']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Author']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Title']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Copyright']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Pages']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Publishers']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Type']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Price']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Donor']; ?></td>
										<td><a class="btn btn-primary" href="edit_book.php?edit=<?php echo $view_row['AccessionBookID']; ?>"><span class="fa fa-edit"></span> Edit</a></td>
										<td><a class="btn btn-danger" onclick="return confirm('<?php echo $view_row['AccessionNo'] ?>, Delete this book?')" href="actions.php?delete=<?php echo $view_row['AccessionBookID']; ?>"><span class="fa fa-trash"></span> Delete</a></td>
									</tr>
							<?php } ?>
						<?php	} else {
							echo "<tr><td colspan='11'>
							<div class='card amber lighten-2'>
                      			<div class='card-body text-center'>
                        			<h1 class='card-title'><span class='fa fa-warning'></span> No Books Found</h1>
                      			</div>
                    		</div>
                  			</td></tr>";
						}
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include('include/script.php'); ?>
<script>

new WOW.init();

function myFunction() {
  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[2];//Book Name
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[j].style.display = "";
      			} else {
        		tr[j].style.display = "none";
      		}
    	}       
  	}
}
</script>
<?php

	if (isset($_POST['add_book'])) {
		
		$accession_no = mysqli_real_escape_string($conn, $_POST['accession_no']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$pages = mysqli_real_escape_string($conn, $_POST['pages']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);
		$donor = mysqli_real_escape_string($conn, $_POST['donor']);
		//$date = "";
		$accession_no_sql = mysqli_query($conn, "SELECT * FROM accession_book WHERE AccessionNo = '$accession_no'");
		if (mysqli_num_rows($accession_no_sql) > 0) {
			echo "<script>
				alert('Accession Number is already existing');
				window.open('index.php', _self);
			</script>";
		}
		else {
			$add_book_sql = "INSERT INTO accession_book(AccessionNo, Author, Title, Copyright, 
				Pages, Publishers, Type, Price, Donor)
				VALUES
				('$accession_no', '$author', '$title', '$copyright', '$pages', '$publisher', '$type', '$price', '$donor')";

			if (mysqli_query($conn, $add_book_sql)) {
				echo "<script>
					alert('Added a Book successfully');
				</script>
				<meta http-equiv='refresh' content='0; url=index.php'>";
			}
			else {
				echo "<script>
					alert('Error in adding');
				</script>";
			}
		}
	}
?>
</body>
</html>