<?php
$file = 'user_data.json';

// JSON file se existing data load karna
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Input fields
$user_id = $_POST['user_id'] ?? '';
$user_name = $_POST['user_name'] ?? 'Unknown';
$country = $_POST['country'] ?? 'Unknown';
$completed_tasks = $_POST['completed_tasks'] ?? 0;
$last_earning = $_POST['last_earning'] ?? 0;
$cooldown_time = $_POST['cooldown_time'] ?? 0;

if ($user_id) {
    // Existing user data update karna ya naya add karna
    if (!isset($data[$user_id])) {
        $data[$user_id] = [
            'user_name' => $user_name,
            'country' => $country,
            'completed_tasks' => 0,
            'last_earning' => 0,
            'cooldown_time' => 0,
        ];
    }

    // Update fields
    $data[$user_id]['user_name'] = $user_name;
    $data[$user_id]['country'] = $country;
    $data[$user_id]['completed_tasks'] = $completed_tasks;
    $data[$user_id]['last_earning'] = $last_earning;
    $data[$user_id]['cooldown_time'] = $cooldown_time;

    // JSON file update karna
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Response bhejna
header('Content-Type: application/json');
echo json_encode($data[$user_id] ?? []);
?>
