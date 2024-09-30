<?php
// Set the OpenAI API key
$api_key = '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';  // Replace with your actual API key

// Default values for phrase and language
$default_phrase = "My name is Reece Roskam and I am a web developer in Grand Rapids, Michigan";
$default_language = "Spanish";

// Get the phrase from the $_GET parameter or use default
$phrase = isset($_GET['phrase']) ? $_GET['phrase'] : $default_phrase;

// Get the language from the $_GET parameter or use default
$language = isset($_GET['language']) ? ucfirst(strtolower($_GET['language'])) : $default_language;

// Prepare the prompt for translation
$prompt = "Translate the following phrase into $language: '$phrase'";

// OpenAI API URL
$url = 'https://api.openai.com/v1/chat/completions';

// Data to send to the API
$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            'role' => 'system',
            'content' => 'You are a helpful assistant that translates English phrases to other languages.'
        ],
        [
            'role' => 'user',
            'content' => $prompt
        ]
    ],
    'temperature' => 0.7
];

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $api_key,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    echo 'Error: ' . curl_error($ch);
    exit;
}

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$response_data = json_decode($response, true);

// Check if the response contains the translation
if (isset($response_data['choices'][0]['message']['content'])) {
    $translation = trim($response_data['choices'][0]['message']['content']);
    echo "<h1>Translated Phrase:</h1>";
    echo "<p><strong>Original Phrase:</strong> $phrase</p>";
    echo "<p><strong>Translation ($language):</strong> $translation</p>";
} else {
    echo "<p>Translation failed. Please try again later.</p>";
}
