<?php
$data = $this->db->get('tbl_template_mail')->row_array();

$title = $data['title'];
$title_email = $data['title_email'];
$message = $data['message'];
$bg_card = $data['bg_card'];
$bg_body = $data['bg_body'];
$color_text = $data['color_text'];
$name = $data['name'];
$color_header = $data['color_header'];
$btn_name = $data['btn_name'];
$color_btn = $data['color_btn'];
$color_btn_hover = $data['color_btn_hover'];
$size_logo = $data['size_logo'];
$text_align = $data['text_align'];
$image = $data['image'];
$color_divider = $data['color_divider'];
$position_btn = $data['position_btn'];
$action = $data['action'];
$description = $data['description'];
$color_btn_text = $data['color-btn-text'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');

        body {
            background-color: <?= $bg_body ?>;
            font-family: poppins !important;
        }

        .container {
            position: fixed;


            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: auto;
            height: auto;
        }

        .card {
            background-color: <?= $bg_card ?>;
            margin: 0;
            border-radius: 10px;
            padding: 0;
            height: auto;
            color: <?= $color_text ?>;
        }

        .card-header {
            background-color: <?= $color_header ?>;
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            display: flex;
        }

        .card-title {
            margin-left: 1rem;
            color: white;
        }

        .card-body {
            padding: 1rem;
            text-align: <?= $text_align ?>;
        }

        .img-fluid {
            width: <?= $size_logo ?>px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .image-default {
            display: flex;
            justify-content: center;
        }

        footer {
            text-align: center;
            font-size: small;

        }

        .btn,
        .btn-primary {
            background-color: <?= $color_btn ?>;
            color: <?= $color_btn_text ?>;
            padding: 10px;
            border-radius: 8px;
            outline: none;
            border-color: transparent;
            width: auto;
            height: auto;
            cursor: pointer;
            text-decoration: none;

        }

        .btn:hover {
            background-color: <?= $color_btn_hover ?>;
            cursor: pointer;
            text-decoration: none;
        }

        hr {
            border-color: <?= $color_divider ?>;
            margin: 30px 0px 30px 0px;
        }

        .form-group {
            display: flex;
            justify-content: <?= $position_btn ?>;
        }

        .kode-wrapper {
            display: flex;
            justify-content: center;
            gap: 3px;
        }

        .kode-verification {
            background-color: #B6C4B6;
            padding: 10px 15px 10px 15px;
            color: white;
            border-radius: 5px;

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-default">
            <img src="<?= base_url('assets/mail/img/' . $image . '') ?>" alt="" class="img-fluid">
        </div>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><?= $title_email ?></h2>
            </div>
            <div class="card-body">

                <p><?= $message ?></p>

                <p><?= $action ?></p>
                <hr>
                <div class="form-group">
                    <?php

                    $links[] = str_split($link);
                    foreach ($links as $lin) { ?>
                        <div class="kode-wrapper">
                            <i class="kode-verification"><?= $lin[0] ?></i>
                            <i class="kode-verification"><?= $lin[1] ?></i>
                            <i class="kode-verification"><?= $lin[2] ?></i>
                            <i class="kode-verification"><?= $lin[3] ?></i>
                            <i class="kode-verification"><?= $lin[4] ?></i>
                            <i class="kode-verification"><?= $lin[5] ?></i>
                        </div>
                    <?php } ?>
                </div>
                <hr>
                <a href="<?= $link_to_website ?>" class="btn btn-primary"><?= $btn_name ?></a>
                <p><?= $description ?></p>

                <footer>
                    <p>&copy; <?= date('Y') ?>, All right reserved <?= $name ?></p>
                </footer>
            </div>
        </div>
    </div>

</body>

</html>