<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); 
	$conn = mysqli_connect('localhost', 'root', '', 'theo_music_notes');
		$select_sql = mysqli_query($conn, "SELECT MusicNotesID FROM music_notes");
		$select_count = mysqli_num_rows($select_sql);

	?>
</head>
<body class="yellow lighten-3">
	<?php include('include/navbar.php'); ?>
	<?php include('include/modals/exportMusicPieceModal.php'); ?>
		<div class="modal fade" id="editMusicDetailsModal" tabindex="-1" role="dialog" aria-labelledby="delete_label" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-center" id="delete_label">Edit Music Number</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      		<div class="modal-body">
        		<form method="post">
        			<input class="form-control" type="text" name="txtMusicIDUpdate" id="txtMusicIDUpdate" disabled>
        			 <div class="md-form">
                        <i class="fa fa-hashtag prefix dark-text"></i>
                        <input type="text" name="txtAccessionNoUpdate" id="txtAccessionNoUpdate" class="form-control" required>
                    </div>
                	<div class="md-form">
                 		<i class="fa fa-header prefix"></i>
                  		<input class="form-control" type="text" name="txtTitleUpdate" id="txtTitleUpdate">
                	</div>
                	<div class="md-form">
                 		<i class="fa fa-copyright prefix"></i>
                  		<input class="form-control" type="text" name="txtCopyrightUpdate" id="txtCopyrightUpdate">
                	</div>
                	<div class="md-form">
                 		<i class="fa fa-users prefix"></i>
                  		<input class="form-control" type="text" name="txtPublisherUpdate" id="txtPublisherUpdate">
                	</div>
                <button type="submit" class="btn btn-success" name="edit_music_notes"><span class="fa fa-save"></span> Save</button>   
            </form>
     	 	</div>
    </div>
  </div>
</div>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center">Theology Library Music Pieces</h1>
		</div>
		<hr>
			<ul class="nav nav-tabs blue-gradient md-tabs nav-justified">
				 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#addMusicNotes" role="tab"><span class="fa fa-plus"></span> Add Music Pieces</a>
            	 </li>
            	 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#viewMusicNotes" role="tab"><span class="fa fa-eye"></span> View Music Pieces</a>
            	 </li>
            	  <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#borrowedMusicPieces" role="tab"><span class="fa fa-eye"></span> View Borrowed Music Pieces</a>
            	 </li>
            	 <li class="nav-item">
            	 	<a class="nav-link" data-toggle="tab" href="#returnedMusicPieces" role="tab"><span class="fa fa-eye"></span> View Returned Music Pieces</a>
            	 </li>
			</ul>
			<div class="tab-content card">
				<div class="tab-pane fade in show active" id="addMusicNotes" role="tabpanel">
				<h1 class="text-center">Number of Music Pieces: <span class="badge badge-primary"><?php echo $select_count; ?></span></h1>
				<form method="post">
				<div class="row">
                    <div class="md-form col-6">
                        <i class="fa fa-hashtag prefix dark-text"></i>
                        <input type="text" name="accession_no" id="accession_no" class="form-control" required>
                        <label data-error="wrong" data-success="right" for="accession_no">Accession Number</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-header prefix dark-text"></i>
                    	<input type="text" name="title" id="title" required>
                    	<label data-error="wrong" data-success="right" for="title">Title</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-copyright prefix dark-text"></i>
                    	<input type="text" name="copyright" id="copyright">
                    	<label data-error="wrong" data-success="right" for="copyright">Copyright</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-users prefix dark-text"></i>
                    	<input type="text" name="publisher" id="publisher" required>
                    	<label data-error="wrong" data-success="right" for="publisher">Publishers</label>
                    </div>
                    	<div class="md-form col-12">
                    		<button style="margin-left: auto; margin-right: auto; display: block; width: 30%;" type="submit" class="btn btn-success" name="add_music_notes" id="add_music_notes"><span class="fa fa-plus"></span> Add</button>
                    	</div>
                    </div>
                </form>
            </div>
    <div class="tab-pane fade" id="viewMusicNotes">
    	<h3>Filter Search for Title</h3>
    	<form method="get">
				<div class="form-group col-md-9">
					<div class="input-group">
						<input class="form-control" type="search" id="myInput" onkeyup="myFunction()" name="book_search" placeholder="Search">
							<button class="btn btn-default" type="submit" name="btn_search"><span class="fa fa-search icon"></span> Search</button>
					</div>
				</div>
			</form>
		<a class="btn btn-default" data-toggle="modal" data-target="#exportMusicPieceModal"><span class="fa fa-cloud-download"></span> Export</a>
		<div class="table-responsive">
			<table class="table table-hover" id="myTable">
				<!--<button class="btn blue-gradient" onclick="window.print()"><span class="fa fa-print"></span> Print</button> -->
				<thead class="thead-dark">
					<tr>
						<th>Accession No</th>
						<th>Title</th>
						<th>Publishers</th>
						<th>Copyright</th>
						<th class="text-center" colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$conn = mysqli_connect('localhost', 'root', '','theo_music_notes');

						if(isset($_GET['btn_search'])){

							$search = mysqli_real_escape_string($conn, $_GET['book_search']);
							$search_sql = mysqli_query($conn, 
								"SELECT * FROM music_notes 
									WHERE AccessionNo LIKE '%$search%' 
									OR Title LIKE '%$search%'
									OR Publisher LIKE '%$search%'");
							$count = mysqli_num_rows($search_sql);

							if ($count > 0) {
								while ($search_row = mysqli_fetch_assoc($search_sql)) {
								?>
									<tr>
										<td style="font-size: 25px;" class="font-weight-bold"><?php echo $search_row['AccessionNo']; ?></td>
										<td class="font-weight-bold"><?php echo $search_row['Title']; ?></td>
										<td class="font-weight-bold"><?php echo $search_row['Publisher']; ?></td>
										<td class="font-weight-bold"><?php echo $search_row['Copyright']; ?></td>
										<td><a class="btn btn-default" onclick="return confirm('Borrow this book?');" href="borrow-music-piece.php?borrow=<?php echo $search_row['MusicNotesID']; ?>"><span class="fa fa-check"></span> Borrow</a></td>
										<td><a class="btn btn-primary" href="edit_music_notes.php?edit=<?php echo $search_row['MusicNotesID']; ?>"><span class="fa fa-edit"></span> Edit</a></td>
										<td><a class="btn btn-danger" onclick="return confirm('<?php echo $search_row['AccessionNo'] ?>, Delete this book?')" href="actions.php?delete=<?php echo $search_row['MusicNotesID']; ?>"><span class="fa fa-trash"></span> Delete</a></td>
									</tr>
							<?php	}
								echo "<div class='card light-green accent-3'>
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
                    		</div></td></tr>";
                    	}
					} else { ?>
							<?php
								
							$viewbook_sql = mysqli_query($conn, "SELECT * FROM music_notes ORDER BY MusicNotesID DESC");
							$view_count = mysqli_num_rows($viewbook_sql);

							if ($view_count > 0) {
								while ($view_row = mysqli_fetch_assoc($viewbook_sql)) {
									?>
									<tr>
										<td style="font-size: 25px;" class="font-weight-bold"><?php echo $view_row['AccessionNo']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Title']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Publisher']; ?></td>
										<td class="font-weight-bold"><?php echo $view_row['Copyright']; ?></td>
										<td><a class="btn btn-default" onclick="return confirm('Borrow this book?');" href="borrow-music-piece.php?borrow=<?php echo $view_row['MusicNotesID']; ?>"><span class="fa fa-check"></span> Borrow</a></td>
										<td><a class="btn btn-primary" href="edit_music_notes.php?edit=<?php echo $view_row['MusicNotesID'] ?>"><span class="fa fa-edit"></span> Edit</a></td>
										<td><a class="btn btn-danger" onclick="return confirm('<?php echo $view_row['AccessionNo'] ?>, Delete this book?')" href="actions.php?delete=<?php echo $view_row['MusicNotesID']; ?>"><span class="fa fa-trash"></span> Delete</a></td>
									</tr>
							<?php } ?>
						<?php	} else {
							echo "<tr><td colspan='11'>
							<div class='card amber lighten-2'>
                      			<div class='card-body text-center'>
                        			<h1 class='card-title'><span class='fa fa-warning'></span> No Music Notes Found <span class='fa fa-music'></span></h1>
                      			</div>
                    		</div>
                  			</td></tr>";
						}
					} ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="tab-pane fade" id="borrowedMusicPieces" role="tabpanel">
			<h3>Filter Search for Title</h3>
			<form method="get">
				<div class="form-group col-md-9">
					<div class="input-group">
						<input class="form-control" type="search" id="txtBorrow" onkeyup="borrowed()" name="txtBorrow" placeholder="Search">
						<button class="btn btn-default" type="submit" name="btn_search"><span class="fa fa-search icon"></span> Search</button>
					</div>
				</div>
			</form>
		<div class="table-responsive">
			<table class="table table-hover" id="borrowTable">
				<thead class="thead-dark">
					<tr>
						<th>Accession No</th>
						<th>Title</th>
						<th>Publishers</th>
						<th>Copyright</th>
						<th>Status</th>
						<th>Borrowed By</th>
						<th>Date Borrowed</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$view_borrowed = mysqli_query($conn, "SELECT * FROM transaction INNER JOIN music_notes USING(MusicNotesID) WHERE Status = 'Borrowed'");
					$borrowed_count = mysqli_num_rows($view_borrowed);
						if($borrowed_count > 0) {
							while ($borrowed_row = mysqli_fetch_assoc($view_borrowed)) {
								?>
								<tr>
									<td style="font-size: 25px;" class="font-weight-bold"><?php echo $borrowed_row['AccessionNo']; ?></td>
									<td class="font-weight-bold"><?php echo $borrowed_row['Title']; ?></td>
									<td class="font-weight-bold"><?php echo $borrowed_row['Publisher']; ?></td>
									<td class="font-weight-bold"><?php echo $borrowed_row['Copyright']; ?></td>
									<td class="font-weight-bold text-success"><?php echo $borrowed_row['Status']; ?></td>
									<td class="font-weight-bold text-primary"><?php echo $borrowed_row['Name']; ?></td>
									<td class="font-weight-bold text-warning"><?php echo date('F j ,Y - g:i A',(strtotime($borrowed_row['TransDate']))); ?></td>
									<td><a class="btn btn-default" onclick="return confirm('Return this borrowed music piece?')" href="actions.php?return=<?php echo $borrowed_row['TransID'] ?>"><span class="fa fa-reply"></span> Return</a></td>
								</tr>
						<?php	}
						 } else {
							echo "<tr><td colspan='11'>
							<div class='card amber lighten-2'>
                      			<div class='card-body text-center'>
                        			<h1 class='card-title'><span class='fa fa-warning'></span> No Music Notes Found <span class='fa fa-music'></span></h1>
                      			</div>
                    		</div>
                  			</td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
		<div class="tab-pane fade" id="returnedMusicPieces" role="tabpanel">	
			<h3>Filter Search for Title</h3>
			<form method="get">
				<div class="form-group col-md-9">
					<div class="input-group">
						<input class="form-control" type="search" id="txtReturn" onkeyup="returned()" name="txtReturn" placeholder="Search">
							<button class="btn btn-default" type="submit" name="btn_search"><span class="fa fa-search icon"></span> Search</button>
					</div>
				</div>
			</form>
		<div class="table-responsive">
			<table class="table table-hover" id="returnTable">
				<thead class="thead-dark">
					<tr>
						<th>Accession No</th>
						<th>Title</th>
						<th>Publishers</th>
						<th>Copyright</th>
						<th>Status</th>
						<th>Borrowed By</th>
						<th>Date Borrowed</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$view_borrowed = mysqli_query($conn, "SELECT * FROM transaction INNER JOIN music_notes USING(MusicNotesID) WHERE Status = 'Returned'");
					$borrowed_count = mysqli_num_rows($view_borrowed);
						if($borrowed_count > 0) {
							while ($borrowed_row = mysqli_fetch_assoc($view_borrowed)) {
								?>
								<tr>
									<td style="font-size: 25px;" class="font-weight-bold"><?php echo $borrowed_row['AccessionNo']; ?></td>
									<td class="font-weight-bold"><?php echo $borrowed_row['Title']; ?></td>
									<td class="font-weight-bold"><?php echo $borrowed_row['Publisher']; ?></td>
									<td class="font-weight-bold"><?php echo $borrowed_row['Copyright']; ?></td>
									<td class="font-weight-bold text-success"><?php echo $borrowed_row['Status']; ?></td>
									<td class="font-weight-bold text-primary"><?php echo $borrowed_row['Name']; ?></td>
									<td class="font-weight-bold text-warning"><?php echo date('F j ,Y - g:i A',(strtotime($borrowed_row['TransDate']))); ?></td>
								</tr>
						<?php	}
						 } else {
							echo "<tr><td colspan='11'>
							<div class='card amber lighten-2'>
                      			<div class='card-body text-center'>
                        			<h1 class='card-title'><span class='fa fa-warning'></span> No Music Notes Found <span class='fa fa-music'></span></h1>
                      			</div>
                    		</div>
                  			</td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<?php include('include/script.php'); ?>
<script>

  var table = document.getElementById('myTable'), rIndex;

      for (var i = 0; i < table.rows.length; i++){
        table.rows[i].onclick = function(){
            rIndex = this.rIndex;
            document.getElementById('txtMusicIDUpdate').value = this.cells[0].innerHTML;
            document.getElementById('txtAccessionNoUpdate').value = this.cells[1].innerHTML;
            document.getElementById('txtTitleUpdate').value = this.cells[2].innerHTML;
            document.getElementById('txtPublisherUpdate').value = this.cells[3].innerHTML;
             document.getElementById('txtCopyrightUpdate').value = this.cells[4].innerHTML;
        }
      }

	$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 700,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});


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

function borrowed() {
  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("txtBorrow");
  filter = input.value.toUpperCase();
  table = document.getElementById("borrowTable");
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

function returned(){

  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("txtReturn");
  filter = input.value.toUpperCase();
  table = document.getElementById("returnTable");
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
<?php

	if (isset($_POST['add_music_notes'])) {
		
		$accession_no = mysqli_real_escape_string($conn, $_POST['accession_no']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
		//$date = "";
		$accession_no_sql = mysqli_query($conn, "SELECT * FROM music_notes WHERE AccessionNo = '$accession_no'");
		if (mysqli_num_rows($accession_no_sql) > 0) {
			echo "<script>
				alert('Accession Number is already existing');
				window.open('index.php', _self);
			</script>";
		}
		else {
			$add_book_sql = "INSERT INTO music_notes(AccessionNo,Title, Copyright, Publisher)
				VALUES
				('$accession_no', '$title', '$copyright', '$publisher')";

			if (mysqli_query($conn, $add_book_sql)) {
				echo "<script>
					alert('Added a music piece successfully');
				</script>
				<meta http-equiv='refresh' content='0; url=music-piece-single.php'>";
			}
			else {
				echo "<script>
					alert('Error in adding');
				</script>";
			}
		}
	}

	if(isset($_POST['edit_music_notes'])) {

		$accession_no = mysqli_real_escape_string($conn, $_POST['txtAccessionNoUpdate']);
		$title = mysqli_real_escape_string($conn, $_POST['txtTitleUpdate']);
		$copyright = mysqli_real_escape_string($conn, $_POST['txtCopyrightUpdate']);
		$publisher = mysqli_real_escape_string($conn, $_POST['txtPublisherUpdate']);

		$edit_id = htmlspecialchars($_POST['txtMusicIDUpdate']);

		$edit_sql = mysqli_query($conn, "UPDATE music_notes SET AccessionNo = '$accession_no', Title = '$title', Copyright = '$copyright',  Publisher = '$publisher' WHERE MusicNotesID = '$edit_id'");

		if ($edit_sql) {
			echo "<script>
					alert('Updated a music piece successfully');
				</script>
				<meta http-equiv='refresh' content='0; url=music-piece-single.php'>";
		} else {
			echo "<script>
					alert('Error in editing');
				</script>";
		}
	}
?>
</body>
</html>