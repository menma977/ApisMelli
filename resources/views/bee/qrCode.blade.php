<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<div class="visible-print text-center">
    <h1>Laravel 5.7 - QR Code Generator Example</h1>

    {!! QrCode::size(500)->format('png')->merge('\public\dist\img\AdminLTELogo.png')->generate($bee->qr) !!}

    {!! QrCode::size(500)->generate($bee->qr); !!}

    <p>example by ItSolutionStuf.com.</p>
</div>

</body>
</html>
