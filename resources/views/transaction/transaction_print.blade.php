<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Transaksi</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
            <th scope="col">No</th>
            <th>Nama Kasir</th>
            <th>Total Harga</th>
            <th>Total Bayar</th>
            <th>Waktu Transaksi</th>
			</tr>
		</thead>
		<tbody>
            @foreach($transactions as $key => $transaction)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$transaction->user->name}}</td>
                    <td>Rp {{ $transaction->total }}</td>
                    <td>Rp {{ $transaction->pay_total }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>
 
</body>
</html>