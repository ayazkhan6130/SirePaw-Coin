<?php
$dataFile = "users-data.json";

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

$data = json_decode(file_get_contents($dataFile), true);
$requestData = json_decode(file_get_contents("php://input"), true);

$userName = $requestData["name"];
$userCountry = $requestData["country"];

$found = false;
foreach ($data as &$user) {
    if ($user["name"] === $userName) {
        $user["tasksCompleted"] += 1;
        $user["country"] = $userCountry; // Country update karein
        $found = true;
        break;
    }
}

if (!$found) {
    $data[] = ["name" => $userName, "tasksCompleted" => 1, "country" => $userCountry];
}

file_put_contents($dataFile, json_encode($data));
?>
