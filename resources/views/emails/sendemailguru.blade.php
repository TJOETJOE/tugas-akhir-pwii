<!DOCTYPE html>
<html>

<head>
    <title>Kirim Pesan</title>
</head>

<body>
    <h1>Pesan Baru, {{ $guru->nama_guru }}!</h1>
    <p>Ini adalah pesan yang dikirimkan kepada Anda.</p>

    <h2>Halo, {{ $guru->nama_guru }}</h2>
    <p>Email kamu adalah: {{ $guru->email }}</p>
    <p>Ini adalah email otomatis dari sistem Laravel.</p>
    <p>Waktu Pengiriman: {{ now() }}</p>
</body>

</html>