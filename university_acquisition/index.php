<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); 
		$conn = mysqli_connect('localhost', 'root', '', 'university_acquisition');
		$select_sql = mysqli_query($conn, "SELECT AcquisitionID FROM univ_acquisition");
		$select_count = mysqli_num_rows($select_sql);
	?>
</head>
<body class="yellow lighten-4">
	<div class="modal fade" id="exportBooksModal" tabindex="-1" role="dialog" aria-labelledby="delete_label" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-center" id="delete_label">EXPORT IN EXCEL</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      		<div class="modal-body">
        		<h1 class="text-center">EXPORT ALL BOOKS?</h1>
     	 	</div>
      <div class="modal-footer">
      	<form method="post" action="export.php">
			<button class="btn btn-default" type="submit" name="btn_export"><span class="fa fa-cloud-download"></span> SUBMIT</button>
		</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
      </div>
    </div>
  </div>
</div>
	<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="delete_label" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-center" id="delete_label">Success</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      		<div class="modal-body">
        		<h1 class="text-center">Successfully Added a book</h1>
     	 	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
      </div>
    </div>
  </div>
</div>
	<div class="modal fade" id="fail" tabindex="-1" role="dialog" aria-labelledby="delete_label" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-center" id="delete_label">Error</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      		<div class="modal-body">
        		<h1 class="text-center">Error in Adding</h1>
     	 	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="importBooksModal" tabindex="-1" role="dialog" aria-labelledby="delete_label" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-center" id="delete_label">UPLOAD EXCEL FILE</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body">
      				<form action="import.php" method="post" enctype="multipart/form-data">
            			<div class="row">
                			<input class="form-control col-lg-10" type="file" name="file" required>
                 			<button class="btn btn-primary" type="submit" name="btn_import"><span class="fa fa-cloud-upload"></span> Import</button>
           					</div>
        			</form>
      			</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-close"></span> Close</button>
      </div>
    </div>
  </div>
</div>
	<?php include('include/navbar.php'); ?>
	<div class="page-header">
		<h1 class="text-center">University Acquisition(Unpaid Books)</h1>
	</div>
	<hr>
	<ul class="nav nav-tabs blue-gradient md-tabs nav-justified">
		<li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#addBooks" role="tab"><span class="fa fa-plus"></span> Add Unpaid Books</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#viewBooks" role="tab"><span class="fa fa-eye"></span> View Unpaid Books</a>
        </li>
	</ul>
	<div class="tab-content card">
		<div class="tab-pane fade in show active" id="addBooks" role="tabpanel">
			<h1 class="text-center">You inserted <?php echo $select_count; ?> books</h1>
			<form method="post">
				<div class="row">
                    <div class="md-form col-6">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="author" id="author">
                    	<label data-error="wrong" data-success="right" for="author">Author</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-header prefix dark-text"></i>
                    	<input type="text" name="title" id="title" required>
                    	<label>Title</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-copyright prefix dark-text"></i>
                    	<input type="text" name="copyright" id="copyright">
                    	<label data-error="wrong" data-success="right" for="copyright">Copyright</label>
                    </div>
                     <div class="md-form col-6">
                    	<i class="fa fa-dollar prefix dark-text"></i>
                    	<input type="text" name="price" id="price">
                    	<label data-error="wrong" data-success="right" for="price">Price</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="request_by" id="request_by" required>
                    	<label data-error="wrong" data-success="right" for="request_by">Requested By</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-building prefix dark-text"></i>
                    	<input type="text" name="department" id="department" required>
                    	<label data-error="wrong" data-success="right" for="publisher">Department</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="dealer" id="dealer" required>
                    	<label data-error="wrong" data-success="right" for="dealer">Dealer</label>
                    </div>
                    <div class="md-form col-5">
                    	<i class="fa fa-file prefix dark-text"></i>
                    	<input type="text" name="deliv_rec_no" id="deliv_rec_no" required>
                    	<label data-error="wrong" data-success="right" for="deliv_rec_no">Delivery Receipt Number</label>
                    </div>
                    <div class="md-form col-12">
                    	<button style="margin-left: auto; margin-right: auto; display: block; width: 30%;" type="submit" class="btn btn-success" name="add_books" id="add_books"><span class="fa fa-plus"></span> Add</button>
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
        	<a class="btn btn-default" data-toggle="modal" data-target="#exportBooksModal"><span class="fa fa-cloud-download"></span> Export</a>
        	<!--<a class="btn btn-primary" data-toggle="modal" data-target="#importBooksModal"><span class="fa fa-cloud-upload"></span> Import</a> -->
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<!--<button class="btn blue-gradient" onclick="window.print()"><span class="fa fa-print"></span> Print</button> -->
				<thead class="thead-dark">
					<tr>
						<th>Author</th>
						<th>Title</th>
						<th>Copyright</th>
						<th>Price</th>
						<th>Requested By</th>
						<th>Department</th>
						<th>Dealer</th>
						<th>Delivery Receipt No</th>
						<th class="text-center" colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$conn = mysqli_connect('localhost', 'root', '','university_acquisition') or die('Connection Failed: ' . mysqli_error());

						if(isset($_GET['btn_search'])){

							$search = mysqli_real_escape_string($conn, $_GET['book_search']);
							$search_sql = mysqli_query($conn, 
								"SELECT * FROM univ_acquisition 
									WHERE Author LIKE '%$search%'
									OR Title LIKE '%$search%'
									OR Dealer LIKE '%$search%'
									OR DeliveryReceiptNo LIKE '%$search%'
									OR RequestedBy LIKE '%$search%'");
							$count = mysqli_num_rows($search_sql);

							if ($count > 0) {
								while ($search_row = mysqli_fetch_assoc($search_sql)) {
                  ?>
									<tr>
                    <td><?php echo $search_row['Author'] ?></td>
									 <td><?php echo $search_row['Title'] ?></td>
									 <td><?php echo $search_row['Copyright'] ?></td>
									 <td><?php echo $search_row['Price'] ?></td>
									 <td><?php echo $search_row['RequestedBy'] ?></td>
									 <td><?php echo $search_row['Department'] ?></td>
									 <td><?php echo $search_row['Dealer'] ?></td>
									 <td><?php echo $search_row['DeliveryReceiptNo'] ?></td>
									 <td><a class='btn btn-primary' href='edit_book.php?edit=<?php echo $search_row['AcquisitionID'] ?>'><span class="fa fa-edit"></span> Edit</a></td>
									 <td><a class='btn btn-danger' href='actions.php?delete=<?php echo $search_row['AcquisitionID'] ?>'><span class="fa fa-trash"></span> Delete</a></td>
                </tr>
						  <?php
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
							$viewbook_sql = mysqli_query($conn, "SELECT * FROM univ_acquisition");
							$view_count = mysqli_num_rows($viewbook_sql);

							if ($view_count > 0) {
								while ($view_row = mysqli_fetch_assoc($viewbook_sql)) {
									?>
									<tr>
										<td class="font-weight-bold"><?php echo $view_row['Author']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Title']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Copyright']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Price']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['RequestedBy']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Department']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Dealer']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['DeliveryReceiptNo']; ?></td>
										<td><a class="btn btn-primary" href="edit_book.php?edit=<?php echo $view_row['AcquisitionID']; ?>"><span class="fa fa-edit"></span> Edit</a></td>
										<td><a class="btn btn-danger" onclick="return confirm('Delete this book?')" href="actions.php?delete=<?php echo $view_row['AcquisitionID']; ?>"><span class="fa fa-trash"></span> Delete</a></td>
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
   /* $(document).on("click", '.btn-success', function(){
    
        var author = document.getElementById('author').value;
        var title = document.getElementById('title').value;
        var copyright = document.getElementById('copyright').value;
        var price = document.getElementById('price').value;
        var request_by = document.getElementById('request_by').value;
        var department = document.getElementById('department').value;
        var deliv_rec_no = document.getElementById('deliv_rec_no').value;

        $.ajax({
            type:"POST",
            url:"ajax.php",
            data:{
              author:author,
              title:title,
              copyright:copyright,
              price:price,
              request_by:request_by,
              department:department,
              deliv_rec_no:deliv_rec_no,
              ''
            },
        }).then(function(data){
            if (data = '1') {
                $('#fail').modal({
                  show:'true'
                });
            } else {
              $('#success').modal({
                show:'true'
              });
            }
        });  
    });
    $(document).on("click", ".modal-closer", function() { 
      location.reload();
    });  */
</script>
<?php

	$conn = mysqli_connect('localhost', 'root', '', 'university_acquisition');

	if (isset($_POST['add_books'])) {
		
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);
		$request_by = mysqli_real_escape_string($conn, $_POST['request_by']);
		$department = mysqli_real_escape_string($conn, $_POST['department']);
		$dealer = mysqli_real_escape_string($conn, $_POST['dealer']);
		$deliv_rec_no = mysqli_real_escape_string($conn, $_POST['deliv_rec_no']);

		$insert_query = mysqli_query($conn, "INSERT INTO univ_acquisition(Author, Title, Copyright, Price, RequestedBy, Department, Dealer, DeliveryReceiptNo)
			VALUES('$author', '$title', '$copyright', '$price', '$request_by', '$department', '$dealer', '$deliv_rec_no')");


		if ($insert_query) {
			echo "<script>
				alert('Added a data success');
			</script>
			<meta http-equiv='refresh' content='0; url=index.php'>";
		}
		else{
			echo "<script>
				alert('Error in adding');
			</script>";
		}
	}
?>
<script>



function myFunction() {
  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[1];//Book Name
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
</body>
</html>