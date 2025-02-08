<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <style>
        .p{
            margin-top: -10px;
        }
        .pesanan{
            margin-top: 50px;
            font-size: 25px;
        }
        .td{
            
        }
    </style>
    <?php 
    require "konfig.php";
    $order = $_GET['order'];
    $sql = mysqli_query($koneksi, "SELECT orderan.*, barang_name.nama_barang, barang_name.harga_jual FROM orderan INNER JOIN barang_name ON orderan.id_barang = barang_name.id_barang WHERE orderan.id_order = '$order' ");
    $a = mysqli_fetch_array($sql);
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <img src="assets/img/logo.png" class="img-fluid" style="width: 130px; margin-top: -20px;">
                    <table style="margin-top: -20px;">
                        <tr>
                            <td class="td">TELP</td>
                            <td>:</td>
                            <td style="padding-left: 10px;">08657476687</td>
                        </tr>
                        <tr>
                            <td  class="td"></td>
                            <td></td>
                            <td style="padding-left: 10px;">08657476687</td>
                        </tr>
                        <tr>
                            <td  class="td"></td>
                            <td></td>
                            <td style="padding-left: 10px;">08657476687</td>
                        </tr>
                        <tr>
                            <td  class="td"  style="margin-top: 10px;">NOMOR</td>
                            <td>:</td>
                            <td style="padding-left: 10px;">21020322</td>
                        </tr>
                    </table>
            </div>
            <div class="col-md-4 text-center">
                <p class="pesanan"><b>BUKTI PESANAN</b></p>
            </div>
            <div class="col-md-4">
                <table>
                    <tr>
                        <td  class="td">TANGGAL</td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?= $a['tgl_ambil']; ?></td>
                    </tr>
                    <tr>
                        <td  class="td">KEPADA YTH</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td><b><?= $a['nama_pemesan']; ?></b></td>
                    </tr>
                    <tr>
                        <td class="td"></td>
                        <td></td>
                        <td><?= $a['alamat']; ?> </td>
                    </tr>
                    <tr>
                        <td class="td">TELP</td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?= $a['no_hp']; ?></td>
                    </tr>
                    <tr>
                        <td class="td">JAM KIRIM</td>
                        <td>:</td>
                        <td style="padding-left: 10px;"> 13.00</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th>KODE</th>
                        <th>NAMA BARANG</th>
                        <th> BANYAKNYA</th>
                        <th> HARGA</th>
                        <th> SUBTOTAL</th>
                        <th> DISC%</th>
                        <th> DISCRP</th>
                        <th> JUMLAH</th>
                    </tr>
                    <tr>
                        <td><?= $a['id_order']; ?></td>
                        <td><?= $a['nama_barang']; ?></td>
                        <td><input type="text" name="qty" onkeyup="qty()" id="qty" style="width: 80px;" class="form-control"></td>
                        <td><input type="text" name="harga" id="harga" value="<?= $a['harga_jual']; ?>" readonly style="width:100px;" class="form-control"></td>
                        <td><input type="text" readonly onkeyup="qty()" id="subtotal" style="width: 80px; border: none;" ></td>
                        <td><input type="text" id="diskon" onkeyup="qty()" style="width: 80px;" class="form-control"></td>
                        <td><input type="text" id="potongan" onkeyup="qty()" style="width: 80px;" class="form-control"></td>
                        <td ><input type="text" style="border: none;" readonly id="total"></td>
                    </tr>
                </table>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <p>Tanda Terima :</p>
                        <div class="row mt-5">
                            <div class="col-md-6">(</div>
                            <div class="col-md-6">)</div>
                            <p>13-02-2021 08:19</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p>Pengiriman :</p>
                        <div class="row mt-5">
                            <div class="col-md-6">(</div>
                            <div class="col-md-6">)</div>
                            <p>Ulil</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p>Hormat Kami :</p>
                        <div class="row mt-5">
                            <div class="col-md-6">(</div>
                            <div class="col-md-6">)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <table>
                    <tr>
                        <td>TOTAL</td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><input type="text" style="border: none; " name="" id="tot"></p></td>
                    </tr>
                    <tr>
                        <td>DP</td>
                        <td>:</td>
                        <td style="padding-left: 10px;">0</td>
                    </tr>
                    <tr>
                        <td>KURANG BAYAR</td>
                        <td>:</td>
                        <td style="padding-left: 10px;">0</td>
                    </tr>
                    <tr>
                        <td>KET</td>
                        <td>:</td>
                        <td style="padding-left: 10px;">0</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table>
                    <tr>
                        <td>Catatan</td>
                        <td>:</td>
                        <td>Sebaiknya paket/produk ini digunakan maksimal 3-4 hari setelah paket ini diterima. Terima kasih</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>






    <script>
        // function qty(){
        //     var qty = document.getElementById('qty').value;
        //     var harga = document.getElementById('harga').value;
        //     var diskon = document.getElementById('diskon').value;
        //     var potongan = document.getElementById('potongan').value;
        //     var dsc = harga * diskon/100;
        //     var result = parseInt(qty) * harga;
        //     var diskon = (harga - (dsc)) * qty;

            // var hasil = qty * harga;
            // var dsc = hasil * diskon/100;
            // var total = hasil - dsc - potongan;
        //     if (!isNaN(result)) {
        //         // document.getElementById('subtotal').value = result;
        //         document.getElementById('total').value = diskon;
        //     }
        // }
    function qty(){
	var jumlah = document.getElementById('qty').value;
	var disc = document.getElementById('diskon').value;
    var potongan = document.getElementById('potongan').value;
    var diskon = <?= $a['harga_jual']; ?> * disc/100;
    var result = parseInt(jumlah) * <?= $a['harga_jual']; ?> ;
    var disc = (<?= $a['harga_jual']; ?> - (diskon) ) * jumlah - potongan;
        if (!isNaN(result)){
            document.getElementById('subtotal').value = result;
            document.getElementById('total').value = disc;
            document.getElementById('tot').value = disc;
        }
    }
    </script>


      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
