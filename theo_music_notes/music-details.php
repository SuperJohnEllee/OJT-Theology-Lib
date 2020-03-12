<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); ?>
	<?php
		$conn = mysqli_connect('localhost', 'root', '', 'theo_music_notes');

		$view_details = mysqli_real_escape_string($conn, $_GET['view_details']);
		$view_details_sql = mysqli_query($conn, "SELECT * FROM music_book_num WHERE MusicBookNumID = '$view_details'");
		$view_details_row = mysqli_fetch_assoc($view_details_sql);

		$sql_count_book = mysqli_query($conn, "SELECT MusicBookID FROM music_book INNER JOIN music_book_num USING(MusicBookNumID) WHERE MusicBookNumID = '$view_details'");
		$count_books = mysqli_num_rows($sql_count_book);
	?>
</head>
<body oncontextmenu="return false;" onselectstart="return false;" class="yellow lighten-4">
	<?php include('include/navbar.php'); ?>
	<?php include('include/modals/exportMusicBooksModal.php'); ?>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center">Music Piece for <span class="orange-text"><?php echo $view_details_row['MusicBookNumber']; ?></span></h1>
			<hr>
		</div>
		<ul class="nav nav-tabs blue-gradient md-tabs nav-justified">
			<li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#addMusicBook" role="tab"><span class="fa fa-plus"></span> Add Music Pieces</a>
            	 </li>
           	<li class="nav-item">
               	<a class="nav-link" data-toggle="tab" href="#viewMusicBook" role="tab"><span class="fa fa-eye"></span> View Music Pieces</a>
            </li>
		</ul>
		<div class="tab-content card">
			<div class="tab-pane fade in show active" id="addMusicBook" role="tabpanel">
			<h3>Add Music Pieces for <span class="orange-text"><?php echo $view_details_row['MusicBookNumber']; ?></span></h3>
			<form class="col-6" method="post">
            	<div class="md-form mb-4">
                	<i class="fa fa-header prefix dark-text"></i>
                	<input type="text" name="title" id="title" required>
                	<label data-error="wrong" data-success="right" for="title">Title</label>
            	</div>
            	<div class="md-form mb-4">
                	<i class="fa fa-copyright prefix dark-text"></i>
                	<input type="text" name="copyright" id="copyright">
                	<label data-error="wrong" data-success="right" for="copyright">Copyright</label>
            	</div>
            	<div class="md-form mb-4">
                	<i class="fa fa-users prefix dark-text"></i>
                	<input type="text" name="publisher" id="publisher" required>
                	<label data-error="wrong" data-success="right" for="publisher">Publishers</label>
            	</div>
            	<div class="md-form col-12">
                	<button style="margin-left: auto; margin-right: auto; display: block; width: 30%;" type="submit" class="btn btn-success" name="add_music_notes" id="add_music_notes"><span class="fa fa-plus"></span> Add</button>
            	</div>
        	</form>
    	</div>
    	<div class="tab-pane fade" id="viewMusicBook">
		<div class="table-responsive">
			<h2 class="font-weight-bold text-center">Number of Music Pieces: <span class="badge badge-primary"><?php echo $count_books; ?></span></h2>
			<a class="btn btn-success" data-toggle="modal" data-target="#exportMusicBooksModal"><span class="fa fa-cloud-download"></span> EXPORT</a>
			<table class="table table-hover" id="tblMusicBooks">
				<thead class="thead-dark">
					<tr>
						<th>Number</th>
						<th>Title</th>
						<th>Copyright</th>
						<th>Publisher</th>
						<th class="text-center" colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$view_books = mysqli_query($conn, "SELECT * FROM music_book INNER JOIN music_book_num USING(MusicBookNumID) WHERE MusicBookNumID = '$view_details' ORDER BY MusicBookID ASC");

						if (mysqli_num_rows($view_books) > 0) {
							$i = 1;
							while ($music_row = mysqli_fetch_assoc($view_books)) {
								?>
								<tr>
									<td class="font-weight-bold"><?php echo $i++; ?></td>
									<td class="font-weight-bold"><?php echo htmlspecialchars($music_row['Title']); ?></td>
									<td class="font-weight-bold"><?php echo htmlspecialchars($music_row['Copyright']); ?></td>
									<td class="font-weight-bold"><?php echo htmlspecialchars($music_row['Publisher']); ?></td>
									<td><a class="btn btn-primary" href="edit_book.php?edit_book=<?php echo $music_row['MusicBookID'] ?>"><span class="fa fa-edit"></span> Edit</a></td>
									<td><a class="btn btn-danger" onclick="return confirm('Delete this book details?');" href="actions.php?delete_music_details=<?php echo $music_row['MusicBookID'] ?>"><span class="fa fa-trash"></span> Delete</a></td>
								</tr>
					<?php	}
						} else {
							echo "<tr><td colspan='11'>
							<div class='card amber lighten-2'>
                      			<div class='card-body text-center'>
                        			<h1 class='card-title'><span class='fa fa-warning'></span> No Music Notes Details Found <span class='fa fa-music'></span></h1>
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
<script>
	var table = document.getElementById('tblMusicBooks'), rIndex;

      for (var i = 0; i < table.rows.length; i++){
        table.rows[i].onclick = function(){
            rIndex = this.rIndex;

            document.getElementById('txtMusicIDUpdate').value = this.cells[0].innerHTML;
            document.getElementById('txtTitleUpdate').value = this.cells[1].innerHTML;
            document.getElementById('txtCopyrightUpdate').value = this.cells[2].innerHTML;
            document.getElementById('txtPublisherUpdate').value = this.cells[3].innerHTML;
        }
      }
</script>
<?php include('include/script.php'); ?>
<?php 
	if (isset($_POST['add_music_notes'])) {

		
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);

		$music_book_id = htmlspecialchars($_GET['view_details']);

		$insert_query = mysqli_query($conn, "INSERT INTO music_book(MusicBookNumID, Title, Copyright, Publisher) VALUES('$music_book_id', '$title', 
		'$copyright', '$publisher')");

		if ($insert_query) {
			echo "<script>
				alert('Added a music book details');
			</script>
			<meta http-equiv='refresh' content='0; url=music-details.php?view_details=$view_details'>";
		} else {
			echo "<script>
				alert('Error in adding');
			</script>";
		}
	}

	if (isset($_POST['btn_save'])) {
		
		$saveTitle = mysqli_real_escape_string($conn, $_POST['txtTitleUpdate']);
		$saveCopyright = mysqli_real_escape_string($conn, $_POST['txtCopyrightUpdate']);
		$savePublisher = mysqli_real_escape_string($conn, $_POST['txtPublisherUpdate']);
		$saveMusicID = mysqli_real_escape_string($conn, $_POST['txtMusicIDUpdate']);

		$edit_sql = mysqli_query($conn, "UPDATE music_book SET Title = '".htmlspecialchars($saveTitle)."', 
						Copyright = '".htmlspecialchars($saveCopyright)."', 
						Publisher = '".htmlspecialchars($savePublisher)."' WHERE BookDetailsID = '".htmlspecialchars($saveMusicID)."'");

		if ($edit_sql) {
			echo "<script>
				alert('Successfully edit a music book details');
			</script>
			<meta http-equiv='refresh' content='0; url=add-music-details.php'>";
		} else {
			echo "<script>
				alert('Error in saving');
			</script>";
		}
	}

?>
</body>
</html>