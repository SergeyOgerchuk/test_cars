<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../../js/admin.js"></script>
</head>
<body>
<div class="main_container">
    <p class="h1">Автомобили</p>
    <div class="auto_head">
        <div class="car_name">Название</div>
        <div class="brand_name">Бренд</div>
        <div class="user_name">Пользователь</div>
    </div>
    <? foreach ($result as $item): ?>
        <?

        // Ставим картинку из папки, если есть
        $image = '';
        $dir = 'images/car_id =' . $item['car_id'];
        if (is_dir($dir)) {
            $files = scandir($dir);
            if ($files) {
                $image = '../../' . $dir . '/' . $files[2];
            }
        }
        ?>

        <div class="car <?= $item['car_id'] ?>">
            <div class="car__image">
                <img src="<?= $image ?>"
                     alt="<?= $image ?>">
                <form action="../../upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" class="form-control form-control-sm" name="images[]" multiple>
                    <input type="hidden" name="car_id" value="<?= $item['car_id'] ?>">
                    <button type="submit" class="btn btn-info">Загрузить</button>
                </form>
            </div>
            <div class="car__info-item car__name">
                <div class="car__name">
                    <input class='car_name<?= $item['car_id'] ?>' value="<?= $item['car_name'] ?>">
                </div>
            </div>
            <div class="car__info-item car__brand">
                <p>
                    <span><?= $item['brand_name'] ?></span>
                </p>
            </div>
            <div class="car__info-item car__user <?= $item['car_id'] ?>">
                <p>
                    <span><?= $item['user_role'] ?></span>
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-success" value="<?= $item['car_id'] ?>">Сохранить</button>
            </div>
            <div>
                <button type="button" class="btn btn-danger" value="<?= $item['car_id'] ?>">Удалить</button>
            </div>
        </div>
    <? endforeach; ?>
    <? include 'pagination.php' ?>
</div>
</body>
</html>

