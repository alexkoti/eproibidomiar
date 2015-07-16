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
	 * Slider principal
	 * 
	 */
	var owlFeats = $("#owl-slider");
	owlFeats.owlCarousel({
		navigation : false,
		singleItem : true
	});
	$('#main-slider .slider-prev-next').on('click', function(e){
		e.preventDefault();
		if( $(this).is('.next') ){
			owlFeats.trigger('owl.next');
		}
		else{
			owlFeats.trigger('owl.prev');
		}
	});
	
	/**
	 * Slider fotos home
	 * 
	 */
	var owlHomePhotos = $("#owl-home-photos");
	owlHomePhotos.owlCarousel({
		navigation : false,
		pagination : false,
		items : 3,
		itemsDesktop : [1280, 3]
	});
	$('#home-photos .owl-navigation .btn').on('click', function(e){
		e.preventDefault();
		if( $(this).attr('data-slide') == 'next' ){
			owlHomePhotos.trigger('owl.next');
		}
		else{
			owlHomePhotos.trigger('owl.prev');
		}
	});
	
	/**
	 * Lightbox fotos
	 * 
	 */
	if( $('.photo-item').length ){
		var pswpElement = document.querySelectorAll('.pswp')[0];
		
		// build items array
		var items = [];
		
		$('.photo-item').each(function(){
			var link = $(this).find('.photo a.lightbox-image');
			var sizes = link.attr('data-sizes').split('x');
			var title = $(this).find('.caption .title').text();
			var download = $(this).find('.caption .download').html();
			if( download ){
				var caption = title + download;
			}
			else{
				var caption = title;
			}
			var photo = {
				index : Number($(this).attr('data-index')),
				src : link.attr('href'),
				w : sizes[0],
				h : sizes[1]
			}
			if( title.length > 0 ){
				photo.title = caption;
			}
			items.push(photo);
		});
		// ordenar array
		items.sort( lightbox_compare );
		
		$('.photo-item .lightbox-image').on('click', function(evt){
			evt.preventDefault();
			var elem_index = Number($(this).closest('.photo-item').attr('data-index'));
			var options = { index : elem_index, loop : true, shareButtons : false }
			var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
			gallery.init(elem_index);
		});
	}
	
	/**
	 * Ordenar array de objetos
	 * @link http://stackoverflow.com/a/1129270
	 * 
	 */
	function lightbox_compare( a, b ) {
		if( a.index < b.index ){
			return -1;
		}
		if( a.index > b.index ){
			return 1;
		}
		return 0;
	}
	
	/**
	 * Back to top
	 * 
	 */
	$('#menu-rodape .gototop a').click(function(e){
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, 500);
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
	
	
	/**
	 * Agenda: dropdown calendário
	 * 
	 */
	$('.table-events-dropdown').on('change', function(){
		window.top.location = $(this).val();
	});
	
	/**
	 * Agenda: mostrar popup ao clicar no evento
	 * 
	 */
	$('.event-btn-ovelay').on('click', function(){
		console.log(2);
		$('.event-popup').hide();
		$(this).closest('.performance-item').find('.event-pop-up').fadeIn();
	});
	
	/**
	 * Agenda: botão de fechar popup
	 * 
	 */
	$('.event-pop-up .glyphicon-remove').on('click', function(){
		$(this).closest('.performance-item').find('.event-pop-up').hide();
	});
	
	/**
	 * Agenda:click outside popup
	 * @link http://stackoverflow.com/a/7385673
	 * 
	 */
	$(document).mouseup(function (e){
		var container = $('.event-pop-up');

		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.hide();
		}
	});
	
	
});
