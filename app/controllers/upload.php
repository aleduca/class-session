<?php

use app\database\model\User;
use app\library\classes\UploadIntervention;

try {
    $image = new UploadIntervention();
    $image->make('file')->resize_aspect_ratio(400)
    ->watermark('/assets/images/watermark.png')
    ->execute();

    // $user = new User();
    // $user->update([
    //     'image' => $image->get_path(),
    // ]);
} catch (\Throwable $th) {
    var_dump($th->getMessage());
}
