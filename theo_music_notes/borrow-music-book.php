<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); ?>
</head>
<body oncontextmenu="return false;" onselectstart="return false" class="yellow lighten-4">
	<?php include('include/navbar.php'); ?>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center">Music Book Borrowing and Returning Transactions</h1>
		</div>
		<ul class="nav nav-tabs blue-gradient md-tabs nav-justified">
			<li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewBorrowedMusicNotes" role="tab"><span class="fa fa-share"></span> Borrowed Pieces</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewReturnedMusicNotes" role="tab"><span class="fa fa-reply"></span> Returned Pieces</a>
            </li>
		</ul>
		<div class="tab-content card">
			<div class="tab-pane fade in show active" id="viewBorrowedMusicNotes"role="tabpanel">
				<div class="table-responsive">
					<h1 class="text-center">Borrowed Books</h1>
					<table class="table table-hover" id="tblBorrowed">
						<thead class="thead-dark">
							<tr>
								<th>Music Piece Number</th>
								<th>Title</th>
								<th>Copyright</th>
								<th>Publisher</th>
								<th>Name of Borrower</th>
								<th>Actions</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="viewReturnedMusicNotes" role="tabpanel">
				<div class="table-responsive">
					<h1 class="text-center">Returned Books</h1>
					<table class="table table-hover" id="tblBorrowed">
						<thead class="thead-dark">
							<tr>
								<th>Music Piece Number</th>
								<th>Title</th>
								<th>Copyright</th>
								<th>Publisher</th>
								<th>Name of Borrower</th>
								<th>Actions</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php  include('include/script.php');  ?>
</body>
</html>
