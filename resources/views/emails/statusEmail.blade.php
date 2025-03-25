<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Down Alert</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8d7da;
        padding: 20px;
        text-align: center;
    }

    h1 {
        color: #721c24;
    }

    .alert {
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        padding: 10px;
        display: inline-block;
        border-radius: 5px;
    }
</style>

<body>
    <h1>Alert!</h1>
    <p class="alert">
        The website <strong>{{ $website->name }}</strong> ({{ $website->url }}) is currently <strong>DOWN</strong>.
    </p>
    <p>🕒 Time of Failure: <strong>{{ now()->format('Y-m-d H:i:s') }}</strong></p>
</body>

</html>
