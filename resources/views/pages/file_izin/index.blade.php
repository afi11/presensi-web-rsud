<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Izin</title>
    <style>
        .load {
            display: block;       /* iframes are inline by default */
            background: #000;
            border: none;         /* Reset default border */
            height: 100vh;        /* Viewport-relative units */
            width: 100vw;
        }
    </style>
</head>
<body style="margin:0px;padding:0px;overflow:hidden">
    <iframe class="load" src="{{ asset('files/izin/'.$fileIzin) }}"></iframe>
</body>
</html>