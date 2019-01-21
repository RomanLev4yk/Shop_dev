<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function preview(string $img, int $width=20, int $height=20) {
    $fileInfo = pathinfo($img);
    $fileInfo['extension'] = strtolower($fileInfo['extension']);

    // Проверяем расширение картинки
    if ($fileInfo['extension'] !== 'jpg' && $fileInfo['extension'] !== 'jpeg' && $fileInfo['extension'] !== 'png') {
        return $img;
    }

    $newName = md5($img) .'-'. md5($width) .'-'. md5($height) .'.'. $fileInfo['extension'];

    // Проверям если уже обрезали эту картинку
    if (file_exists(public_path('cached/' . $newName))) {
        return asset('cached/' . $newName);
    }

    /**
     * Создаем объект картинки, обрезаем ее и сохраняем
     */
    $preview = Image::make($img);
    $preview->fit($width, $height);

    try {
        
        $preview->save(public_path('cached/' . $newName), 80);
    } catch (\Exception $err) {
        logger($err->getMessage());
        return $img;
    }
    $preview->destroy();

    return asset('cached/' . $newName);
}

