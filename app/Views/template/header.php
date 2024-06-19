<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? esc($title) : 'Agenda instrumentos CZ' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/sweetalert.css') ?>">
    <script src="<?= base_url('js/sweetalert.js') ?>"></script>

    <style {csp-style-nonce}>
        :root {
            --primary: #0832DE;
            /* O el color primario que desees */
        }

        * {
            transition: background-color 300ms ease, color 300ms ease;
            box-sizing: border-box;
        }


        html,
        body {
            font-family: "inter", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 16px;
            font-weight: 500;
            margin: 0;
            padding: 0;
        }

        .prevsalto:before {
            /* Ajuste para prevenir el "salto" */
            content: attr(data-text);
            display: inline-block;
            font-weight: bold;
            position: absolute;
            visibility: hidden;
        }

        .active {
            background-color: var(--primary);
            color: white;
            font-weight: bold;
            margin-left: 1rem;
        }
    </style>
</head>

<body>
    <div class="flex flex-col md:flex-row overflow-hidden gap-1 bg-gray-900 max-w-full">