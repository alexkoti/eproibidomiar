<?php
/**
 * Template Name: Ficha Técnica
 * 
 */

get_header();

$profile_placeholder = get_template_directory_uri() . '/images/ficha-tecnica/profile-placeholder.png';
$blocks = array(
	array(
		'name' => 'creators',
		'cols' => 'col-md-6 col-sm-6',
	),
	array(
		'name' => 'cast',
		'cols' => 'col-md-3 col-sm-6',
	),
	array(
		'name' => 'accessibility',
		'cols' => 'col-md-4 col-sm-6',
	),
	array(
		'name' => 'technicians',
		'cols' => 'col-md-3 col-sm-6',
	),
	array(
		'name' => 'author',
		'cols' => 'col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12',
	),
);
?>

<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Ficha Técnica</h1>
			</div>
		</div>
	</div>
</div>

<?php foreach( $blocks as $profiles ){ ?>
<div class="profiles-box profiles-<?php echo $profiles['name']; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				opt_option("profiles-{$profiles['name']}-title", '<h2 class="profiles-title">%s</h2>');
				opt_option("profiles-{$profiles['name']}-subtitle", '<h3 class="profiles-subtitle">%s</h3>');
				$items = get_option("profiles-{$profiles['name']}-items");
				echo '<div class="row">';
				$i = 1;
				foreach( $items as $item ){
					$img = wp_get_attachment_image_src($item['image'], 'post-thumbnail');
					$img_tag = ( !empty($img) ) ? "<img src='{$img[0]}' alt='{$item['name']}' class='img-responsive' />" : "<img src='{$profile_placeholder}' alt='{$item['name']}' class='img-responsive' />";
					?>
					<div class="<?php echo $profiles['cols']; ?> profile-item profile-<?php echo $profiles['name']; ?>">
						<div class="profile-photo"><?php echo $img_tag; ?></div>
						<h2 class="profile-name"><?php echo $item['name']; ?></h2>
						<h3 class="profile-function"><?php echo $item['function']; ?></h3>
						<div class="profile-text"><?php echo apply_filters('the_content', $item['text']); ?></div>
					</div>
					<?php
					if( $i % 4 ==  0 ){ echo '<div class="separator col-md-12 visible-md visible-lg"></div>'; }
					if( $i % 2 ==  0 ){ echo '<div class="separator col-md-12 visible-sm"></div>'; }
					$i++;
				}
				echo '</div>';
				?>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<?php get_footer(); ?>