<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan</title>
    <style>
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }
            
            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }
            
            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }
            
            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }
            
            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }
            
            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }
            
            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }
            
            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }
            
            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }
            
            .invoice-box table tr.item td{
                border-bottom: 1px solid #eee;
            }
            
            .invoice-box table tr.item.last td {
                border-bottom: none;
            }
            
            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }
            
            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
                
                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }
            
            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }
            
            .rtl table {
                text-align: right;
            }
            
            .rtl table tr td:nth-child(2) {
                text-align: left;
            }
            </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <h4>DATA ANAK DIDIK</h4>
        <h4>KELOMPOK {{ucwords($kelas)}}</h4>
        <table class="" id="" border="1">
            <thead>
                <tr class="heading">
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Tempat Tgl Lahir</th>
                    <th>Nama Orang Tua dan Pekerjaan</th>
                    <th>Alamat</th>
                    <th>No. Hp</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="item">
                    <td>{{$item->nis}}</td>
                    <td>{{ucwords($item->nama)}}</td>
                    <td>{{$item->jenis_kelamin}}</td>
                    <td>{{$item->agama}}</td>
                    <td>{{$item->tempat.' / '.$item->tanggal_lahir}}</td>
                    <td>{{ucwords($item->getUserById->name).' / '.$item->pekerjaan_orang_tua}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->no_hp}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
<br><br>
        <table>
            <tr>
                <td>
                    Mengetahui<br>
                    Kepala TK Asoka Makassar
                    <br><br><br><br>
                </td>
                <td>Guru Kelompok {{ucwords($kelas)}}<br><br><br><br></td>
            </tr>
            <tr>
                <td>({{\GeneralHelper::getNameOf()->kepsek}})</td>
                <td><pre>({{$wali}})</pre></td>
            </tr>
        </table>
    </div>
</body>
</html>