<?php
$latitude = $_GET['lat'] ?? null;
$longitude = $_GET['lon'] ?? null;

if ($latitude !== null && $longitude !== null) {
    $geocodingApiUrl = "https://nominatim.openstreetmap.org/reverse?lat={$latitude}&lon={$longitude}&format=json";
    $geocodingData = json_decode(@file_get_contents($geocodingApiUrl), true);

    if ($geocodingData !== null) {
        $cidade = $geocodingData['address']['city'] ?? $geocodingData['address']['town'] ?? $geocodingData['address']['village'] ?? null;

        if ($cidade !== null) {
            echo "Cidade encontrada: " . $cidade;
        } else {
            echo "Cidade desconhecida";
        }
    } else {
        echo "Erro ao obter dados do serviço de geocodificação.";
    }
} else {
    echo "Latitude e/ou longitude não fornecidas.";
}
?>
