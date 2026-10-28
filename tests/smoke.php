<?php

$base = rtrim($argv[1] ?? 'http://company-profile.test', '/');
$routes = ['/', '/tentang-kami', '/produk-layanan', '/pengurus', '/berita', '/kontak', '/sitemap.xml', '/robots.txt'];
$failed = 0;

foreach ($routes as $route) {
    $headers = @get_headers($base.$route);
    $status = $headers[0] ?? 'unreachable';
    preg_match('/\s(\d{3})\s/', $status, $match);
    $code = (int) ($match[1] ?? 0);
    echo sprintf("%-20s %s\n", $route, $status);

    if ($code !== 200) {
        $failed++;
    }
}

exit($failed === 0 ? 0 : 1);
