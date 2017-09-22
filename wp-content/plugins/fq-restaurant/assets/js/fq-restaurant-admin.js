(function($) {
	
	$(document).ready(function() {
		initEditor();
	});
	
	
	
	
	
	
	function initEditor() {
		if ( $('.food-editor').length > 0 ) {
			
			// Show the additional fields when focusing on the editor field
			$('body').on('focus', '.food-editor .title', function() {
				$(this).closest('.food-editor').find('.additional-fields').show();
			});
			
			// Hide the editor when hitting the cancel button
			$('body').on('click', '.food-editor .cancel-food-editor', function() {
				// Clear the form
				var editor = $(this).closest('.food-editor');
				clearEditor(editor);
				
				// Hide the editor form
				hideEditor(editor);
				
				var foodItem = $(editor).closest('.food-item');
				
				if (foodItem.length > 0) {
					$(foodItem).find('.fields').show();
					$(foodItem).find('.buttons').show();
					$(foodItem).find('.food-editor').hide();
					
					// Reset the form field
					var title = $(foodItem).find('.title').text();
					var price = $(foodItem).find('.price').text();
					var description = $(foodItem).find('.description').text();
					$(foodItem).find('.title-input').val(title);
					$(foodItem).find('.price-input').val(price);
					$(foodItem).find('.description-input').val(description);
				}
			});
			
			// Adding a new food item to the list
			$('body').on('click', '.add-food-item', function() {
				var editor = $(this).closest('.food-editor');
				
				// Check if we can submit the form (needs title)
				if ($(editor).find('.title').val() == '') {
					// Handle the error
					return;
				}
				
				// Get the fields
				var title = $(editor).find('.title').val();
				var price = $(editor).find('.price').val();
				var description = $(editor).find('.description').val();
				
				// Add it to the template
				var newItem = $('#food-item-template').clone();
				$(newItem).find('.title').text(title);
				$(newItem).find('.price').text(price);
				$(newItem).find('.description').text(description);
				$(newItem).find('.title-input').val(title);
				$(newItem).find('.price-input').val(price);
				$(newItem).find('.description-input').val(description);
				
				// Add it to the list
				$('#food-items').append('<li class="food-item clearfix">' + $(newItem).html() + '</li>');
				
				// Update the input fields
				updateFoodOrder();
				
				// Clear the editor form
				clearEditor(editor);
				
				// Hide it
				hideEditor(editor);
			});
			
			// Delete a food item
			$('body').on('click', '.food-item .delete', function() {
				$(this).closest('.food-item').remove();
			});
			
			// Edit food item
			$('body').on('click', '.food-item .edit', function() {
				var foodItem = $(this).closest('.food-item');
				
				// Show the editor
				$(foodItem).find('.food-editor').show();
				$(foodItem).find('.additional-fields').show();
				
				// Hide the display items
				$(foodItem).find('.fields').hide();
				$(foodItem).find('.buttons').hide();
			});
			
			// Allow sorting
			$('#food-items').sortable({
				change: function(event, ui) {
		            updateFoodOrder();
		        },
			});
			
		}
	}
	
	
	function clearEditor(editor) {
		$(editor).find('.title').val('');
		$(editor).find('.price').val('');
		$(editor).find('.description').val('');
	}
	
	function hideEditor(editor) {
		$(editor).find('.additional-fields').hide();
	}
	
	function updateFoodOrder() {
		// Loop through all the food items
		$('.food-item').each(function(index) {
			var foodItem = $(this);
			$(foodItem).find('.title-input').attr('name', 'fooditem[' + index + '][title]');
			$(foodItem).find('.price-input').attr('name', 'fooditem[' + index + '][price]');
			$(foodItem).find('.description-input').attr('name', 'fooditem[' + index + '][description]');
		});
	}
	
	
})(jQuery)