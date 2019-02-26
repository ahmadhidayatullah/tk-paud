<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TK Asoka</title>
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
            
            /* .invoice-box table tr td:nth-child(2) {
                text-align: right;
            } */
            
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
    <caption>IDENTITAS PESERTA DIDIK</caption>
    <table>
        <tr>
            <td>1.</td>
            <td>Nama Peserta Didik</td>
            <td>:</td>
            <td>{{$data->nama}}</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>NIS</td>
            <td>:</td>
            <td>{{$data->nis}}</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Tempat, Tanggal Lahir</td>
            <td>:</td>
            <td>{{$data->tempat.', '.$data->tanggal_lahir}}</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{$data->jenis_kelamin}}</td>
        </tr>
        <tr>
            <td>5.</td>
            <td>Agama</td>
            <td>:</td>
            <td>{{$data->agama}}</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>Alamat</td>
            <td>:</td>
            <td>{{$data->alamat}}</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>Nama Orang Tua/Wali</td>
            <td>:</td>
            <td>{{ucwords($data->getUserById->name)}}</td>
        </tr>
        <tr>
            <td>8.</td>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{$data->pekerjaan_orang_tua}}</td>
        </tr>
    </table>
    <br><br>
        <table>
            <tr>
                <td>
                    Mengetahui<br>
                    Kepala TK Asoka Makassar
                    <br><br><br><br>
                </td>
            </tr>
            <tr>
                <td>({{\GeneralHelper::getNameOf()->kepsek}})</td>
            </tr>
        </table>
            <div style="page-break-after: always;"></div>
            <caption>Laporan Perkembangan Peserta Didik</caption>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{$data->nama}}</td> 
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td>{{$data->nis}}</td>
                </tr>
                <tr>
                    <td>Nama Sekolah</td>
                    <td>:</td>
                    <td>Yayasan Pendidikan ASOKA</td>    
                </tr>
                <tr>
                    <td>Alamat Sekolah</td>
                    <td>:</td>
                    <td>JL. Peritis Kemerdekaan KM. 18 No. 237</td>    
                </tr>
                <tr>
                    <td>Kelompok/Kelas</td>
                    <td>:</td>
                    <td>{{$data->getJenisBiayaById->nama}}</td>    
                </tr>
            </table>
<br><br><br><br>
            <table border="1">
                <tr>
                    <td>PENDAHULUAN</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->pendahuluan}}</td>
                </tr>
                <tr>
                    <td>AGAMA DAN MORAL</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->agama}}</td>
                </tr>
                <tr>
                    <td>FISIK MOTORIK</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->fisik_motorik}}</td>
                </tr>
                <tr>
                    <td>SOSIAL EMOSIONAL</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->sosial_emosional}}</td>
                </tr>
                <tr>
                    <td>BAHASA</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->bahasa}}</td>
                </tr>
                <tr>
                    <td>KOGNITIF</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->kognitif}}</td>
                </tr>
                <tr>
                    <td>SENI</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->seni}}</td>
                </tr>
                <tr>
                    <td>PENUTUP</td>
                    <td>:</td>
                    <td>{{@$data->getNilaiSiswa->penutup}}</td>
                </tr>
            </table>
            <div style="page-break-after: always;"></div>
            <p>Komentar Orang Tua / Wali</p>
            <p>........................................................................................................................................</p>
            <p>........................................................................................................................................</p>
            <p>........................................................................................................................................</p>
            <p>........................................................................................................................................</p>
            <p>........................................................................................................................................</p>
            <br><br>
        <table>
            <tr>
                <td>
                    TTd Orang Tua/Wali
                    <br><br><br><br>
                </td>
            </tr>
            <tr>
                <td>({{ucwords($data->getUserById->name)}})</td>
            </tr>
        </table>
        </div>
</body>
</html>