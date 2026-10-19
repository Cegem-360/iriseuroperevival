<?php

/**
 * Generates the print QR code for the venue that points to the donation page.
 *
 *   php tools/qr/donation-qr.php [output-dir]
 *
 * Writes donation-qr.svg (vector, for print) to the output dir (default:
 * __client/donation/, gitignored). Convert to PNG with:
 *   magick -density 600 donation-qr.svg -resize 2000x2000 donation-qr.png
 *
 * Uses bacon/bacon-qr-code, which is already installed as a Fortify dependency.
 * Error correction level H so the code still scans if it is printed small,
 * laminated or partly covered.
 */

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

$url = 'https://iriseuroperevival.com/tamogatas';
$outputDir = rtrim($argv[1] ?? __DIR__ . '/../../__client/donation', '/');

if (! is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

$writer = new Writer(new ImageRenderer(new RendererStyle(1000, 4), new SvgImageBackEnd()));
$svg = $writer->writeString($url, 'UTF-8', ErrorCorrectionLevel::H());

file_put_contents($outputDir . '/donation-qr.svg', $svg);

echo "QR for {$url} written to {$outputDir}/donation-qr.svg\n";
