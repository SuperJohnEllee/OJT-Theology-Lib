<!DOCTYPE html>
<?php
	$conn = mysqli_connect('localhost', 'root', '','theo_accession_book') or die('Connection Failed: ' . mysqli_error());
	$edit = htmlspecialchars($_GET['edit']);
	$sql = mysqli_query($conn, "SELECT * FROM accession_book WHERE AccessionBookID = '$edit'");
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
				<div class="row">
					<input type="hidden" name="edit_id" value="<?php echo $row['AccessionBookID']; ?>">
                    <div class="md-form col-6">
                        <i class="fa fa-book prefix dark-text"></i>
                        <input type="text" name="accession_no" id="accession_no" class="form-control" value="<?php echo $row['AccessionNo'] ?>">
                        <label data-error="wrong" data-success="right" for="accession_no">Accession Number</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="author" id="author" value="<?php echo $row['Author'] ?>">
                    	<label data-error="wrong" data-success="right" for="author">Author</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-header prefix dark-text"></i>
                    	<input type="text" name="title" id="title" value="<?php echo $row['Title'] ?>">
                    	<label>Title</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-copyright prefix dark-text"></i>
                    	<input type="text" name="copyright" id="copyright" value="<?php echo $row['Copyright'] ?>">
                    	<label data-error="wrong" data-success="right" for="copyright">Copyright</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-hashtag prefix dark-text"></i>
                    	<input type="text" name="pages" id="author" value="<?php echo $row['Pages'] ?>">
                    	<label data-error="wrong" data-success="right" for="pages">Pages</label>
                    </div>
                    <div class="md-form col-6">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="publisher" id="author" value="<?php echo $row['Publishers'] ?>">
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
                    	<input type="text" name="price" id="price" value="<?php echo $row['Price'] ?>">
                    	<label data-error="wrong" data-success="right" for="price">Price</label>
                    </div>
                    <div class="md-form col-5">
                    	<i class="fa fa-user prefix dark-text"></i>
                    	<input type="text" name="donor" id="donor" value="<?php echo $row['Donor'] ?>">
                    	<label data-error="wrong" data-success="right" for="donor">Donor</label>
                    </div>
                    <!--<div class="md-form col-6">
                    	<i class="fa fa-info-circle prefix dark-text"></i>
                    	<input type="text" name="status" id="status">
                    	<label data-error="wrong" data-success="right" for="status">Status</label>
                    </div> -->
                    	<div class="md-form col-6">
                    		<button type="submit" class="btn btn-success" name="edit_book" id="edit_book"><span class="fa fa-paper-plane"></span> Edit</button>
                    	</div>
                    </div>
                </form>
	</div>
<?php include('include/script.php'); ?>
<?php
	if(isset($_POST['edit_book'])) {

		$accession_no = mysqli_real_escape_string($conn, $_POST['accession_no']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$pages = mysqli_real_escape_string($conn, $_POST['pages']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);
		$donor = mysqli_real_escape_string($conn, $_POST['donor']);

		$edit_id = htmlspecialchars($_POST['edit_id']);

		$edit_sql = mysqli_query($conn, "UPDATE accession_book SET AccessionNo = '$accession_no', 
			Author = '$author', Title = '$title', Copyright = '$copyright', 
			Pages = '$pages', Publishers = '$publisher', Type = '$type', Price = '$price', Donor = '$donor' WHERE AccessionBookID = '$edit_id'");

		if ($edit_sql) {
			echo "<script>
					alert('Updated a Book successfully');
				</script>
				<meta http-equiv='refresh' content='0; url=index.php'>";
		} else {
			echo "<script>
					alert('Error in editing');
				</script>";
		}
	}
?>
</body>
</html>