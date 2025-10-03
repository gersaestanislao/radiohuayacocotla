<?php
// test-v2.php — prueba de client_id en entorno local (huayaWP)
define('WP_USE_THEMES', false);
require_once __DIR__ . '/wp-load.php';

header('Content-Type: text/plain; charset=utf-8');

// ⚠️ Pega aquí tu client_id de SoundCloud (después de actualizar Redirect URI)
$client_id = 'wTIiUvEYYO5TRNTpJW5F6Jdo3LpDakaj';

// URL del set/playlist a resolver
$public_url = 'https://soundcloud.com/user-617767172/sets/no-es-un-favor-es-un-derecho';

// Endpoint API v2 con tu client_id
$url = add_query_arg([
  'url' => $public_url,
  'client_id' => $client_id,
], 'https://api-v2.soundcloud.com/resolve');

// Ejecuta la petición
$r = wp_remote_get($url, [
  'timeout' => 20,
  'headers' => [
    'Accept' => 'application/json',
    'User-Agent' => 'Mozilla/5.0 (WordPress huayaWP test)',
  ],
]);

// Muestra resultados
if (is_wp_error($r)) {
  echo "WP_Error: " . $r->get_error_message() . "\n";
  exit;
}

$code = wp_remote_retrieve_response_code($r);
$body = wp_remote_retrieve_body($r);

echo "HTTP: $code\n";
echo "Len: " . strlen($body) . "\n\n";

// Mostrar primeros caracteres para inspección
echo substr($body, 0, 800) . "\n";
