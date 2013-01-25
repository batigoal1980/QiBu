$(document).ready( function() {
	$('.image .line img').click(function(e) { $(this).parent().find('input').attr('checked', true).focus(); });
	if ($('#hdnState').val() == 'login')
	{
		$('#register').hide(); 
		var email = $('#emaillogin').val();
		if (email && email.length > 0)
			$('#passwordlogin').focus();
		else
			$('#emaillogin').focus();
	}
	else
	{
		$('#login').hide();
		$('#emailregister').focus();
	}
	$('a#showLogin').click(function(e) { $('#register, .error').hide(); $('#login').fadeIn(500, function () { $('#emaillogin').focus(); }); $('#hdnState').val('login'); });
	$('a#showRegister').click(function(e) { $('#login, .error').hide(); $('#register').fadeIn(500, function () { $('#emailregister').focus(); }); $('#hdnState').val('register'); });        
	$('#login input').keypress(function(e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
			$('#btnLogin').click();
			e.preventDefault();
		}
	});
	$('#register input').keypress(function(e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
			$('#ctl00_plcBody_btnRegister').click();
			e.preventDefault();
		}
	});
});