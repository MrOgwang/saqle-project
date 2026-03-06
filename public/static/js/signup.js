$(document).ready(function(){
     var baseUrl = "https://www.postbnd.local/";
	 var backendUrl = baseUrl + "/account/api/authenticate.php";
	 var apiEndpoint = "/signup/";
	 var signinEndpoint = "/signin/";
	 var csrfToken  = $("#csrf_token").val();
	 let getVerCode = (username, contact, password) => {
	 	 return utils.ajax("POST", apiEndpoint + 'code/generate/', 
	 	 {
	 	 	 csrf_token: csrfToken, 
	 	 	 username: username,
	 	 	 contact: contact, 
	 	 	 password: password
	 	 }, null).then(function(response){
			 return Promise.resolve(JSON.parse(response));
		 }).catch(function(error){
		 	 return Promise.reject(JSON.parse(error));
		 });
	 };
	 let confirmVerCode = (contact, code) => {
	 	 return utils.ajax("POST", apiEndpoint + 'code/confirm/', 
	 	 {
	 	 	 csrf_token: csrfToken, 
	 	 	 contact: contact, 
	 	 	 code: code
	 	 }, null).then(function(response){
			 return Promise.resolve(JSON.parse(response));
		 }).catch(function(error){
		 	 return Promise.reject(JSON.parse(error));
		 });
	 };


	 let createAccount = () => {
	 	 let form = document.getElementById('signUpForm');
	 	 return utils.ajax("POST", apiEndpoint + 'register/', null, form).then(function(response){
			 return Promise.resolve(JSON.parse(response));
		 }).catch(function(error){
		 	 return Promise.reject(JSON.parse(error));
		 });
	 };

	 let logIn = () => {
	 	 let form = document.getElementById('signInForm');
	 	 return utils.ajax("POST", signinEndpoint, null, form).then(function(response){
			 return Promise.resolve(JSON.parse(response));
		 }).catch(function(error){
		 	 return Promise.reject(JSON.parse(error));
		 });
	 };

     function validateFullName(fullName){
     	 if(!fullName){
     	 	 $("#nameInfo").empty().append('Your legal full name is required!').addClass('form_input_info_danger');
     	 	 return false;
     	 }

     	 let allNames = fullName.split(" ");
     	 if(allNames.length <= 1 || (allNames.length === 2 && !allNames[1])){
     	 	 $("#nameInfo").empty().append('Please provide at least a first and last name').addClass('form_input_info_danger');
     	 	 return false;
     	 }

     	 $("#nameInfo").empty().append('Your legal full name').removeClass('form_input_info_danger');
     	 return true;
     }

     function validateUserName(userName){
     	 if(!userName){
     	 	 $("#userNameInfo").empty().append('User name is a required!').addClass('form_input_info_danger');
     	 	 return false;
     	 }

     	 $("#userNameInfo").empty().append('How you will be known on SaQle').removeClass('form_input_info_danger');
     	 return true;
     }

     function validateContact(contact){
     	 if(!contact){
     	 	 $("#contactInfo").empty().append('Email or phone is a required!').addClass('form_input_info_danger');
     	 	 return false;
     	 }

     	 $("#contactInfo").empty().append('So we can contact you with important info').removeClass('form_input_info_danger');
     	 return true;
     }

     var strength = 0;
	 function validatePassword(password){
	 	 if(!password){
     	 	 $("#passwordInfo").empty().append('password is required!').addClass('form_input_info_danger');
     	 	 return false;
     	 }

	 	 strength = 0;
		 
		 //Check password length
		 if(password.length < 8) {
		     $("#p1").removeClass("passed");
		 }else{
		     strength += 1;
		     $("#p1").addClass("passed");
		 }

		 //Check for mixed case
		 if(/[a-z]/.test(password) && /[A-Z]/.test(password)){
		    strength += 1;
		    $("#p2").addClass("passed");
		 }else{
		    $("#p2").removeClass("passed");
		 }

		 //Check for numbers
		 if(password.match(/\d/)){
		    strength += 1;
		    $("#p3").addClass("passed");
		 }else{
		    $("#p3").removeClass("passed");
		 }

		 //Check for special characters
		 if(password.match(/[^a-zA-Z\d]/)){
		     strength += 1;
		     $("#p4").addClass("passed");
		 }else{
		     $("#p4").removeClass("passed");
		 }

         var strengthElement = document.getElementById("passwordInfo");

		 if(strength < 2){
		 	 $("#passwordInfo").empty().append('Password is very weak!').addClass('form_input_info_danger');
		 	 return false;
		 }else if(strength === 2){
		 	 $("#passwordInfo").empty().append('Password is weak!').addClass('form_input_info_danger');
		 	 return false;
		 }else if (strength === 3){
		 	 $("#passwordInfo").empty().append('Password is medium strong!').addClass('form_input_info_danger');
		 	 return false;
		 }else {
		 	 $("#passwordInfo").empty().append('Password is strong! Nice').removeClass('form_input_info_danger').addClass("form_input_info_success");
		 	 return true;
		 }
	 }

     $("body").on("input", "#fullName", function(e){
	 	 validateFullName($(this).val());
	 });

	 $("body").on("input", "#userName", function(e){
	 	 validateUserName($(this).val());
	 });

	 $("body").on("input", "#contact", function(e){
	 	 validateContact($(this).val());
	 });

	 $('body').on('input', '#password', function(e){
         validatePassword($(this).val());
	 });

	 $("body").on("click", "#createAccountButton", function(e){
	 	 let self = this;
         $("#signupMessage").empty().addClass('hide');
 	 	 $(self).empty().append("<span class='fa fa-spinner fa-pulse fa-fw'></span>&nbsp;Creating...").attr('disabled', 'disabled');
		 createAccount().then(function(res){
			 $(self).empty().append("Sign me up").removeAttr('disabled');
			 setTimeout(() => {
				 window.location = res ? res : window.location.origin;
	         }, 1000);
		 }).catch(function(error){
			 $(self).empty().append("Sign me up").removeAttr('disabled');
			 $("#signupMessage").empty().append(`
	 		 <div style='margin-bottom:20px;' class='system-info system-info-danger'>
	     	     ` + error.Message + `
	     	 </div>
	 	     `).removeClass('hide');
		 });
	 });
});
	 