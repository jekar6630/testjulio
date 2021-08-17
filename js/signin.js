$(document).ready(function(){

	$(".sgn_btn").click(function(){
		var usr = $("#sgn_user").val();
		var psr = $("#sgn_pazz").val();
		var reg = $("#register").val();
		var hekp = [];
		
		$.ajax({
			url: "php/verification.php",
			type: "POST",
			dataType: "json",
			data: {
				user : usr,
				pass : psr,
				reg  : reg
			},
			success: function(data){
				$.each(data, function(key, val){
					hekp.push(data[key]);
				});

				if(hekp[0]=="invalid"){
					$('#inv-lg').modal('show');
					$('#message').html(hekp[1]);
				}

				if(hekp[0]=="done"){
					window.location.replace(hekp[1]);
				}
			}
		});
	});
});