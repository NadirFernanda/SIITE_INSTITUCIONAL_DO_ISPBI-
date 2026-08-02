<?php

namespace App\Services;

class SignatureImageGenerator
{
    /**
     * Gera uma assinatura digital a partir de texto, numa fonte cursiva, com fundo
     * transparente — usado tanto para a assinatura do DAAC (guardada no utilizador)
     * como para a assinatura do candidato no comprovativo (gerada na hora, a partir
     * do nome, sem precisar de guardar nada).
     *
     * @return string data URI (data:image/png;base64,...) pronta para usar num <img src="">
     */
    public static function generate(string $texto, int $fontSize = 42): string
    {
        $texto    = trim($texto);
        $fontPath = resource_path('fonts/assinatura.ttf');
        $paddingX = 20;
        $paddingY = 20;
        [$inkR, $inkG, $inkB] = [26, 35, 50]; // mesmo tom escuro usado no resto do sistema

        $box        = imagettfbbox($fontSize, 0, $fontPath, $texto);
        $textWidth  = abs($box[2] - $box[0]);
        $textHeight = $box[1] - $box[7];

        $w = (int) round($textWidth + ($paddingX * 2));
        $h = (int) round($textHeight + ($paddingY * 2));

        $img = imagecreatetruecolor($w, $h);
        imagealphablending($img, false);
        imagesavealpha($img, true);
        $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
        imagefill($img, 0, 0, $transparent);
        imagealphablending($img, true);

        $inkColor = imagecolorallocate($img, $inkR, $inkG, $inkB);

        $x = (int) round($paddingX - $box[0]);
        $y = (int) round($paddingY + abs($box[7]));

        imagettftext($img, $fontSize, 0, $x, $y, $inkColor, $fontPath, $texto);

        ob_start();
        imagepng($img);
        $pngData = ob_get_clean();
        imagedestroy($img);

        return 'data:image/png;base64,' . base64_encode($pngData);
    }
}
