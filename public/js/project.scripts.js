$(document).ready(function() {
	$("#phone").mask("+9 (999) 999-99-99", {placeholder: "" });
	$("#telegram").mask("+9 (999) 999-99-99", {placeholder: "" });
	$("#whatsapp").mask("+9 (999) 999-99-99", {placeholder: "" });
	
	$( "#btn-telegram" ).click(function( event ) {
		event.preventDefault();
		$("#telegram").val( $("#phone").val() );
	});
	
	$( "#btn-telegram" ).click(function( event ) {
		event.preventDefault();
		$("#telegram").val( $("#phone").val() );
	});
	
	$( "#btn-whatsapp" ).click(function( event ) {
		event.preventDefault();
		$("#whatsapp").val( $("#phone").val() );
	});
});