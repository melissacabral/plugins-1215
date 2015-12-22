<div class="wrap">
	<h2>Promo Bar</h2>

	<form action="options.php" method="post">
		<?php 
		//attach the registered settings group to this form
		settings_fields('rad_promo_bar_group');
		//get the current values, so the fields can 'stick'
		$values = get_option( 'rad_promo_bar' ); ?>

		<h3>Preview:</h3>

		<div id="sample" style="background:<?php echo $values['barcolor']; ?>;color:white; text-align:center;padding:.25em;max-width:900px"><?php echo $values['bartext'] ?> <span style="background:<?php echo $values['buttoncolor'];?>;display:inline-block; padding:.25em;border-radius:.25em;"><?php echo $values['buttontext']; ?></span></div>
		<h3>Settings:</h3>
		<label>Text for the bar:</label>
		<input type="text" name="rad_promo_bar[bartext]" 
		value="<?php echo $values['bartext'] ?>" class="regular-text">

		<br>

		<label>Text for the button:</label>
		<input type="text" name="rad_promo_bar[buttontext]" 
		value="<?php echo $values['buttontext'] ?>" class="regular-text">

		<br>

		<label>URL for the button:</label>
		<input type="url" name="rad_promo_bar[url]" 
		value="<?php echo $values['url'] ?>" class="regular-text">
		
		<br>

		<h3>Color Customization:</h3>
		


		<label>Color for the bar:</label>
		<input type="text" name="rad_promo_bar[barcolor]" 
		value="<?php echo $values['barcolor'] ?>" class="color-field color-bar">
		<br>
		<label>Color for the button:</label>
		<input type="text" name="rad_promo_bar[buttoncolor]" 
		value="<?php echo $values['buttoncolor'] ?>" class="color-field color-button">
		<br>

		

		<?php submit_button( 'Save Settings' ); ?>

	</form>
</div>