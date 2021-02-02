<?php

if (isset($_FILES['images'])) {
    foreach ($_FILES['images'] as $key => $value) {
        foreach ($value as $k => $v) {
            $_FILES['images'][$k][$key] = $v;
        }
        unset($_FILES['images'][$key]);
    }

    foreach ($_FILES['images'] as $k => $v) {

        $fileName = $_FILES['images'][$k]['name'];
        $fileTmpName = $_FILES['images'][$k]['tmp_name'];
        $fileType = $_FILES['images'][$k]['type'];
        $fileSize = $_FILES['images'][$k]['size'];
        $errorCode = $_FILES['images'][$k]['error'];

        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string)finfo_file($fi, $fileTmpName);

        // Проверим ключевое слово image
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
        $image = getimagesize($fileTmpName);
        $name = generateName($fileTmpName);
        $extension = image_type_to_extension($image[2]);
        $format = str_replace('jpeg', 'jpg', $extension);
        $pathToImage = 'images/car_id =' . $_POST['car_id'] . '/';
        if (!file_exists($pathToImage)) {
            mkdir($pathToImage, 0777, true);
        }

        if (!move_uploaded_file($fileTmpName, $pathToImage . $name . $format)) {
            die('При записи изображения на диск произошла ошибка.');
        }
    }
};

header('Location: /admin/');
exit;

function generateName($fileTmpName)
{
    $path = $fileTmpName ? $fileTmpName . '/' : '';
    do {
        $name = hash_file('md5',$fileTmpName);
        $file = $path . $name;
    } while (file_exists($file));

    return $name;
}