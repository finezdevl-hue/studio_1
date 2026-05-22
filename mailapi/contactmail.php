<?php

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed.',
    ]);
    exit;
}

function clean_input(string $value): string
{
    return trim(str_replace(["\r", "\n"], ' ', $value));
}

$firstName = clean_input($_POST['first_name'] ?? '');
$lastName = clean_input($_POST['last_name'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone = clean_input($_POST['phone'] ?? '');
$service = clean_input($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($firstName === '' || $lastName === '' || $email === '' || $service === '' || $message === '') {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.',
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Please enter a valid email address.',
    ]);
    exit;
}

$to = 'hello@zillalstudio.com';
$subject = 'New Contact Form Submission - Zillal Studio';

$bodyLines = [
    "First Name: {$firstName}",
    "Last Name: {$lastName}",
    "Email: {$email}",
    "Phone: {$phone}",
    "Service Required: {$service}",
    '',
    'Message:',
    $message,
];

$body = implode("\r\n", $bodyLines);

$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    "From: Zillal Studio Website <{$to}>",
    "Reply-To: {$email}",
];

$sent = mail($to, $subject, $body, implode("\r\n", $headers));

if (!$sent) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Message could not be sent right now. Please try again later.',
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Message sent successfully.',
]);
