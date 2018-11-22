<?php get_header();?>
<div class="archive category category-shishang category-4 grid-hover grid-radius grid-border nt_second_menu_height_100">
	<section class="nice-warp nice-warp-single my-4 my-md-5">
		<div class="container">
			<div class="filter-menu text-md-center mb-3 mb-lg-4-2">
				<ul class="d-flex flex-nowrap flex-md-wrap justify-content-md-center">
					<?php nines_taoke_keyword_output() ?>
				</ul>
			</div>
			<main>
				<div class="posts-list">
					<div class="list-inner home-list row list-xs-6 row-10 row-xs-15">
						<?php nines_taoke_template_output();?>
					</div>
				</div>
			</main>
		</div>
	</section>
	<div class="posts-ajax-load">
		<?php nines_taoke_page_output(); ?>
	</div>
</div>
<?php get_footer(); ?>
