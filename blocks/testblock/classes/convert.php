<?php

use Google\Cloud\Translate\TranslateClient;

/** Uncomment and populate these variables in your code */
// $text = 'The text to translate.';
// $targetLanguage = 'ja';  // Language to translate to
$text = $_POST;
$translate = new TranslateClient();
$result = $translate->translate($text, [
    'target' => $targetLanguage,
]);
print("Source language: $result[source]\n");
print("Translation: $result[text]\n");
echo $result[text];
?>