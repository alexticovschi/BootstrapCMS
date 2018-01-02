 $(document).ready(function() {
	
	$('#selectAllBoxes').click(function() {
		if(this.checked) {
			//console.log(this.checked);
			$('.checkBoxes').each(function() {
				this.checked = true;
			});
		} else {
			$('.checkBoxes').each(function() {
				this.checked = false;
			});
		}
	})

 });


 tinymce.init({ selector:'textarea' });

