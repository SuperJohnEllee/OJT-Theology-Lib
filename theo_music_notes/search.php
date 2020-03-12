<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); 

		$conn = mysqli_connect('localhost', 'root', '', 'theo_music_notes');

		if (!isset($_GET['search_keywords'])) {
			header("location: index.php");
		} else if (!isset($_GET['search_keywords'])) {
			header("location: index.php");
		}

		$search_keywords = mysqli_real_escape_string($conn, $_GET['search_keywords']);
		$search_music_notes = mysqli_query($conn, "SELECT * FROM music_notes WHERE AccessionNo LIKE '%$search_keywords%'
							OR Title LIKE '%$search_keywords%' OR Publisher LIKE '%$search_keywords%' ORDER BY Title ASC");
		$count_notes = mysqli_num_rows($search_music_notes);


		$search_music_book = mysqli_query($conn,"SELECT * FROM music_book INNER JOIN music_book_num USING(MusicBookNumID) WHERE MusicBookNumber LIKE '%$search_keywords%' OR Title LIKE '%$search_keywords%' OR Publisher LIKE '%$search_keywords%' ORDER BY Title ASC");
		$count_book = mysqli_num_rows($search_music_book);

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
</head>
<body class="yellow lighten-4" oncontextmenu="return false;" onselectstart="return false;">
<?php include('include/navbar.php'); ?>
<div class="container">
	<div class="page-header">
		<?php
			if (isset($_GET['btn_search_notes'])) {
				?>
				<div class='ml-5'>
                      <div class='card-body text-center ml-5'>
                        <h1 class='card-title'>Search results for <span class="font-weight-bold red-text">"<?php echo $search_keywords; ?></span>" in Music Pieces</h1>
                        <h3 class="font-weight-bold">About <?php echo $count_notes; ?> results found in <?php echo round($time_search, 5); ?> seconds</h3>
                    </div>
                </div>
			<?php
			} else if (isset($_GET['btn_search_book'])) {
				?>
				<div class='ml-5'>
                      <div class='card-body text-center ml-5'>
                        <h1 class='card-title'>Search results for <span class="font-weight-bold red-text">"<?php echo $search_keywords; ?></span>" in Music Books</h1>
                        <h3 class="font-weight-bold">About<?php echo $count_book; ?> results found in <?php echo round($time_search, 5); ?> seconds</h3>
                    </div>
                </div>
		<?php
			}
		?>
	</div>
<div class="row">
<?php
	
	if (isset($_GET['btn_search_notes'])) {

		if ($count_notes > 0) {
			while ($search_row_notes = mysqli_fetch_assoc($search_music_notes)) {
			
			?>
			<div class="col-lg-6 col-lg-4 mr-auto ml-auto mb-1">
				<div class="card yellow lighten-3">
				 	<div class="card-body text-center">
				 		<h1 class="card-title"><span class="badge badge-primary"><?php echo $search_row_notes['AccessionNo']; ?></span></h1>
				 		<div class="col-lg-12">
				 			<h3 class="text-center font-weight-bold"><?php echo $search_row_notes['Title']; ?></h3>
				 			<h5 class="text-center"><?php echo $search_row_notes['Publisher']; ?></h5>
				 		</div>
				 	</div>
				 </div>
			 </div>
	<?php
		}		
	} 

	} else if (isset($_GET['btn_search_book'])) {
		if ($count_book > 0) {
			while ($search_row_book = mysqli_fetch_assoc($search_music_book)) {
				?>
				<div class="col-lg-6 ml-auto mr-auto col-lg-4 mb-1">
				<div class="card yellow lighten-3">
					<div class="card-body text-center">
						<h1 class="card-title text-center"><span class="badge badge-primary"><?php echo $search_row_book['MusicBookNumber']; ?></span></h1>
						<h3 class="font-weight-bold"><?php echo $search_row_book['Title']; ?></h3>
						<h5><?php echo $search_row_book['Publisher']; ?></h5>
						<h5><?php echo $search_row_book['Copyright']; ?></h5>
					</div>
				</div>
			</div>
		<?php	}
		}
	}
?>
</div>
</div>
<?php include('include/script.php'); ?>
<script>
	new WOW.init();
</script>
</body>
</html>