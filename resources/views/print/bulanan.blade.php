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
        <h4>Laporan</h4>
        <table class="" id="" border="1">
            <thead>
                <tr class="heading">
                    <th>Nama</th>
                    <th>Jenis Bayar</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Bayar</th>
                    <th>Denda</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($data as $item)
                    @if ($item->jenis_pembayaran == 'pangkal' && $item->getSiswaById->jenis_bayar != 'cash')
                         <tr class="item">
                            <td>{{ucwords($item->getSiswaById->nama)}}</td>
                            <td>{{ucwords($item->jenis_pembayaran)}}</td>
                            <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                            <td>
                                {{ucwords($item->getSiswaById->jenis_bayar)}}
                            </td>
                            <td>
                                {{\GeneralHelper::toRupiah($item->bayar)}}
                            </td>
                            <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                            <td>{{\GeneralHelper::toRupiah($item->bayar+$item->total_denda)}}</td>
                            @php
                                $total = $total + $item->bayar + $item->total_denda;
                            @endphp
                        </tr>
                        <tr class="item">
                            <td>{{ucwords($item->getSiswaById->nama)}}</td>
                            <td>{{ucwords($item->jenis_pembayaran)}}</td>
                            <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                            <td>
                                Siswa Bayar
                            </td>
                            <td>
                                {{\GeneralHelper::toRupiah($item->getSiswaById->getJenisBiayaById->pangkal - $item->bayar)}}
                            </td>
                            <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                            <td>
                                {{\GeneralHelper::toRupiah($item->getSiswaById->getJenisBiayaById->pangkal - $item->bayar)}}
                            </td>
                            {{-- @php
                                $total = $total + $item->bayar + $item->total_denda;
                            @endphp --}}
                        </tr>
                    @else

                        <tr class="item">
                            <td>{{ucwords($item->getSiswaById->nama)}}</td>
                            <td>{{ucwords($item->jenis_pembayaran)}}</td>
                            <td>{{ date('d M Y',strtotime($item->tanggal)) }}</td>
                            @if ($item->jenis_pembayaran == 'pangkal')
                                @if ($item->getSiswaById->jenis_bayar == 'cash')  
                                <td>Lunas</td>
                                @else
                                <td>
                                    {{ucwords($item->getSiswaById->jenis_bayar)}}
                                </td>
                                @endif
                            @else
                                <td></td>
                            @endif
                            <td>
                            @if ($item->jenis_pembayaran == 'pangkal' && $item->getSiswaById->jenis_bayar != 'cash')
                            {{\GeneralHelper::toRupiah($item->bayar)}} (Sisa {{\GeneralHelper::toRupiah($item->getSiswaById->getJenisBiayaById->pangkal - $item->bayar)}})
                            @else
                                {{\GeneralHelper::toRupiah($item->bayar)}}
                            @endif
                            </td>
                            <td>{{\GeneralHelper::toRupiah($item->total_denda)}}</td>
                            <td>{{\GeneralHelper::toRupiah($item->bayar+$item->total_denda)}}</td>
                            @php
                                $total = $total + $item->bayar + $item->total_denda;
                            @endphp
                        </tr>

                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr class="heading">
                    <th colspan="6">Total</th>
                    <th>{{\GeneralHelper::toRupiah($total)}}</th>
                </tr>
            </tfoot>
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
    </div>
</body>
</html>