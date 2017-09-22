<div class="box">
	
	<div class="food-items-container">
		<ul id="food-items">
			<?php if ($foodItems->have_posts()): ?>
				<?php $counter = 0;?>
				<?php while ($foodItems->have_posts()): $foodItems->the_post();?>
				
					<li class="food-item clearfix">
							<div class="fields">
								<h4><span class="title"><?php the_title();?></span> - $<span class="price"><?php print get_post_meta(get_the_ID(), '_price', TRUE);?></span></h4>
								<div class="description"><?php the_content();?></div>
							</div>
							<div class="buttons">
								<ul>
									<li><button type="button" class="button button-secondary edit">Edit</button></li>
									<li><button type="button" class="button button-secondary delete">Delete</button></li>
								</ul>
							</div>
							
							<div class="food-editor">
							<div class="additional-fields">
								<p>
									<input type="text" name="fooditem[<?php print $counter;?>][title]" class="widefat title-input" placeholder="Food item title" value="<?php the_title();?>">
								</p>
								<p>
									<label>Price</label>
									<input type="text" name="fooditem[<?php print $counter;?>][price]" class="widefat price-input" value="<?php print get_post_meta(get_the_ID(), '_price', TRUE);?>">
								</p>
								<p>
									<label>Description</label>
									<textarea name="fooditem[<?php print $counter;?>][description]" class="widefat description-input"><?php print htmlentities(get_the_content());?></textarea>
								</p>
								<p>
									<button type="button" class="button button-secondary cancel-food-editor">Cancel</button>
									<button type="button" class="button button-primary update-food-item">Update</button>
								</p>
								
								<input type="hidden" name="fooditem[<?php print $counter;?>][id]" value="<?php the_ID();?>">
							</div>
						</div>
						
					</li>
					
					<?php $counter++;?>
				<?php endwhile;?>
			<?php endif;?>
		</ul>
	</div>
	
	
	
	<!-- the editor for adding new food items -->
	<div class="clearfix">
		<div class="food-editor">
			<p>
				<input type="text" name="title" class="widefat title" placeholder="Add a new food item...">
			</p>
			
			<!-- these fields are initially hidden -->
			<div class="additional-fields">
				<p>
					<label>Price</label>
					<input type="text" name="price" class="widefat price">
				</p>
				<p>
					<label>Description</label>
					<textarea name="description" class="widefat description"></textarea>
				</p>
				<p>
					<button type="button" class="button button-secondary cancel-food-editor">Cancel</button>
					<button type="button" class="button button-primary add-food-item">Add Food Item</button>
				</p>
			</div>
			<!-- end hidden fields -->
		</div>
	</div>
	<!-- end editor -->
	
</div>



<!-- template for adding HTML for food items -->
<div id="food-item-template">
	<div class="fields">
		<h4><span class="title"></span> - $<span class="price"></span></h4>
		<div class="description"></div>
	</div>
	<div class="buttons">
		<ul>
			<li><button type="button" class="button button-secondary edit">Edit</button></li>
			<li><button type="button" class="button button-secondary delete">Delete</button></li>
		</ul>
	</div>
	
	<input type="hidden" name="" class="title-input" value="">
	<input type="hidden" name="" class="price-input" value="">
	<input type="hidden" name="" class="description-input" value="">
</div>
<!-- end template -->