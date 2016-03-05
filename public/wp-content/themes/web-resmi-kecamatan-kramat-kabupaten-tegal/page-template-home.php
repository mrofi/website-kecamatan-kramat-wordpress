<?php
/*
Template Name: Home Page
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">
    
    <div id="header-homepage" class="et_pb_section  et_pb_section_0 et_pb_with_background et_section_regular" style="padding: 0;">
				
				
					
					<div class=" et_pb_row et_pb_row_0">
				
				<div class="et_pb_column et_pb_column_4_4 et_pb_column_0">
				<div class="et_pb_promo et_pb_module et_pb_bg_layout_dark et_pb_text_align_center  et_pb_cta_0 et_pb_no_bg">
				<div class="et_pb_promo_description">
					
					

<h1 class="website-title">
WEBSITE RESMI<br>
PEMERINTAH KECAMATAN KRAMAT KABUPATEN TEGAL</h1>
<div class="website-subtitle">Selamat datang di Portal Digital &amp; Forum Komunikasi<br>
Masyarakat Kramat Kabupaten Tegal</div>


				</div>
				<!--<a class="et_pb_promo_button et_pb_button" href="/tentang-kami">Profile Kecamatan Kramat</a>-->
			</div>
			
			</div> <!-- .et_pb_column -->
					
			</div> <!-- .et_pb_row -->
				
			</div>
			
			
			<!--DOWNLOAD-->
			<div class="et_pb_section  et_pb_section_0 et_pb_with_background et_section_regular" style="padding: 0; background-color: #333;">
			<div class=" et_pb_row et_pb_row_0" style="padding: 10px 0;">
			<div class="et_pb_column et_pb_column_4_4 et_pb_column_0">
			<div class="et_pb_promo et_pb_module et_pb_bg_layout_dark et_pb_text_align_center  et_pb_cta_0 et_pb_no_bg">
					<h3><i class="fa fa-download fa-lg"></i> Untuk Download RPJMDes se-Kecamatan Kramat - Kabupaten Tegal <a class="et_pb_promo_button et_pb_button" href="/download">Klik di sini</a></h3>
			</div>
			</div>
			</div>
			</div>

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="main_title" style="font-weight: 600; font-size: 2em;"><?php the_title(); ?></h1>

				<?php endif; ?>
<?php

$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
if ($url) {?>  
    <style type="text/css">
        #header-homepage {
            background-image: url(<?php echo $url; ?>)!important;
        }
    </style>

                        
<?php } ?>

					<div class="entry-content">
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>