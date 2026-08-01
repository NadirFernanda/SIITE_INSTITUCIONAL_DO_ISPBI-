<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

/** @var \App\Services\WhatsAppService $w */
$w = app(\App\Services\WhatsAppService::class);

try {
    echo "Calling WhatsAppService::enviar()...\n";
    $w->enviar('922408061', 'Teste Laravel ISP-Bié');
    echo "Done.\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
