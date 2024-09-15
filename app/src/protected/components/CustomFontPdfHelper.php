<?php
class CustomFontPdfHelper
{
    public static function config()
    {
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs      = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData          = $defaultFontConfig['fontdata'];
        // Yii::log('Fonts: ' . __DIR__ . '/../../font');
        return [
            'fontDir'  => array_merge($fontDirs, [
                __DIR__ . '/../../font',
            ]),
            'fontdata' => $fontData + [
                'ubuntu'   => [
                    'R'  => 'Ubuntu-R.ttf',
                    'B'  => 'Ubuntu-B.ttf',
                    'I'  => 'Ubuntu-RI.ttf',
                    'BI' => 'Ubuntu-BI.ttf',
                ],
                'opensans' => [
                    'R'  => 'OpenSans-R.ttf',
                    'B'  => 'OpenSans-B.ttf',
                    'I'  => 'OpenSans-RI.ttf',
                    'BI' => 'OpenSans-BI.ttf',
                ],
            ],
        ];
    }
}
