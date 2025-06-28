<!DOCTYPE html>
<html>
  <head>
    <title>Kirim Pesan</title>
  </head>
<body>
  <h1>Pesan Baru, {{ $siswa->nama }}!</h1>
  <p>Ini adalah pesan yang dikirimkan kepada Anda.</p>
  <p>Waktu Pengiriman: {{now()}}</p>
</body>
</html>