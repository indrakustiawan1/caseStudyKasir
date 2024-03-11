    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Case | BAYARIND</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">



        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte-v3') }}/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">

                <a href="#"><b style="color: blue;">Bayar</b><b style="color: green;">ind</b></a>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="login-box-msg">Case Study PHP Developer</p>
                    <form id="formKembalian" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Total Belanja (IDR)"
                                name="total_belanja" id="total_belanja" required>
                        </div>
                        <p class="text-xs text-danger err" id="total_belanja_error"></p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Jumlah Uang (IDR)"
                                name="jumlah_uang" id="jumlah_uang" required>
                        </div>
                        <p class="text-xs text-danger err" id="jumlah_uang_error"></p>
                        <div class="input-group-append mt-3 btn-group" role="group">
                            <div class="row mt-2">
                                <div class="col" id="btn100">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(100)">+100</button>
                                </div>
                                <div class="col" id="btn200">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(200)">+200</button>
                                </div>
                                <div class="col" id="btn500">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(500)">+500</button>
                                </div>
                                <div class="col" id="btn700">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(700)">+700</button>
                                </div>
                                <div class="col" id="btn800">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(800)">+800</button>
                                </div>
                                <div class="col" id="btn900">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(900)">+900</button>
                                </div>
                                {{-- <div class="w-100"></div> <!-- Break to new line --> --}}
                                <div class="col" id="btn1000">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(1000)">+1.000</button>
                                </div>
                                <div class="col" id="btn1500">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(1500)">+1.500</button>
                                </div>
                                <div class="col" id="btn2000">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(2000)">+2.000</button>
                                </div>
                                <div class="col" id="btn5000">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(5000)">+5.000</button>
                                </div>
                                <div class="col" id="btn10000">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(10000)">+10.000</button>
                                </div>
                                <div class="col" id="btn20000">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(20000)">+20.000</button>
                                </div>
                                <div class="col" id="btn50000">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(50000)">+50.000</button>
                                </div>
                                <div class="col" id="btn100000">
                                    <button class="btn btn-outline-primary btn-sm mt-3 btn-block" type="button"
                                        onclick="inputUang(100000)">+100.000</button>
                                </div>
                                <div class="col" id="uangPas">
                                    <button class="btn btn-warning btn-sm mt-3 btn-block" type="button"
                                        onclick="uangPas()">Uang Pas</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" style="width:40%; margin-left: auto; margin-right: auto;"
                            class="btn btn-primary mt-3 btn-block " id="hitungKembalian">Bayar</button>
                    </form>

                    <div id="hasilKembalian"></div>


                </div>
            </div>

            <div class="modal fade" id="kembalianModal" tabindex="-1" role="dialog"
                aria-labelledby="kembalianModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="kembalianModalLabel">Informasi Kembalian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="nilaiKembalian"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('adminlte-v3') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte-v3') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte-v3') }}/dist/js/adminlte.min.js"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

        <script>
            $(document).ready(function() {
                var jumlahUangArray = [100, 200, 500, 700, 800, 900, 1000, 1500, 2000, 5000, 10000, 20000, 50000,
                    100000
                ];

                function createJumlahUangButtons() {
                    var jumlahUangButtons = $('#jumlah_uang_buttons');
                    jumlahUangButtons.empty();
                    var jumlahPerBaris = 4;
                    var buttonWidth = 100 / jumlahPerBaris + '%';
                    jumlahUangArray.forEach(function(jumlah) {
                        var button = $('<div class="col-md-3"></div>');
                        var buttonElement = $(
                            '<button class="btn btn-outline-primary btn-sm mt-3 btn-block"></button>').text(
                            '+' + jumlah);
                        buttonElement.attr('onclick', 'inputUang(' + jumlah + ')');
                        button.append(buttonElement);
                        jumlahUangButtons.append(button);
                    });
                }

                createJumlahUangButtons();

                $('.input-jumlah-uang').on('click', function() {
                    var jumlah = $(this).data('jumlah');
                    $('#jumlah_uang').val(jumlah);
                });
                $('#total_belanja').on('input', function() {
                    var totalBelanja = $('#total_belanja').val();
                    console.log("Total Belanja:", parseInt(totalBelanja));
                    $('#list2').hide();
                    if (totalBelanja == '' || (parseInt(totalBelanja) >= 25) && (parseInt(totalBelanja) <
                            100)) {
                        $('#btn100').show();
                        $('#btn200').show();
                        $('#btn500').show();
                        $('#btn700').show();
                        $('#btn800').show();
                        $('#btn900').show();
                        $('#btn1000').show();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((parseInt(totalBelanja) >= 100) && (parseInt(totalBelanja) < 200)) {
                        $('#btn100').hide();
                        $('#btn200').show();
                        $('#btn500').show();
                        $('#btn700').show();
                        $('#btn800').show();
                        $('#btn900').show();
                        $('#btn1000').show();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((parseInt(totalBelanja) >= 200) && (parseInt(totalBelanja) < 500)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn500').show();
                        $('#btn700').show();
                        $('#btn800').show();
                        $('#btn900').show();
                        $('#btn1000').show();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((parseInt(totalBelanja) >= 500) && (parseInt(totalBelanja) < 700)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn500').hide();
                        $('#btn700').show();
                        $('#btn800').show();
                        $('#btn900').show();
                        $('#btn1000').show();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((parseInt(totalBelanja) >= 700) && (parseInt(totalBelanja) < 800)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn500').hide();
                        $('#btn700').hide();
                        $('#btn800').show();
                        $('#btn900').show();
                        $('#btn1000').show();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((parseInt(totalBelanja) >= 800) && (parseInt(totalBelanja) < 900)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn500').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').show();
                        $('#btn1000').show();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((parseInt(totalBelanja) >= 900) && (parseInt(totalBelanja) < 1000)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn500').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').show();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((totalBelanja > 1000) && (parseInt(totalBelanja) < 1500)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').hide();
                        $('#btn1500').show();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                    } else if ((totalBelanja >= 1500) && (parseInt(totalBelanja) < 2000)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').hide();
                        $('#btn1500').hide();
                        $('#btn2000').show();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                        //uang pas 1500
                    } else if ((totalBelanja >= 2000) && (parseInt(totalBelanja) < 5000)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').hide();
                        $('#btn1500').hide();
                        $('#btn2000').hide();
                        $('#btn5000').show();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show();
                        ///uang pas 2000
                    } else if ((totalBelanja >= 5000) && (parseInt(totalBelanja) < 10000)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').hide();
                        $('#btn1500').hide();
                        $('#btn2000').hide();
                        $('#btn5000').hide();
                        $('#btn10000').show();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show()
                        ///uang pas 5000 show
                    } else if ((totalBelanja >= 10000) && (parseInt(totalBelanja) < 20000)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').hide();
                        $('#btn1500').hide();
                        $('#btn2000').hide();
                        $('#btn5000').hide();
                        $('#btn10000').hide();
                        $('#btn20000').show();
                        $('#btn50000').show();
                        $('#btn100000').show()
                        ///uang pas 10000 show
                    } else if ((totalBelanja >= 20000) && (parseInt(totalBelanja) < 50000)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').hide();
                        $('#btn1500').hide();
                        $('#btn2000').hide();
                        $('#btn5000').hide();
                        $('#btn10000').hide();
                        $('#btn20000').hide();
                        $('#btn50000').show();
                        $('#btn100000').show()
                        ///uang pas 20000 show
                    } else if ((totalBelanja >= 50000) && (parseInt(totalBelanja) < 100000)) {
                        $('#btn100').hide();
                        $('#btn200').hide();
                        $('#btn700').hide();
                        $('#btn800').hide();
                        $('#btn900').hide();
                        $('#btn1000').hide();
                        $('#btn1500').hide();
                        $('#btn2000').hide();
                        $('#btn5000').hide();
                        $('#btn10000').hide();
                        $('#btn20000').hide();
                        $('#btn50000').hide();
                        $('#btn100000').show()
                    } else {

                    }
                });

                $('#hitungKembalian').on('click', function() {
                    var totalBelanja = $('#total_belanja').val();
                    var jumlahUang = $('#jumlah_uang').val();
                    var token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('hitungKembalian') }}",
                        method: 'POST',
                        data: {
                            total_belanja: totalBelanja,
                            jumlah_uang: jumlahUang,
                            _token: token
                        },
                        success: function(response) {
                            if (response.status == false) {
                                $.each(response.error, function(i, val) {
                                    $("#" + i + "_error").html(val[0])
                                });
                            } else {
                                $('#nilaiKembalian').text('Kembalian anda sejumlah: Rp. ' +
                                    formatRupiah(response
                                        .kembalian));
                                $('#kembalianModal').modal('show');
                            }

                        }
                    });
                });
            });

            // function inputUang(jumlah) {
            //     $('#jumlah_uang').val(jumlah);
            //     var token = $('meta[name="csrf-token"]').attr('content');
            //     // $('#hitungKembalian').click();
            // }

            var totalJumlahUang = 0;

            function inputUang(jumlah) {
                totalJumlahUang += jumlah;
                $('#jumlah_uang').val(totalJumlahUang);
                var token = $('meta[name="csrf-token"]').attr('content');
            }

            function uangPas() {
                var totalBelanja = $('#total_belanja').val();
                $('#jumlah_uang').val(totalBelanja);
            }

            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return ribuan;
            }

            $('#kembalianModal').on('hidden.bs.modal', function() {
                $('#total_belanja').val('');
                $('#jumlah_uang').val('');
            });
        </script>

    </body>

    </html>
