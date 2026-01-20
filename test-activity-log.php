<?php

// Test Activity Log
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->boot();

use Spatie\Activitylog\Models\Activity;
use App\Models\User;

echo "=== TESTING ACTIVITY LOG ===\n\n";

// Cek total logs
$totalLogs = Activity::count();
echo "Total Activity Logs: $totalLogs\n\n";

// Cek 5 log terakhir
echo "5 Log Terakhir:\n";
echo str_repeat("-", 80) . "\n";

Activity::latest()->take(5)->get()->each(function($log) {
    echo "ID: {$log->id}\n";
    echo "Log Name: {$log->log_name}\n";
    echo "Event: {$log->event}\n";
    echo "Description: {$log->description}\n";
    echo "Causer Type: {$log->causer_type}\n";
    echo "Causer ID: {$log->causer_id}\n";
    echo "Created At: {$log->created_at}\n";
    
    if ($log->causer) {
        echo "User: {$log->causer->n_wbls_adm}\n";
        echo "Role: {$log->causer->c_wbls_admauth}\n";
    } else {
        echo "User: [No causer found]\n";
    }
    
    echo str_repeat("-", 80) . "\n";
});

// Test manual logging
echo "\nTest Manual Activity Log:\n";
activity('test_log')
    ->log('Test manual log from script');
echo "✓ Manual log created successfully\n";

$newTotal = Activity::count();
echo "Total logs after test: $newTotal\n";

echo "\n=== TEST COMPLETED ===\n";
