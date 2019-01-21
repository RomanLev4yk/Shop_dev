<?php
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (! function_exists('preview')) {
    function preview(string $img, int $width = 20, int $height = 20) {

        $fileinfo = pathinfo($img);
        $fileinfo['extension'] = strtolower($fileinfo['extension']);

        /**
        *Проверям расширение файла
	      */
        if ($fileinfo['extension'] !== 'jpg' && $fileinfo['extension'] !== 'jpeg' && $fileinfo['extension'] !== 'png') {
            return $img;
        }
        /**
        *Формирование имя для кэшированной картинки
	      */
        $newName = md5($img) .'-'. md5($width) .'-'. md5($height) .'.'. $fileinfo['extension'];
        /**
        *Проверяем если мы эту картинку уже обрезали
	      */
        if (file_exists(public_path('cached/'. $newName))) {
            return asset('cached/'.  $newName);
        }
        /**
        *Создаем объект картинки и обрезаем ее
	      */
        $preview = Image::make($img);
        $preview->fit($width, $height);
        /**
        *Пытаемся сохранить
	      */
        try {
            $preview->save(public_path('cached/'. $newName), 80);
        } catch (\Exception $err) {
            logger($err->getMessage());

            return $img;
        }
        /**
        *Удаляем объект из памяти
	      */
        $preview->destroy();

        return asset('cached/'.  $newName);
    }
}
