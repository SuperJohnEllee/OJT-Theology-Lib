<!DOCTYPE html>
<?php
	$conn = mysqli_connect('localhost', 'root', '', 'theo_music_notes');

	$borrow = mysqli_real_escape_string($conn, $_GET['borrow']);
	$borrow_sql = mysqli_query($conn, "SELECT * FROM music_notes WHERE MusicNotesID = '$borrow'");
	$borrow_row = mysqli_fetch_assoc($borrow_sql);
?>
<html>
<head>
	<?php include('include/header.php'); ?>
</head>
<body class="cyan lighten-5">
	<?php include('include/navbar.php'); ?>
<div class="container">
	<div class="page-header">
		<h1 class="text-center">Borrwing of Music Pieces</h1>
	</div>
	<h2>Borrow music piece of <span class="text-warning"><?php echo $borrow_row['Title'];  ?></span></h2>
	<hr>
	<form method="post">
		<h3 class="text-center">Enter Borrower Name</h1>
		<div class="row">
			<div class="md-form col-4">
				<i class="fa fa-user prefix dark-text"></i>
                <input type="text" name="firstname" id="title">
                <label>First Name</label>
			</div>
			<div class="md-form col-4">
				<i class="fa fa-user prefix dark-text"></i>
                <input type="text" name="midname" id="title">
                <label>Middle Name</label>
			</div>
			<div class="md-form col-4">
				<i class="fa fa-user prefix dark-text"></i>
                <input type="text" name="lastname" id="title">
                <label>Last Name</label>
			</div>
			<div class="md-form col-12">
				<button style="margin-left: auto; margin-right: auto; display: block; width: 40%;" type="submit" class="btn btn-success" name="borrow_music_piece" id="borrow_music_piece"><span class="fa fa-paper-plane"></span> Submit</button>
			</div>
		</div>
	</form>
</div>
<?php include('include/script.php'); ?>
<?php
	if (isset($_POST['borrow_music_piece'])) {
		
		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$midname = mysqli_real_escape_string($conn, $_POST['midname']);
		
		$music_notes = htmlspecialchars($_GET['borrow']);

		$fullname = $lastname . ", " . $firstname . " " . $midname;

		$check_borrow = mysqli_query($conn, "SELECT * FROM transaction WHERE Status = 'Borrowed'");

		if (mysqli_num_rows($check_borrow) > 0) {
			
			echo "<script>
				alert('Sorry, this music piece is already borrowed');
			</script>";
		} else {

			$insert_transaction = mysqli_query($conn, "INSERT INTO transaction(MusicNotesID, Name, Status, TransDate)
				VALUES('$music_notes', '$fullname', 'Borrowed', NOW())");

			if ($insert_transaction) {
				echo "<script>
					alert('Successfully borrowed a music piece');
				</script>
				<meta http-equiv='refresh' content='0; url=music-piece-single.php'>";
			} else {
				echo "<script>
					alert('Error in borrwing');
				</script>";
			}
		}
	}
?>
</body>
</html>