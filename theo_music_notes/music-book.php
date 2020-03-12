<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); 
		$conn = mysqli_connect('localhost', 'root', '', 'theo_music_notes');

		$no_music_piece_sql = mysqli_query($conn, "SELECT MusicBookID FROM music_book INNER JOIN music_book_num USING(MusicBookNumID)");
		$count_music_piece = mysqli_num_rows($no_music_piece_sql);

		$sql_book = mysqli_query($conn, "SELECT MusicBookNumID FROM music_book_num");
		$count_book = mysqli_num_rows($sql_book);

	?>
</head>
<body oncontextmenu="return false;" onselectstart="return false;" class="yellow lighten-4">
	<?php include('include/navbar.php'); ?>
	<?php include('include/modals/addMusicBookNumberModal.php'); ?>
<div class="container">
	<div class="page-header">
		<h1 class="text-center">Theology Library Music Book</h1>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="my-4 text-center">Music Books</h1>
			<a class="btn btn-primary" data-toggle="modal" data-target="#addMusicNumberModal"><span class="fa fa-plus"></span> Add Music Number</a>
			<a class="btn btn-secondary" href="borrow-music-book.php"><span class="fa fa-eye"></span> View Transactions</a>
			<h2>Number of Music Books: <span class="count badge badge-primary"><?php echo $count_book; ?></span></h2>
			<h2>Number of Music Pieces: <span class="count badge badge-primary"><?php echo $count_music_piece; ?></span></h2>
			 <div class="col-sm-12 col-sm-offset-3">
			 	<h6 class="font-weight-bold">Filter Search for Music Piece Number</h6>
            	<div id="imaginary_container">
              		<form method="get" class="form-inline md-form form-sm">
                  		<input class="form-control form-control-sm ml-3 w-75" id="search_music_num" type="text" name="search_music_num" placeholder="Search any keyword">
                  		<button type="submit" name= "btn_search" class="btn btn-primary"><span class="fa fa-search"></span> SEARCH</button>
              		</form>
            	</div>
       		</div>
       		<?php
			if (isset($_GET['btn_search'])) {
				$search_music_num = mysqli_real_escape_string($conn, $_GET['search_music_num']);
				$search_sql = "SELECT * FROM music_book INNER JOIN music_book_num USING(MusicBookNumID) WHERE Title LIKE '%$search_music_num%' 
						OR Publisher LIKE '%$search_music_num%'";
				$search_res = mysqli_query($conn, $search_sql);
				$search_count = mysqli_num_rows($search_res);

				function microtime_float()
				{
					list($usec, $sec) = explode(" ", microtime());
					return ((float)$usec + (float)$sec);
				}
				$time_start = microtime_float();
				usleep(100);
				$time_end = microtime_float();
				$time_search = $time_end - $time_start;
				?>
				<div class='ml-5'>
                    <div class='card-body text-center ml-5'>
                        <h1 class='card-title'>Search results for <span class="font-weight-bold red-text">"<?php echo $search_music_num; ?></span>"</h1>
                        <h3 class="font-weight-bold">About <?php echo $search_count; ?> results found in <?php echo round($time_search, 5); ?> seconds</h3>
                    </div>
                </div>
		<?php	}
		?>
		</div>
		<?php
		if (isset($_GET['btn_search'])) {

			if ($search_count > 0) {
			 	while ($search_row = mysqli_fetch_assoc($search_res)) {
			 	 ?>
			 	 <div class="col-lg-4 mb-1">
				 	<div class="card yellow lighten-3">
				 		<div class="card-body">
				 			<h1 class="card-title ml-5"><span class="badge badge-dark"><?php echo $search_row['MusicBookNumber']; ?></span></h1>
				 			<div class="row">
				 				<div class="col-lg-5">
				 					<a class="btn btn-primary" href="music-details.php?view_details=<?php echo $search_row['MusicBookNumID'] ?>"><span class="fa fa-eye"></span> View</a>
				 				</div>
				 				<div class="col-lg-5">
				 					<a class="btn btn-danger" onclick="return confirm('Delete this <?php echo $search_row['MusicBookNumber']; ?> number');"  href="actions.php?delete_music_book_number=<?php echo $search_row['MusicBookID'] ?>"><span class="fa fa-trash"></span> Delete</a>
				 				</div>
				 			</div>
				 		</div>
				 	</div>
				 </div>
			<?php 	}
				
			 ?>
			<?php } else {
				echo "<div class='card ml-5 amber lighten-2'>
                      	<div class='card-body text-center ml-5'>
                        	<h1 class='card-title'><span class='fa fa-warning'></span> Keyword '$search_music_num' was not found</h1>
                      	</div>
                    </div>";
			}
		} else {
			$view_music_num = mysqli_query($conn, "SELECT * FROM music_book_num ORDER BY MusicBookNumID DESC");
			$count_music_num = mysqli_num_rows($view_music_num);
			if ($count_music_num > 0) {
				while ($music_num_row = mysqli_fetch_assoc($view_music_num)) {
				 ?>
				 <div class="col-lg-4 mb-1">
				 	<div class="card wow fadeInUp yellow lighten-3">
				 		<div class="card-body">
				 			<h1 class="card-title ml-5"><span class="badge badge-dark"><?php echo $music_num_row['MusicBookNumber']; ?></span></h1>
				 			<div class="row">
				 				<div class="col-lg-5">
				 					<a class="btn btn-primary" href="music-details.php?view_details=<?php echo $music_num_row['MusicBookNumID'] ?>"><span class="fa fa-eye"></span> View</a>
				 				</div>
				 				<div class="col-lg-5">
				 					<a class="btn btn-danger" onclick="return confirm('Delete this <?php echo $music_num_row['MusicBookNumber']; ?> number');"  href="actions.php?delete_music_book_number=<?php echo $music_num_row['MusicBookNumID'] ?>"><span class="fa fa-trash"></span> Delete</a>
				 				</div>
				 			</div>
				 		</div>
				 	</div>
				 </div>
				<!--<div class="col-lg-2">
					<a class="text-dark" href="add-music-details.php?add_details=<?php echo $music_num_row['MusicBookID'] ?>"><h2><span class="badge badge-primary"><?php echo $music_num_row['MusicBookNumber']; ?></span></h2></a>
				</div> -->
			<?php } ?>
			<?php } else {	
			?>
<div class="card col-lg-12 yellow lighten-1">  
	<div class="card-body text-center">
    <h1 class="card-title"><a>No Music Book Number Found</a></h1>
    <h3>Please add a music number</h3>
  </div>
</div>
		<?php }
	}
		?>
	</div>
</div>	
<?php include('include/script.php'); 
	
	if (isset($_POST['add_music_book_number'])) {
		
		$book_number = mysqli_real_escape_string($conn, $_POST['music_book_number']);

		//prevent from duplication
		$sel_book_num = mysqli_query($conn, "SELECT * FROM music_book_num WHERE MusicBookNumber = '$book_number'");
		if (mysqli_num_rows($sel_book_num) > 0) {

			echo "<script>
				alert('Music Book Number is already existing');
			</script>";

		} else {

			$add_music_book_num = "INSERT INTO music_book_num(MusicBookNumber) VALUES('$book_number')";

			if (mysqli_query($conn, $add_music_book_num)) {
				echo "<script>
					alert('Added a music number successfully');
				</script>
				<meta http-equiv='refresh' content='0; url=music-book.php'>";
			} else {
				echo "<script>
					alert('Error in adding');
				</script>";
			}
		}
	}
?>
<script>
	new WOW().init();

//Filter Search
$(document).ready(function(){
 $('#search_music_num').keyup(function(){
  var text = $(this).val();
    $('.col-lg-4').hide();
    $('.col-lg-4 .badge:contains("'+text+'")').closest('.col-lg-4').show();
 
 });
});

$.expr[":"].contains = $.expr.createPseudo(function(arg) {
  return function( elem ) {
   return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
  };
});

//Number Animate
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
</script>
</body>
</html>