<?php

function smarty_modifier_get_encoded_url($tt='') {
	return base64_encode($_SERVER['REQUEST_URI']);
}

?>