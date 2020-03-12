<!DOCTYPE html>
<?php
	$conn = mysqli_connect('localhost', 'root', '', 'university_acquisition');
	$edit = htmlspecialchars($_GET['edit']);
	$sql = mysqli_query($conn, "SELECT * FROM univ_acquisition WHERE AcquisitionID = '$edit'");
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
		<h2>Edit Book for <span class="text-warning"><?php echo $row['Title']; ?></span></h2>
			<form method="post">
				<div class="row">
					<input type="hidden" name="edit_id" value="<?php echo $row['AcquisitionID']; ?>">
                       <div class="md-form col-6">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="author" id="author" value="<?php  echo $row['Author'] ?>">
                        <label data-error="wrong" data-success="right" for="author">Author</label>
                    </div>
                    <div class="md-form col-6">
                        <i class="fa fa-header prefix dark-text"></i>
                        <input type="text" name="title" id="title" value="<?php  echo $row['Title'] ?>">
                        <label>Title</label>
                    </div>
                    <div class="md-form col-6">
                        <i class="fa fa-copyright prefix dark-text"></i>
                        <input type="text" name="copyright" id="copyright" value="<?php echo $row['Copyright'] ?>">
                        <label data-error="wrong" data-success="right" for="copyright">Copyright</label>
                    </div>
                     <div class="md-form col-6">
                        <i class="fa fa-dollar prefix dark-text"></i>
                        <input type="text" name="price" id="price" value="<?php  echo $row['Price'] ?>">
                        <label data-error="wrong" data-success="right" for="price">Price</label>
                    </div>
                    <div class="md-form col-6">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="request_by" id="request_by" value="<?php echo $row['RequestedBy'] ?>">
                        <label data-error="wrong" data-success="right" for="request_by">Requested By</label>
                    </div>
                    <div class="md-form col-6">
                        <i class="fa fa-building prefix dark-text"></i>
                        <input type="text" name="department" value="<?php echo $row['Department'] ?>">
                        <label data-error="wrong" data-success="right" for="publisher">Department</label>
                    </div>
                    <div class="md-form col-6">
                        <i class="fa fa-user prefix dark-text"></i>
                        <input type="text" name="dealer" id="dealer" value="<?php  echo $row['Dealer'] ?>">
                        <label data-error="wrong" data-success="right" for="dealer">Dealer</label>
                    </div>
                    <div class="md-form col-5">
                        <i class="fa fa-file prefix dark-text"></i>
                        <input type="text" name="deliv_rec_no" id="deliv_rec_no" value="<?php echo $row['DeliveryReceiptNo'] ?>">
                        <label data-error="wrong" data-success="right" for="deliv_rec_no">Delivery Receipt Number</label>
                    </div>
                    <div class="md-form col-12">
                        <button style="margin-left: auto; margin-right: auto; display: block; width: 40%;" type="submit" class="btn btn-success" name="save_book" id="save_book"><span class="fa fa-save"></span> Save</button>
                    </div>
                </div>
            </form>
	</div>
<?php include('include/script.php'); ?>
<?php
	if(isset($_POST['save_book'])) {

		$author = mysqli_real_escape_string($conn, $_POST['author']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $request_by = mysqli_real_escape_string($conn, $_POST['request_by']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $dealer = mysqli_real_escape_string($conn, $_POST['dealer']);
        $deliv_rec_no = mysqli_real_escape_string($conn, $_POST['deliv_rec_no']);

		$edit_id = htmlspecialchars($_POST['edit_id']);

		$edit_sql = mysqli_query($conn, "UPDATE univ_acquisition SET Author = '$author', Title = '$title', Copyright = '$copyright', 
			Price = '$price', RequestedBy = '$request_by', Department = '$department', Dealer = '$dealer', DeliveryReceiptNo = '$deliv_rec_no' WHERE AcquisitionID = '$edit_id'");

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