<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; TA MUHAMMAD NAZWAN ARRAZWA & ADELIA NOVIANTI 2023</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda Yakin Ingin Logout?</div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url("login/logout"); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->

<script src=" <?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/jszip/jszip.min.js"></script>


<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- DataTables Buttons JavaScript -->
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>



<!-- <script src="<?php echo base_url('assets/'); ?>vendor/jquery-datetimepicker/jquery.js"></script> -->

<!-- <script src="<?php echo base_url('assets/'); ?>vendor/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"></script> -->

<script>
    // Inisialisasi Select2 pada elemen <select>
    $(document).ready(function() {
        $('#id_supplier').select2();
    });

    $(function() {
        $("#startdate").datepicker({
            autoHide: true,
            zIndex: 2048,
            dateFormat: "yy-mm-dd"
        });

        $("#enddate").datepicker({
            autoHide: true,
            zIndex: 2048,
            dateFormat: "yy-mm-dd"
        });
    });

    $('#modalConfig').modal('show');
    $('#barangTable').DataTable();
    // $('#memberTable').DataTable();
    $('#laporanTable').DataTable({
        'pageLength': 50,
    });


    // Fungsi untuk mengambil kode transaksi secara dinamis
    function generateInvoice() {
        $.ajax({
            url: '<?php echo base_url('admin/generate_kode_transaksi/'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 200) {
                    $('#kode_transaksi').val(response.kode_transaksi);
                } else {
                    // Handle jika terjadi kesalahan
                    console.log('Terjadi kesalahan saat mengambil kode transaksi.');
                }
            },
            error: function(xhr, status, error) {
                // Handle jika terjadi kesalahan
                console.log('Terjadi kesalahan saat mengambil kode transaksi: ' + error);
            }
        });
    }


    function print_transaction() {
        document.title = new Date();
        window.print();
        save_transaction();
    }

    function preview_struck() {
        let bayar = $('#input_bayar').val();

        let kembali = $('#input_kembali').val();
        // Mengambil nilai total dari elemen dengan id 'total'
        let total = parseFloat($('#total').text().replace(/[^0-9.-]+/g, ''));

        // Mengambil nilai diskon dari elemen dengan id 'diskon'
        let diskon = parseFloat($('#diskon').val());

        // Menghitung total setelah diskon
        let totalSetelahDiskon = total - diskon;
        $.ajax({
            url: "<?= base_url(); ?>/admin/save_orders/",
            data: {
                kasir: $('#kasir').val(),
                kode_transaksi: $('#kode_transaksi').val(),
                nm_pelanggan: $('#kode_member').val(),
                bayar: bayar,
                diskon: diskon,
                kembali: kembali
            },
            method: "POST",

            success: function(data) {
                $('#modal_struck').modal('show');
                $('#content_struck').html(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }


    function save_transaction() {
        $.ajax({
            url: "<?php echo base_url('admin/create_transaction/') ?>",
            type: "POST",
            data: {
                kode_transaksi: $('#kode_transaksi').val(),
                input_bayar: $('#input_bayar').val(),
                nm_pelanggan: $('#kode_member').val(),
                diskon: $('#diskon').val(),
            },
            dataType: "json",
            success: function(result) {
                if (result.status === 200) {
                    $('#modal_struck').modal('hide');
                    alert("Transaksi Berhasil");
                    localStorage.removeItem("cartData");
                    window.location.reload();
                } else {
                    alert("Terjadi kesalahan dalam transaksi");
                }
            },
            error: function(err) {
                alert("Terjadi kesalahan dalam transaksi");
            }
        });
    }


    function updateSubtotal() {
        $.ajax({
            url: "<?= base_url(); ?>admin/getSubtotal/",
            method: "GET",
            success: function(data) {
                var subtotal = parseFloat(data);

                var diskonPersen = parseFloat($("#diskon").val());
                var diskon = 0;

                if (!isNaN(diskonPersen)) {
                    // Mengubah diskon dari persen menjadi nilai desimal
                    diskon = diskonPersen / 100;
                }

                // Memastikan subtotal adalah angka yang valid
                if (!isNaN(subtotal)) {
                    var total = subtotal - (subtotal * diskon);

                    // Menetapkan nilai total setelah diskon dengan format mata uang
                    $("#total_input").val("Rp. " + total.toLocaleString('id-ID'));

                    var inputBayar = parseFloat($("#input_bayar").val());

                    if (isNaN(inputBayar) || inputBayar < total || total === 0) {
                        $("#simpan_transaksi").attr("disabled", "disabled");
                    } else {
                        $("#simpan_transaksi").removeAttr("disabled");
                    }

                    // Jika keranjang kosong, kosongkan nilai input bayar dan input kembali
                    if (subtotal === 0) {
                        $("#input_bayar").attr("disabled", "disabled");
                        $("#input_bayar").val('');
                        $("#input_kembali").val('0');
                    } else {
                        if (isNaN(inputBayar) || inputBayar < total) {
                            $("#input_kembali").val("0");
                        } else {
                            var kembali = inputBayar - total;
                            $("#input_kembali").val(kembali);
                        }
                    }
                } else {
                    // Jika subtotal bukan angka yang valid, atur nilai total_input menjadi kosong
                    $("#total_input").val('');
                }
            }
        });
    }

    // Simpan data keranjang belanja ke penyimpanan lokal
    function saveCartData() {
        var cartData = $("#cart_detail").html();
        localStorage.setItem("cartData", cartData);
    }

    // Metode untuk memuat tampilan tabel keranjang belanja
    function loadCartData() {
        $.ajax({
            url: "<?= base_url(); ?>admin/load/",
            success: function(data) {
                $("#cart_detail").html(data);
            }
        });
    }



    // Memulihkan data keranjang belanja dari penyimpanan lokal
    function restoreCartData() {
        var cartData = localStorage.getItem("cartData");
        if (cartData) {
            $("#cart_detail").html(cartData);
        }
    }

    function getMemberData() {
        var noTelp = $('#no_telp').val();

        $.ajax({
            url: "<?= base_url(); ?>admin/get_pelanggan_data/",
            method: "GET",
            data: {
                no_telp: noTelp
            },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#memberModal').modal('hide');
                    alert("Member Ditemukan");
                    $('#kode_member').val(data.nm_pelanggan);

                    var diskonPersen = parseFloat(data.diskon);
                    var diskon = 0;

                    if (!isNaN(diskonPersen)) {
                        // Mengubah diskon dari persen menjadi nilai desimal
                        diskon = diskonPersen / 100;
                    }

                    $('#diskon').val(data.diskon + '%');

                    var subtotal = parseFloat($("#total_input").val());
                    var total = subtotal - (subtotal * diskon);
                    $("#total_input").val(total);
                } else {
                    alert(data.message);
                }
            },
            error: function() {
                alert('Terjadi kesalahan dalam memuat data pelanggan.');
            }
        });
    }

    $('#btnTambahMember').click(function() {
        var noTelp = $('#no_telp').val();
        if (noTelp === "") {
            alert("Silahkan Masukkan Nomor Member");
            return; // Menghentikan eksekusi selanjutnya jika input kosong
        }
        getMemberData();
        updateSubtotal();
    });


    // Panggil fungsi updateSubtotal untuk menginisialisasi nilai subtotal saat halaman dimuat
    updateSubtotal();

    $(document).ready(function() {
        $("#bayar").text('Bayar : 0'); // Set nilai awal input_bayar menjadi 0

        $("#input_bayar").on("input", function() {
            var bayar = $(this).val();
            var formattedBayar = parseFloat(bayar).toLocaleString('id-ID');
            $("#bayar").text("Bayar: " + formattedBayar);
            updateSubtotal();
        });
    });


    $("#barcode").on("keydown", function(event) {
        if (event.keyCode === 13) { // Check if Enter key is pressed (key code 13)
            var barcode = $(this).val();

            // Kirim permintaan Ajax ke server
            $.ajax({
                url: "<?= base_url(); ?>admin/addBarangBarcode",
                method: "POST",
                data: {
                    barcode: barcode
                },
                success: function(data) {
                    // Lakukan tindakan setelah berhasil menambahkan ke keranjang
                    console.log("Produk dengan barcode " + barcode + " ditambahkan ke keranjang");
                    $("#cart_detail").html(data);
                    updateSubtotal();
                    saveCartData(); // Simpan data keranjang belanja ke penyimpanan lokal setelah penambahan produk

                    // Bersihkan nilai input barcode setelah dikirim
                    $("#barcode").val("");
                },
                error: function(xhr, status, error) {
                    // Lakukan tindakan untuk penanganan error
                    console.error("Gagal menambahkan ke keranjang:", error);
                }
            });
        }
    });


    $(document).ready(function() {
        // Panggil metode load saat halaman dimuat
        loadCartData();
        // Panggil fungsi untuk menghasilkan kode transaksi saat halaman di-load
        generateInvoice();


        // Memulihkan data keranjang belanja dari penyimpanan lokal saat halaman dimuat
        restoreCartData();

        $(".add_cart").click(function() {
            var product_id = $(this).data("productid");
            var product_name = $(this).data("productname");
            var product_primary = $(this).data("productprimary");
            var product_price = parseFloat($(this).data("price")); // Ubah tipe data harga menjadi float
            var quantity = parseFloat($('#' + product_id).val()); // Ubah tipe data kuantitas menjadi float

            if (!isNaN(quantity) && quantity > 0) { // Periksa apakah kuantitas merupakan angka yang valid dan lebih dari 0
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/addBarang",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        product_name: product_name,
                        product_primary: product_primary,
                        product_price: product_price,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data === 'false') {
                            alert("Jumlah yang diinput melebihi stok yang tersedia!");
                        } else {
                            $('#barangModal').modal('hide');
                            window.location.reload();
                            alert("Produk telah ditambahkan ke keranjang!");
                            $("#cart_detail").html(data);
                            $("#" + product_id).val('');
                            updateSubtotal();
                            saveCartData(); // Simpan data keranjang belanja ke penyimpanan lokal setelah penambahan produk
                        }
                    }
                });
            } else {
                alert("Silakan masukkan jumlah yang valid!");
            }
        });


        $(document).on('click', '.remove_inventory', function() {
            var row_id = $(this).attr("id");
            if (confirm("Apakah Anda ingin menghapus item ini?")) {
                $.ajax({
                    url: "<?= base_url(); ?>/admin/removeBarang",
                    method: "POST",
                    data: {
                        row_id: row_id
                    },
                    success: function(data) {
                        window.location.reload();
                        alert("Produk dihapus dari keranjang belanja");
                        $("#cart_detail").html(data);
                        updateSubtotal();
                        saveCartData(); // Simpan data keranjang belanja ke penyimpanan lokal setelah menghapus produk
                    }
                });
            } else {
                return false;
            }
        });



        $(document).on("click", "#clear_cart", function() {
            if (confirm("Apakah Anda ingin mengosongkan keranjang?")) {
                $.ajax({
                    url: "<?= base_url(); ?>/admin/clear_cart",
                    success: function(data) {
                        window.location.reload();
                        alert("Keranjang telah dikosongkan!");
                        $("#cart_detail").html(data);
                        updateSubtotal();
                        saveCartData(); // Simpan data keranjang belanja ke penyimpanan lokal setelah mengosongkan keranjang
                    }
                });
            } else {
                return false;
            }
        });


    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    CKEDITOR.replace('customeditor', {
        // Tools Yang Dipakai
        toolbarGroups: [{
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },

            {
                "name": "paragraph",
                "groups": ["list"]
            },
            {
                "name": "styles",
                "groups": ["styles"]
            },
        ],
        // Tools Yang di remove
        removeButtons: 'Format,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
    });

    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "dom": 'Blfrtip',
            "buttons": [{
                    extend: "excelHtml5",
                    text: "Excel",
                    exportOptions: {
                        orthogonal: "export", // To exclude the "Aksi" column from export
                        columns: ":not(.exclude-export)" // Add class 'exclude-export' to exclude specific columns
                    }
                },
                {
                    extend: "pdfHtml5",
                    text: "PDF",
                    exportOptions: {
                        orthogonal: "export", // To exclude the "Aksi" column from export
                        columns: ":not(.exclude-export)" // Add class 'exclude-export' to exclude specific columns
                    }
                }
            ]
        }).buttons().container().appendTo('#myTable_wrapper .dataTables_filter');
    });


    //Chart
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    $(document).ready(function() {
        // $("body").toggleClass("sidebar-toggled");
        // $(".sidebar").toggleClass("toggled");
        dtTahunan();
    });

    function dtTahunan() {
        $.ajax({
            url: "<?= site_url('admin/penjualanTahunan/') ?>",
            type: "GET",
            success: function(data) {
                let item = JSON.parse(data);
                setChart(item);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding data');
            }
        });
    }

    function setChart(accept) {
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Pendapatan Bulanan",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: accept,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Rp. ' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });
    }

    setTimeout(function() {
        $('.preloader').fadeOut(1000);
    }, 500);

    $(function() {
        $('.alert').delay(2000).fadeOut(1500);
    })
</script>


<!-- 
<script>
    var modal = $('#modalData');
    var tableData = $('#myTable');
    var formData = $('#formData');
    var btnSave = $('#btnSave');

    function add() {
        modal.modal('show');
    }


    function save() {
        btnSave.text('Mohon Tunggu....');
        btnSave.attr('disabled', true);
        url = ""

        $.ajax({
            type: "POST",
            url: url,
            data: formData.serialize(),
            dataType: "JSON",
            success: function(response) {
                if (response.status = 'success') {
                    modal.modal('hide');
                    window.location.reload();
                }
            },
            error: function() {
                console.log('Error Database');
            }
        });
    }

     // function updateStockInDatabase(product_id, quantity) {
    //     $.ajax({
    //         url: "<?php echo base_url(); ?>admin/updateStock",
    //         method: "POST",
    //         data: {
    //             product_id: product_id,
    //             quantity: quantity
    //         },
    //         success: function(response) {
    //             console.log('Stok diperbarui di database.');
    //         },
    //         error: function() {
    //             console.log('Terjadi kesalahan saat memperbarui stok di database.');
    //         }
    //     });
    // }
</script> -->

<!-- 
<script>
    /*******************************************/
    // Always Show Calendar on Ranges
    /*******************************************/
    $('.shawCalRanges').daterangepicker({
        // autoApply: true,

        locale: {
            format: 'YYYY-MM-DD',
            separator: " s.d "

        },
        startDate: moment().subtract(7, 'day'),

        ranges: {
            'Hari ini': [moment(), moment()],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 hari yang lalu': [moment().subtract(6, 'days'), moment()],
            '30 hari yang lalu': [moment().subtract(29, 'days'), moment()],
            'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars: true,
    });
</script> -->

<!-- 
<script type="text/javascript">
    $(document).ready(function() {
        var table_1 = $('#laporanTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "ajax": {
                "url": "<?php echo site_url('admin/laporanKeuangan/') ?>",
                "type": "POST",
                "data": function(data) {
                    data.tgl_awal = $('#rangetgl').val();
                    data.tgl_akhir = $('#rangetgl').val();
                }
            },
            "columnDefs": [{
                "targets": [1],
                "className": "text-right",
                "render": $.fn.dataTable.render.number(',', '.', 0, 'Rp')
            }],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
                var numFormat = $.fn.dataTable.render.number(',', '.', 0, 'Rp').display;
                var pageTotal2 = api.column(1, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                $(api.column(2).footer()).html(numFormat(pageTotal2));
            }
        });

        $('#btn-filter').click(function() {
            table_1.ajax.reload();
        });
    });



    function reload_table() {
        table_1.ajax.reload(null, false); //reload datatable ajax 
    }
</script> -->

</body>

</html>