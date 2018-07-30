<?php

 function getFieldSelectLabel($field, $post_id)
 {
	$field = get_field_object($field, $post_id);
	$value = $field['value'];
	$label = $field['choices'][ $value ];
	return $label;
 }