/*
Name: Javascript Functions
Version: 1.0
Description: Javascripts para o site
Author: Alex Koti
Author URI: http://alexkoti.com
 */


jQuery(document).ready(function($){
	//remover status de javascript do documento
	$('html').removeClass('no-js');
	
	/**
	 * Ajustar altura do menu mobile
	 * 
	 */
	$('#mobile-menu .navbar-collapse').on('show.bs.collapse', function(){
		// corrigir altura dos filtros para ocupar a altura disponível do viewport
		var menuh = $('#box-menu-top .navbar-header').outerHeight();
		var windowh = $(window).height();
		$('#mobile-menu').height( windowh - menuh );
		$('body').addClass('locked');
	});
	$('#mobile-menu .navbar-collapse').on('hide.bs.collapse', function(){
		$('#mobile-menu').height('auto');
		$('body').removeClass('locked');
	});
	
	
	/**
	 * Slider home
	 * 
	 */
	var owl = $("#owl-slider");
	owl.owlCarousel({
		navigation : false,
		singleItem : true
	});
	$('.slider-prev-next').on('click', function(e){
		e.preventDefault();
		if( $(this).is('.next') ){
			owl.trigger('owl.next');
		}
		else{
			owl.trigger('owl.prev');
		}
	});
	
	
	/**
	 * VALIDATION
	 * Ações para validação js de comentários
	 * 
	 * 
	 * 
	 */
	$("#commentform").validate({
		rules: {
			// name_do_input: 'método de validação para aplicar, separado por espaços'
			comment: 'defaultInvalid'
		},
		messages: {
			// name_do_input: 'Mensagem'
			comment: 'Digite uma mensagem',
			author: 'Este campo é obrigatório',
			email: 'Digite um endereço de e-mail válido'
		},
		errorPlacement: function(label, element) {
			// label - elemento <label> gerado pelo validator
			// element - input validado
			// pegar o id do elmento e assim desconbrir o <label> como 'for' correspondente
			label.insertAfter( $('label[for=' + element.attr('id') + ']') );
		}
	});
	//remover label de error ao focar os inputs
	$('.form_element input, .form_element textarea').hover(function(){
		$(this).siblings('.error').fadeOut();
	});
	// método personalizado de validação - 'defaultInvalid'
	jQuery.validator.addMethod('defaultInvalid', function(value, element) {
		switch (element.value) {
			case 'Digite sua mensagem aqui':
				if (element.name == 'comment')
				return false;
				break;
			default: return true; 
				break;
		}
	});
	
	
	
});
