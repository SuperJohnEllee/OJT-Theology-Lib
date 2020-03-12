$(document).ready(function(){
		$(document).on('click', '#add_books', function(){
			//define variables
			var author = document.getElementById('author').val();
			var title = document.getElementById('title').val();
			var copyright = document.getElementById('copyright').val();
			var request_by = document.getElementById('request_by').val();
			var department = document.getElementById('department').val();
			var dealer = document.getElementById('dealer').val();
			var deliv_rec_no = document.getElementById('deliv_rec_no').val();

			$.ajax({
				url: 'ajax.php',
				type: 'POST',
				data:{
					author:author,
					title:title,
					copyright:copyright,
					request_by:request_by,
					department:department,
					dealer:dealer,
					deliv_rec_no:deliv_rec_no,
					action:"add_books"
				},
			}).then(function(data){

			});
		})
});

$(document).on("click", ".modal-closer", function() { 
			location.reload();
});