<?php
// Set the OpenAI API key
$api_key = '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';  

// Check if the request is POST and contains 'phrase' and 'language'
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['phrase']) && isset($_POST['language'])) {
    $phrase = $_POST['phrase'];
    $language = ucfirst(strtolower($_POST['language'])); 

    // Prepare the prompt for ChatGPT
    $prompt = "Translate the following phrase into $language: '$phrase'";

    // OpenAI API URL
    $url = 'https://api.openai.com/v1/chat/completions';

    // Data to send to the API
    $data = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'system',
                'content' => 'You are a helpful assistant that translates English phrases into other languages.'
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
        echo $translation;  // Output the translation as the response
    } else {
        echo 'Translation failed. Please try again later.';
    }
} else {
    echo 'Invalid request. Please provide a phrase and language.';
}
