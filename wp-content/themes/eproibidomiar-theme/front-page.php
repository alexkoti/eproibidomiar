<?php get_header(); ?>

<section id="main-slider" class="no-margin">
	<a class="prev slider-prev-next hidden-xs" href="#owl-slider">
		<i class="icon-angle-left"></i>
	</a>
	<a class="next slider-prev-next hidden-xs" href="#owl-slider">
		<i class="icon-angle-right"></i>
	</a>
	<div id="owl-slider" class="owl-carousel owl-theme">
		<div class="item" id="slider-item-0"></div>
		<div class="item" id="slider-item-1"></div>
		<div class="item" id="slider-item-2"></div>
		<div class="item" id="slider-item-3"></div>
	</div>
</section>

<section id="services">
	<div class="container">
		<div class="row">
			<?php
			$chamadas = array(
				1 => 'libras', 
				2 => 'cidade', 
				3 => 'calendario'
			);
			foreach( $chamadas as $i => $icon ){
				$class = "icon-{$icon} icon-md";
				$title = get_option("home_feature_{$i}_title");
				$text  = get_option("home_feature_{$i}_text");
				$link  = get_permalink(get_option("home_feature_{$i}_link"));
			?>
			<div class="col-md-4 col-sm-6">
				<div class="media">
					<div class="pull-left">
						<i class="<?php echo $class; ?>"></i>
					</div>
					<div class="media-body">
						<h3 class="media-heading"><?php echo $title; ?></h3>
						<p><?php echo $text; ?></p>
					</div>
					<a href="<?php echo $link; ?>"></a>
				</div>
			</div><!--/.col-md-4-->
			<?php } ?>
		</div>
	</div>
</section><!--/#services-->

<section id="home-photos">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<h3>Conheça os artistas, acompanhe nossa trajetória.</h3>
				<p>Veja o espetáculo e tire fotos com os personagens (e elenco) mais fofos que você já viu!</p>
				<div class="btn-group owl-navigation">
					<a class="btn btn-danger" href="#scroller" data-slide="prev"><i class="icon-angle-left"></i></a>
					<a class="btn btn-danger" href="#scroller" data-slide="next"><i class="icon-angle-right"></i></a>
				</div>
				<p class="gap"></p>
			</div>
			<div class="col-md-9">
				<div class="owl-carousel" id="owl-home-photos">
					<?php
					$home_photos = get_option('home_photos');
					if( !empty($home_photos) ){
						$photos = explode( ',', $home_photos );
						$i = 1;
						foreach( $photos as $photo ){
							$p = get_post($photo);
							$photo_thumb = get_post_meta($photo, '_thumbnail_id', true);
							$src = wp_get_attachment_image_src($photo_thumb, 'post-thumbnail');
							echo "<div class='item' id='slider-photo-{$i}'><div class='inner'><img src='{$src[0]}' class='img-responsive' alt='' /><div class='caption'>{$p->post_title}</div></div></div>";
							$i++;
						}
					}
					?>
				</div>
			</div>
		</div><!--/.row-->
	</div>
</section><!--/#photos-->

<?php
$testimonials = get_option('home_testimonials');
if( !empty($testimonials) ){
?>
<section id="testimonial">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="center">
					<h2>E o que dizem sobre a gente?</h2>
					<p>Venha nos assistir pra saber se você concorda com eles...</p>
				</div>
				<div class="gap"></div>
				<div class="row">
					<?php
					echo '<div class="col-md-6">';
					$i = 1;
					foreach( $testimonials as $t ){
					?>
					<blockquote>
						<p><?php echo $t['text'] ?></p>
						<small><?php echo $t['author'] ?></small>
					</blockquote>
					<?php
						if( $i == 2 ){ echo '</div><div class="col-md-6">';}
						else{$i++;}
					}
					echo '</div>';
					?>
				</div>
			</div>
		</div>
	</div>
</section><!--/#testimonial-->
<?php } ?>

<section id="sponsors">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="center">
					<h2>Patrocinadores e Apoiadores</h2>
					<p>Sem eles não seria possível ou talvez não fosse a mesma coisa.</p>
				</div>
				<p class="gap"></p>
				<div class="row">
					<div class="col-md-6">
						<blockquote>
							<p>Financiamento</p>
							<?php
							$home_financing = get_option('home_financing');
							if( !empty($home_financing) ){
								foreach( $home_financing as $financing ){
									$img = wp_get_attachment_image_src($financing['image'], 'full');
									echo "<a href='{$financing['link']}' target='_blank'><img src='{$img[0]}' title='{$financing['name']}' alt='{$financing['name']}' /></a>";
								}
							}
							?>
						</blockquote>
					</div>
					<div class="col-md-6">
						<blockquote>
							<p>Apoiadores e parceiros</p>
							<?php
							$home_partners = get_option('home_supporters_partners');
							if( !empty($home_partners) ){
								foreach( $home_partners as $partner ){
									$img = wp_get_attachment_image_src($partner['image'], 'full');
									echo "<a href='{$partner['link']}' target='_blank'><img src='{$img[0]}' title='{$partner['name']}' alt='{$partner['name']}' /></a>";
								}
							}
							?>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!--/#testimonial-->

<?php get_footer(); ?>