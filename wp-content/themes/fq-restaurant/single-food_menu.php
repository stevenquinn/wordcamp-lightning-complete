<?php get_header();?>

	<?php while (have_posts()): the_post();?>
		<h1><?php the_title();?></h1>
		<?php $startTime = get_field('start_time');?>
		<?php $endTime = get_field('end_time');?>
		
		<?php if (!empty($startTime) || !empty($endTime)): ?>
			<h2>
				<?php the_title();?> is served 
				<?php if ($startTime && $endTime): ?>
					between <?php the_field('start_time');?> and <?php the_field('end_time');?>
				<?php elseif ($startTime): ?>
					starting at <?php the_field('start_time');?>
				<?php elseif ($endTime): ?>
					ending at <?php the_field('end_time');?>
				<?php endif;?>
			</h2>
		<?php endif;?>
		
		
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<?php the_content();?>
			</div>
		</div>
		
		<?php $foodItems = fq_restaurant_get_food_menu_items(get_the_ID());?>
		<?php if ($foodItems->have_posts()): ?>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="divided">
						<div class="row">
							<?php $counter = 1;?>
							<?php while ($foodItems->have_posts()): $foodItems->the_post();?>
								<div class="col-sm-3">
									<div class="food-item">
										<div class="title">
											<a href="<?php the_permalink();?>">
												<?php the_title();?>
											</a>
										</div>
									</div>
								</div>
								<?php if ($counter % 4 == 0): ?>
						</div><div class="row">
								<?php endif;?>
								<?php $counter++;?>
							<?php endwhile;?>
						</div>
					</div>
				</div>
			</div>
		<?php endif;?>
		
		
	<?php endwhile;?>
	
<?php get_footer(); ?>