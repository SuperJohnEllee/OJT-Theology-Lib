<!DOCTYPE html>
<html>
<head>
	<?php include('include/header.php'); 

		$conn = mysqli_connect('localhost', 'root', '', 'theo_music_notes');

		$sql = mysqli_query($conn, "SELECT MusicNotesID FROM music_notes");
		$count_single = mysqli_num_rows($sql);

		$sql_book = mysqli_query($conn, "SELECT MusicBookNumID FROM music_book_num");
		$count_book = mysqli_num_rows($sql_book);

		$no_music_piece_sql = mysqli_query($conn, "SELECT MusicBookID FROM music_book INNER JOIN music_book_num USING(MusicBookNumID)");
		$count_music_piece = mysqli_num_rows($no_music_piece_sql);

		$total_music_piece = $count_single + $count_music_piece;
	?>

</head>
<body  oncontextmenu="return false;" onselectstart="return false;"  class="yellow lighten-4" onload="startTime()">
	<?php include('include/modals/viewTotalMusicPieces.php'); ?>
	<?php include('include/navbar.php') ?>
<div class="container">
	<div class="page-header">
		<h1 class="text-center">College of Theology Library</h1>
		<hr>
	</div>
	<div class="col-lg-12">
			<h2 class="my-4 text-center">Music Pieces Profiling<br>Total Number of Music Pieces: <span class="count badge badge-primary"><?php echo $total_music_piece; ?></span></h2>
	</div>
	<div class="row">
		<div class="col-sm-12 col-sm-offset-3 wow fadeInDown">
			<h6 class="font-weight-bold">Search any keywords</h6>
        	<div class="md-form" id="imaginary_container">
            	<form method="get" action="search.php" class="form-inline md-form form-sm">
                  	<input class="form-control form-control-sm ml-3 w-75" id="search" type="text" name="search_keywords" required placeholder="Search">
                  	<button type="submit" name= "btn_search_notes" class="btn btn-primary"><span class="fa fa-search"></span> Search for Music Piece</button>
                  	<button type="submit" name= "btn_search_book" class="btn btn-primary"><span class="fa fa-search"></span> Search for Music Book</button>
            	</form>
          	</div>
       	</div>	
		<div class="col-lg-6 text-center wow flipInX">
			<a class="text-dark" style="text-decoration: none;" href="music-piece-single.php"><img src="assets/img/music_note.svg" height="300px"><h2>Music Notes(Single)<br><span class="count badge badge-primary"><?php echo $count_single; ?></span></h2></a>
		</div>
		<div class="col-lg-6 text-center wow flipInY">
			<a class="text-dark" href="music-book.php"><img src="assets/img/music_book.svg" height="300px"><h2>Music Notes(Book)<br><span class="count badge badge-primary"><?php echo $count_book; ?></h2></a>
		</div>
	</div>
</div>
<?php include('include/script.php'); ?>

<script>

new WOW().init();
//Date Time
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('date_time').innerHTML = today;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

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