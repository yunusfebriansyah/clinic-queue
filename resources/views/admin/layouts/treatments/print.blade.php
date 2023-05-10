<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    *{
      font-family: serif;
    }
    .text-center{
      text-align: center;
    }
    table { 
        border-spacing: 0px;
        border-collapse: collapse;
        width: 100%;
      }
    table, td, th{
      border: 1px solid #000;
    }
    td {
      padding: 5px;
      vertical-align: middle;
    }
    th {
      padding: 10px;
    }
    table th{
      background-color: #dedede;
      vertical-align: middle;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>
<body>
  {{-- <img src="{{ url('assets/images/kop.jpg') }}" alt="Foto Kop Dokumen" style="width: 100%;"> --}}
  <div class="text-center">
    <h1>{{ $title }}</h1>
    @if($date)
    <p>Waktu Transaksi : {{ $date }}</p>
    @endif
  </div>

  <table>
    <thead>
      <tr>
          <th class="text-center">*</th>
          <th>Nama Pasien</th>
          <th>Dokter</th>
          <th>Layanan</th>
          <th>Penyakit</th>
          <th>Waktu Daftar</th>
          <th>Status Berobat</th>
      </tr>
  </thead>
  <tbody>
    @foreach ($treatments as $treatment)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $treatment->patient->name }}</td>
            <td>{{ $treatment->doctor->name }}</td>
            <td>{{ $treatment->service->name }}</td>
            <td>{{ $treatment->disease }}</td>
            <td>{{ $treatment->created_at->isoFormat('D MMMM Y') }}</td>
            <td>{{ $treatment->status }}</tr>
    @endforeach
    </tbody>
  </table>

  {{-- <div class="row justify-content-end mt-5">
    <div class="col-3">
      <p class="m-0 p-0">Administrator</p>
      <img src="{{ url('assets/images/ttd.png') }}" alt="Tanda Tangan" height="100">
      <p class="m-0 p-0">Linda Wati</p>
    </div>
  </div> --}}

  <script>
    window.print();
  </script>
</body>
</html>