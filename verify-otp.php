<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$submittedOtp = preg_replace('/[^0-9]/', '', $data['otp'] ?? '');
$rawPhone = $data['phone'] ?? '';
$phone = substr(preg_replace('/[^0-9]/', '', $rawPhone), -10);

// Check if OTP session exists
if (!isset($_SESSION['2factor_session']) || !isset($_SESSION['otp_phone'])) {
    echo json_encode(['success' => false, 'message' => 'No active OTP request found. Please request a new OTP.']);
    exit;
}

// Check if the phone number matches the one we sent the OTP to
if ($_SESSION['otp_phone'] !== $phone) {
    echo json_encode(['success' => false, 'message' => 'Phone number mismatch. Please enter the same phone number.']);
    exit;
}

if (strlen($submittedOtp) < 4) {
    echo json_encode(['success' => false, 'message' => 'Please enter the complete OTP.']);
    exit;
}

$apiKey = "a377dfe4-53ca-11ef-8b60-0200cd936042";
$sessionId = $_SESSION['2factor_session'];

// 2Factor verify URL
$verifyUrl = "https://2factor.in/API/V1/" . $apiKey . "/SMS/VERIFY/" . $sessionId . "/" . $submittedOtp;

// Call 2Factor API to verify the OTP
$ch = curl_init($verifyUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);
$status = isset($responseData['Status']) ? strtolower($responseData['Status']) : '';
$details = isset($responseData['Details']) ? strtolower($responseData['Details']) : '';

if ($status === 'success' && strpos($details, 'matched') !== false) {
    // Success! Clear the OTP session
    unset($_SESSION['2factor_session']);
    unset($_SESSION['otp_phone']);
    
    $_SESSION['is_phone_verified'] = true;
    
    echo json_encode(['success' => true, 'message' => 'Phone verified successfully!']);
} else {
    $msg = 'Invalid OTP. Please check the code and try again.';
    if (!empty($responseData['Details'])) {
        $msg = $responseData['Details'];
    }
    echo json_encode([
        'success' => false, 
        'message' => $msg,
        'debug' => $responseData
    ]);
}
exit;
