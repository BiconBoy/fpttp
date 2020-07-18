function click_to_submit_form(){
    $("#click_submit_btn").hide('fast');
	$("#my_progress_bar").show('fast');
	$("#other_text").hide('fast');
    $("#submit_btn").click();
}

function ftp_login(path){
	$("#click_submit_btn").hide('fast');
	$("#my_progress_bar").show('fast');
	$("#other_text").hide('fast');


	UID = $("input[name='UID']").val();
	password = $("input[name='password']").val();

	$.ajax({
		url:path,
		type:'POST',
		data:{UID:UID, password:password},
		success:function(data){
			setTimeout(function(){

				if(data == '3'){
					$("#result_returned").addClass('alert alert-danger');
					$("#result_returned").html("incorrect username or password");
					$("#my_progress_bar").hide('fast');
					$("#click_submit_btn").show('fast');
					$("#other_text").show('fast');

					setTimeout(function(){
						$("#result_returned").removeClass('alert alert-danger');
						$("#alert alert-danger").html('');
					},3000);
				}

				if(data == '4'){
					$("#result_returned").addClass('alert alert-warning');
					$("#result_returned").html("Your account is temporary blocked");
					$("#my_progress_bar").hide('fast');
					$("#click_submit_btn").show('fast');
					$("#other_text").show('fast');
					$("#other_text").htnl('Please consart the admin so that you can access the system');
				}

				if(data == '1'){
					$("#result_returned").addClass('alert alert-success');
					$("#result_returned").html("Success");
					setTimeout(function(){
						window.location.replace('Student');
					},3000);
				}

				if(data == '2'){
					$("#result_returned").addClass('alert alert-success');
					$("#result_returned").html("Success");
					setTimeout(function(){
						window.location.replace('adminstrator');
					},3000);
				}



			},3000);
		}
	});

	return false;
	
}

function create_account(path){
	$("#click_submit_btn").hide('fast');
	$("#my_progress_bar").show('fast');
	$("#other_text").hide('fast');

	UID = $("input[name='UID']").val();
	password = $("input[name='password']").val();
	$.ajax({
		url:path,
		type:'POST',
		data:{UID:UID, password:password},
		success:function(data){
			setTimeout(function(){

				if(data == '1'){
					$("#result_returned").addClass('alert alert-warning');
					$("#result_returned").html("Your FTP account already exist");
					$("#my_progress_bar").hide('fast');
					$("#other_text").show('fast');
				}

				if(data == '2'){
					$("#result_returned").addClass('alert alert-danger');
					$("#result_returned").html("No record found");
					$("#my_progress_bar").hide('fast');
					$("#click_submit_btn").show('fast');

					
					setTimeout(function(){
						$("#result_returned").removeClass('alert alert-danger');
						$("#result_returned").html("");
					},3000);
					
				}

				if(data != '1' && data != '2'){
					$("#don_show").hide('fast');
					$("#logo_content").hide('fast');
					$("#returned_info").show('slow');
					$("#returned_result").html(data);
				}





			},3000);
		}
	});


	return false;
	
}

