<?php get_header(); ?>

<section id="main-slider" class="no-margin">
	<a class="prev slider-prev-next hidden-xs" href="#owl-slider">
		<i class="icon-angle-left"></i>
	</a>
	<a class="next slider-prev-next hidden-xs" href="#owl-slider">
		<i class="icon-angle-right"></i>
	</a>
	<div id="owl-slider" class="owl-carousel owl-theme">
		<?php
		$slides = get_option('home_slider');
		$i = 1;
		if( !empty($slides) ){
			foreach( $slides as $s ){
				$img_xs = wp_get_attachment_image_src($s['image_xs'], 'slider-xs');
				$img_sm = wp_get_attachment_image_src($s['image_sm'], 'slider-sm');
				$img_md = wp_get_attachment_image_src($s['image_md'], 'slider-md');
				$img_lg = wp_get_attachment_image_src($s['image_lg'], 'slider-lg');
				echo "<div class='item' id='slider-item-{$i}'>";
				echo "<div class='item-image item-xs' style='background-image:url({$img_xs[0]});'></div>";
				echo "<div class='item-image item-sm' style='background-image:url({$img_sm[0]});'></div>";
				echo "<div class='item-image item-md' style='background-image:url({$img_md[0]});'></div>";
				echo "<div class='item-image item-lg' style='background-image:url({$img_lg[0]});'></div>";
				echo "</div>";
			}
		}
		?>
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
			<div class="col-md-3 call-to-action">
				<h3><a href="<?php page_permalink_by_name('fotos'); ?>">Conheça os artistas, acompanhe nossa trajetória.</a></h3>
				<p><a href="<?php page_permalink_by_name('fotos'); ?>">Veja o espetáculo e tire fotos com os personagens (e elenco) mais fofos que você já viu!</a></p>
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
						$i = 0;
						foreach( $photos as $photo ){
							$post = get_post($photo);
							setup_postdata($post);
							include('photo-item.php');
							wp_reset_postdata();
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
$testimonials_opt = get_option('home_testimonials');
if( !empty($testimonials_opt) ){
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
					$testimonials = new WP_Query( array('post_type' => 'post', 'post__in' => explode(',', $testimonials_opt), 'orderby' => 'post__in') );
					$i = 1;
					foreach( $testimonials->posts as $t ){
						if( $i == 3 ){ echo '</div><div class="row">';}
						else{$i++;}
					?>
					<div class="col-md-6">
						<blockquote>
							<p><?php echo apply_filters('the_title', $t->post_title); ?></p>
							<small><?php echo get_post_meta($t->ID, 'testimonial_author', true); ?></small>
						</blockquote>
					</div>
					<?php
					}
					wp_reset_query();
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
				</div>
			</div>
		</div>
	</div>
</section><!--/#testimonial-->

<?php get_footer(); ?>