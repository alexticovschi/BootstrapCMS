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

    function loadUsersOnline() {


        $.get("functions.php?onlineusers=result", function(data){

            $(".usersonline").text(data);


        });

    }


    setInterval(function(){

        loadUsersOnline();


    },500);

});


tinymce.init({ selector:'textarea' });

