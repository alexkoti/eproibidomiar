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
				<div class="btn-group">
					<a class="btn btn-danger" href="#scroller" data-slide="prev"><i class="icon-angle-left"></i></a>
					<a class="btn btn-danger" href="#scroller" data-slide="next"><i class="icon-angle-right"></i></a>
				</div>
				<p class="gap"></p>
			</div>
			<div class="col-md-9">
				<div id="scroller" class="carousel slide">
					<div class="carousel-inner">
						<div class="item active">
							<div class="row">
								<div class="col-xs-4">
									<div class="portfolio-item">
										<div class="item-inner">
											<img class="img-responsive" src="<?php echo THEME; ?>/images/portfolio/recent/item1.png" alt="">
											<h5>Nova - Corporate site template</h5>
											<div class="overlay">
												<a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="<?php echo THEME; ?>/images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="portfolio-item">
										<div class="item-inner">
											<img class="img-responsive" src="<?php echo THEME; ?>/images/portfolio/recent/item3.png" alt="">
											<h5>Nova - Corporate site template</h5>
											<div class="overlay">
												<a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="<?php echo THEME; ?>/images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="portfolio-item">
										<div class="item-inner">
											<img class="img-responsive" src="<?php echo THEME; ?>/images/portfolio/recent/item2.png" alt="">
											<h5>Nova - Corporate site template</h5>
											<div class="overlay">
												<a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="<?php echo THEME; ?>/images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div><!--/.row-->
						</div><!--/.item-->
						<div class="item">
							<div class="row">
								<div class="col-xs-4">
									<div class="portfolio-item">
										<div class="item-inner">
											<img class="img-responsive" src="<?php echo THEME; ?>/images/portfolio/recent/item2.png" alt="">
											<h5>Nova - Corporate site template</h5>
											<div class="overlay">
												<a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="<?php echo THEME; ?>/images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="portfolio-item">
										<div class="item-inner">
											<img class="img-responsive" src="<?php echo THEME; ?>/images/portfolio/recent/item1.png" alt="">
											<h5>Nova - Corporate site template</h5>
											<div class="overlay">
												<a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="<?php echo THEME; ?>/images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-4">
									<div class="portfolio-item">
										<div class="item-inner">
											<img class="img-responsive" src="<?php echo THEME; ?>/images/portfolio/recent/item3.png" alt="">
											<h5>Nova - Corporate site template</h5>
											<div class="overlay">
												<a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="<?php echo THEME; ?>/images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!--/.item-->
					</div>
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