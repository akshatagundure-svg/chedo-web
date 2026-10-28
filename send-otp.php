<?php
session_start();
header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// Get JSON POST data
$data = json_decode(file_get_contents('php://input'), true);
$phone = $data['phone'] ?? '';

// Basic phone number validation and sanitization
$rawPhone = $data['phone'] ?? '';
$phone = substr(preg_replace('/[^0-9]/', '', $rawPhone), -10);

if (empty($phone) || strlen($phone) !== 10) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid 10-digit mobile number.']);
    exit;
}

// Generate a random 6-digit OTP
$otp = rand(100000, 999999);

// Save the OTP in the session securely to verify it later
$_SESSION['otp'] = $otp;
$_SESSION['otp_phone'] = $phone;
$_SESSION['otp_time'] = time();

$apiKey = "a377dfe4-53ca-11ef-8b60-0200cd936042";
$apiUrl = "https://2factor.in/API/V1/" . $apiKey . "/SMS/" . $phone . "/AUTOGEN/OTP1";

// Call 2Factor API to send the OTP
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

$responseData = json_decode($response, true);

if ($responseData && isset($responseData['Status']) && strtolower($responseData['Status']) === 'success') {
    // 2Factor returns a 'Details' field which is the Session ID needed for verification
    $_SESSION['2factor_session'] = $responseData['Details'];
    $_SESSION['otp_phone'] = $phone;
    
    echo json_encode([
        'success' => true,
        'message' => 'OTP sent successfully!'
    ]);
} else {
    $msg = 'Failed to send OTP via provider. Please try again.';
    if (!empty($responseData['Details'])) {
        $msg = $responseData['Details'];
    }
    echo json_encode([
        'success' => false,
        'message' => $msg,
        'error' => $responseData ?? $err
    ]);
}
exit;
