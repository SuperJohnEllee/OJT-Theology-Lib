<!DOCTYPE html>
<?php
	$conn = mysqli_connect('localhost', 'root', '','theo_music_notes') or die('Connection Failed: ' . mysqli_error());
	$edit = mysqli_real_escape_string($conn, $_GET['edit']);
	$sql = mysqli_query($conn, "SELECT * FROM music_notes WHERE MusicNotesID = '$edit'");
	$row = mysqli_fetch_assoc($sql);
?>
<html>
<head>
	<?php include('include/header.php'); ?>
</head>
<body>
	<?php include('include/navbar.php'); ?>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-edit"></span> Edit Accession Book</h1>
		</div>
		<h2>Edit Book for <span class="text-warning"><?php echo $row['AccessionNo']; ?></span></h2>
			<form method="post">
					<input type="hidden" name="edit_id" value="<?php echo $row['MusicNotesID']; ?>">
                    <div class="md-form col-7">
                        <i class="fa fa-hashtag prefix dark-text"></i>
                        <input type="text" name="accession_no" id="accession_no" class="form-control" value="<?php echo $row['AccessionNo'] ?>">
                        <label data-error="wrong" data-success="right" for="accession_no">Accession Number</label>
                    </div>
                    <div class="md-form mb-5 col-7">
                    	<i class="fa fa-header prefix dark-text"></i>
                    	<input type="text" name="title" id="title" value="<?php echo $row['Title'] ?>">
                    	<label>Title</label>
                    </div>
                    <div class="md-form mb-5 col-7">
                    	<i class="fa fa-copyright prefix dark-text"></i>
                    	<input type="text" name="copyright" id="copyright" value="<?php echo $row['Copyright'] ?>">
                    	<label data-error="wrong" data-success="right" for="copyright">Copyright</label>
                    </div>
                    <div class="md-form mb-5 col-7">
                    	<i class="fa fa-users prefix dark-text"></i>
                    	<input type="text" name="publisher" id="author" value="<?php echo $row['Publisher'] ?>">
                    	<label data-error="wrong" data-success="right" for="publisher">Publishers</label>
                    </div>
                    	<div class="md-form col-7">
                    		<button type="submit" class="btn btn-success" name="edit_music_notes" id="edit_music_notes"><span class="fa fa-save"></span> Save</button>
                    	</div>
                </form>
	</div>
<?php include('include/script.php'); ?>
<?php
	if(isset($_POST['edit_music_notes'])) {

		$accession_no = mysqli_real_escape_string($conn, $_POST['accession_no']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);

		$edit_id = htmlspecialchars($_POST['edit_id']);

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