<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// استقبال الرابط من الصفحة
$input = json_decode(file_get_contents('php://input'), true);
$targetUrl = $input['url'] ?? '';

if (empty($targetUrl)) {
    echo json_encode(['error' => 'الرابط مطلوب']);
    exit;
}

// إعدادات الـ API
$apiKey = 'c107978669msh8c9b80d11a0150dp1b0b56jsn6b0f9128b487';
$apiHost = 'instagram120.p.rapidapi.com';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => "https://instagram120.p.rapidapi.com/api/instagram/links",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode(['url' => $targetUrl]),
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "x-rapidapi-host: $apiHost",
        "x-rapidapi-key: $apiKey"
    ],
]);

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    echo json_encode(['error' => 'فشل الاتصال: ' . $err]);
} else {
    echo $response;
}
?>
