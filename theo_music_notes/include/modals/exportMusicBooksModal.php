	<div class="modal fade" id="exportMusicBooksModal" tabindex="-1" role="dialog" aria-labelledby="delete_label" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header brown">
        			<h5 class="modal-title ml-auto text-center text-white" id="delete_label">EXPORT IN EXCEL</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span class="text-white" aria-hidden="true">&times;</span>
        			</button>
      			</div>
      		<div class="modal-body">
            <h4 class="text-center"><?php echo $view_details_row['MusicBookNumber']; ?></h4>
        		<h1 class="text-center">EXPORT ALL MUSIC PIECES?</h1>
     	 	</div>
      <div class="modal-footer">
        <a class="btn btn-default" href="actions.php?export_music_book=<?php echo $view_details_row['MusicBookNumID']; ?>"><span class="fa fa-cloud-download"></span> OK</a>
      	<!--<form method="post" action="export_music_books.php">
			<button class="btn btn-default" type="submit" name="btn_export_music_books"><span class="fa fa-cloud-download"></span> SUBMIT</button>
		</form> -->
      </div>
    </div>
  </div>
</div>