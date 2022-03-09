<?php
// Generate a random string to be used in CAPTCHAs
// Adapted from source: https://code.tutsplus.com/tutorials/build-your-own-captcha-and-contact-form-in-php--net-5362
$permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';

function generate_string($input, $strength = 10) {
	$input_length = strlen($input);
	$random_string = '';
	for ($i = 0; $i < $strength; $i++) {
		$random_character = $input[mt_rand(0, $input_length - 1)];
		$random_string .= $random_character;
	}

	return $random_string;
}

$string_length = 6;
$captcha_string = generate_string($permitted_chars, $string_length);

return $captcha_string;
