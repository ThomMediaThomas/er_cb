<label for="select_year" class="screen-reader-text">Kies een jaar</label>
<select name="select_year" id="select_year">
	<?php
	for ($index = 1; $index <= count($years); $index++) {
		$selected = '';
		if ($years[$index-1] == $selected_year) {
			$selected = ' selected';
		}
		echo '<option value="' . $years[$index-1] .'" ' . $selected . '>' . $years[$index-1] . '</option>';
	}
	?>
</select>