<label for=select_month" class="screen-reader-text">Kies een maand</label>
<select name="select_month" id="select_month">
	<?php
	for ($index = 1; $index <= 12; $index++) {
		$selected = '';
		if ($index == $selected_month) {
			$selected = ' selected';
		}
		echo '<option value="' . $index .'" ' . $selected . '>' . $months[$index-1]. '</option>';
	}
	?>
</select>