<?php
/* @var $this PosController */
/* @var $model Penjualan */

$this->breadcrumbs = array(
    'Penjualan' => array('index'),
    $model->id  => array('view', 'id' => $model->id),
    'Ubah',
);

$this->boxHeader['small']  = 'Ubah';
$this->boxHeader['normal'] = "Penjualan: {$model->nomor}";
?>
<div class="row collapse">
    <div class="small-12 columns">
        <div class="row collapse">
            <div class="small-2 medium-1 columns">
                <a class="prefix" href="zxing://scan/?ret=<?= $this->createAbsoluteUrl('ubah', ['id' => $model->id, 'barcodescan' => '{CODE}']) ?>"><i class="fa fa-barcode fa-2x"></i></a>

                <!-- <span class="prefix" id="scan-icon"><i class="fa fa-barcode fa-2x"></i></span> -->
            </div>
            <div class="small-6 medium-9 columns">
                <input id="scan" type="text" placeholder="Scan [B]arcode / Input nama" accesskey="b" autofocus="autofocus" />
            </div>
            <div class="small-2 medium-1 columns">
                <a href="#" class="button postfix" id="tombol-tambah-barang"><i class="fa fa-level-down fa-2x fa-rotate-90"></i></a>
            </div>
            <?php
            switch ($tipeCari):
                case Pos::CARI_AUTOCOMPLETE:
            ?>
                    <div class="small-2 medium-1 columns">
                        <a href="#" class="success button postfix" id="tombol-cari-barang" accesskey="c"><i class="fa fa-search fa-2x"></i></a>
                    </div>
                <?php
                    break;

                case Pos::CARI_TABLE:
                ?>
                    <div class="small-2 medium-1 columns">
                        <a href="#" class="success button postfix" id="tombol-cari-tabel" accesskey="c"><i class="fa fa-search-plus fa-2x"></i></a>
                    </div>
            <?php
                    break;
            endswitch;
            ?>
        </div>
        <div id="transaksi">
            <?php
            $this->renderPartial('_detail', array(
                'penjualan'       => $model,
                'penjualanDetail' => $penjualanDetail
            ));
            ?>
        </div>
        <div id="barang-list" style="display:none">
            <?php
            $this->renderPartial('_barang_list', array(
                'barang' => $barang,
            ));
            ?>
        </div>
    </div>
</div>

<div style="display: none" id="total-belanja-h"><?php echo $model->ambilTotal(); ?></div>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/jquery.gritter.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/vendor/jquery.gritter.min.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScriptFile($this->createUrl('/js/bindwithdelay.js'), CClientScript::POS_HEAD);
?>
<script>
    function totalUangDibayar() {
        var inputUangDibayar = $("input.uang-dibayar"); //$('input[name^=kasbank]');
        var uangDibayar = 0;
        $.each(inputUangDibayar, function(index, el) {
            uangDibayar += parseInt($(el).val(), 10) || 0;
        });
        return uangDibayar;
    }

    function totalYangHarusDibayar() {
        var total = parseFloat($("#total-belanja-h").text());
        var diskonNota = parseInt($("#diskon-nota").val(), 10) || 0;
        var infaq = parseInt($("#infaq").val(), 10) || 0;
        var tarikTunai = parseInt($("#tarik-tunai").val(), 10) || 0;
        return total + infaq - diskonNota + tarikTunai;
    }

    function tampilkanKembalian(input) {
        //console.log("this:" + $(this).val() + "; total:" + $("#total-belanja-h").text());
        $("#kembali").html("0");
        console.log("tampilkanKembalian dieksekusi");
        var total = parseFloat($("#total-belanja-h").text());
        var diskonNota = parseInt($("#diskon-nota").val(), 10) || 0;
        var infaq = parseInt($("#infaq").val(), 10) || 0;
        var tarikTunai = parseInt($("#tarik-tunai").val(), 10) || 0;
        // console.log("Total: "+total);
        // console.log("diskonNota: "+diskonNota);
        // console.log("infaq: "+infaq);
        var uangDibayar = totalUangDibayar();
        console.log(uangDibayar);
        ///$(input).addClass("Sedang di sini");
        if ($.isNumeric(uangDibayar)) {
            var bayar = uangDibayar;
            // console.log("Bayar: "+ bayar);
            var dataKirim = {
                total: total,
                bayar: bayar,
                diskonNota: diskonNota,
                infaq: infaq,
                tarikTunai: tarikTunai,
            };
            $("#kembali").load('<?php echo $this->createUrl('kembalian'); ?>', dataKirim);
            if (bayar >= totalYangHarusDibayar()) {
                $("#kembali").removeClass("negatif");
            } else {
                $("#kembali").addClass("negatif");
            }
        }
    }

    function sesuaikanInputUangDibayar() {
        var total = parseFloat($("#total-belanja-h").text());
        var diskonNota = parseInt($("#diskon-nota").val(), 10) || 0;
        var infaq = parseInt($("#infaq").val(), 10) || 0;
        var inputUangDibayar = $("input.uang-dibayar");
        var tarikTunai = parseInt($("#tarik-tunai").val(), 10) || 0;
        var uangDibayar = 0;
        var cukup = false;
        console.log("sesuaikanInput.. dieksekusi!");
        $.each(inputUangDibayar, function(index, el) {
            var curValue = parseInt($(el).val(), 10);
            var bayar = uangDibayar + curValue;
            var total1 = total + infaq - diskonNota + tarikTunai;
            console.log("bayar= " + bayar + ", total= " + total1);
            if (cukup == false) {
                uangDibayar += parseInt($(el).val(), 10) || 0;
                console.log("uangDibayar= " + uangDibayar);
            } else {
                $(el).parent().parent().remove();
            }
            if (bayar >= total + infaq - diskonNota + tarikTunai || $(el).val() == 0) {
                cukup = true;
            }
            console.log("cukup= " + cukup);
        });
        if (cukup == false) {
            $("#uang-dibayar-master > .input-uang-dibayar").clone(true).appendTo("#uang-dibayar-clone");
            $("#uang-dibayar-clone").find(".uang-dibayar").last().val("0");
        }
        tampilkanKembalian();
    }

    function kirimBarcode() {
        dataUrl = '<?php echo $this->createUrl('tambahbarang', array('id' => $model->id)); ?>';
        dataKirim = {
            barcode: $("#scan").val()
        };
        console.log(dataUrl);
        /* Jika tidak ada barang, keluar! */
        if ($("#scan").val() === '') {
            $("#barang-list:visible").hide(100, function() {
                $("#transaksi").show(100);
            });
            $("#scan").focus();
            return false;
        }

        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: dataKirim,
            success: function(data) {
                if (data.sukses) {
                    $("#tombol-admin-mode").removeClass('geleng');
                    $("#tombol-admin-mode").removeClass('alert');
                    $.fn.yiiGridView.update('penjualan-detail-grid');
                    updateTotal();
                } else {
                    $.gritter.add({
                        title: 'Error ' + data.error.code,
                        text: data.error.msg,
                        time: 3000,
                        //class_name: 'gritter-center'
                    });
                }
                $("#scan").val("");
                $("#scan").focus();
                $("#scan").autocomplete("disable");
            }
        });
    }

    $(function() {
        $("#scan").autocomplete("disable");
        $(document).on('click', "#tombol-tambah-barang", function() {
            kirimBarcode();
            return false;
        });
        $(document).on('click', "#tombol-cari-barang", function() {
            $("#scan").autocomplete("enable");
            var nilai = $("#scan").val();
            $("#scan").autocomplete("search", nilai);
            $("#scan").focus();
        });
        $(document).on('click', "#tombol-cari-tabel", function() {
            var datakirim = {
                'cariBarang': true,
                'namaBarang': $("#scan").val(),
                'Barang_page': 1
            };
            $('#barang-grid').yiiGridView('update', {
                data: datakirim
            });
            $("#transaksi").hide(0, function() {
                $("#barang-list").show(100, function() {
                    $("#scan").val("");
                    $("#tombol-cari-tabel").focus();
                });

            });
            return false;
        });
    });

    $("#scan").keydown(function(e) {
        if (e.keyCode === 13) {
            $("#tombol-tambah-barang").click();
        }
    });

    $("#scan").autocomplete({
        source: "<?php echo $this->createUrl('caribarang'); ?>",
        minLength: 3,
        delay: 1000,
        search: function(event, ui) {
            $("#scan-icon").html('<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/3.gif" />');
        },
        response: function(event, ui) {
            $("#scan-icon").html('<i class="fa fa-barcode fa-2x"></i>');
        },
        select: function(event, ui) {
            console.log(ui.item ?
                "Nama: " + ui.item.label + "; Barcode " + ui.item.value :
                "Nothing selected, input was " + this.value);
            if (ui.item) {
                $("#scan").val(ui.item.value);
            }
        }
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li style='clear:both'>")
            .append(item.status == <?= Barang::STATUS_AKTIF ?> ?
                "<a><span class='ac-nama'>" + item.label + "</span> <span class='ac-harga'>" + item.harga + "</span> <span class='ac-barcode'><i>" + item.value + "</i></span> <span class='ac-stok'>" + item.stok + "</stok></a>" :
                "<span class='ac-nama'><s>" + item.label + "</s></span> <span class='ac-harga'>N/A</span> <span class='ac-barcode'><s><i>" + item.value + "</i></s></span> <span class='ac-stok'>N/A</stok>")
            .appendTo(ul);
    };

    function updateTotal() {
        var dataurl = "<?php echo Yii::app()->createUrl('penjualan/total', array('id' => $model->id)); ?>";
        $.ajax({
            url: dataurl,
            type: "GET",
            success: function(data) {
                if (data.sukses) {
                    $("#total-belanja-h").text(data.total);
                    $("#total-belanja").text(data.totalF);
                    $("#subtotal-belanja > .angka").text(data.totalF);
                    showSubTotal();
                    tampilkanKembalian();
                    // console.log(data.totalF);
                    <?php
                    if ($this->showTarikTunai) {
                    ?>
                        if (data.total >= <?= $tarikTunaiBelanjaMin ?>) {
                            $(".input-tarik-tunai").show(500);
                        } else {
                            $(".input-tarik-tunai").hide(500);
                            $("#tarik-tunai").val("");
                            showSubTotal();
                            tampilkanKembalian();
                        }
                    <?php
                    }
                    ?>
                }
            }
        });
    }

    function hitungYangHarusDibayar() {
        var total = parseFloat($("#total-belanja-h").text());
        var diskonNota = parseInt($("#diskon-nota").val(), 10) || 0;
        var infaq = parseInt($("#infaq").val(), 10) || 0;
        var tarikTunai = parseInt($("#tarik-tunai").val(), 10) || 0;
        return total - diskonNota + infaq + tarikTunai;
    }

    function showSubTotal() {
        if ($("#diskon-nota").val() > 0 || $("#infaq").val() > 0 || $("#tarik-tunai").val() > 0) {
            console.log("Besar dari 0");
            $("#subtotal-belanja").slideDown(200, function() {
                $(this).fadeTo(200, 1.00, function() {
                    var net = hitungYangHarusDibayar();
                    $("#total-belanja").text(net.toLocaleString('id-ID'));
                });
            });
        } else {
            if ($("#subtotal-belanja").css("opacity") != 0) {
                $("#subtotal-belanja").fadeTo(200, 0.00, function() {
                    $(this).slideUp(200, function() {
                        var net = hitungYangHarusDibayar();
                        $("#total-belanja").text(net.toLocaleString('id-ID'));
                    });
                });
            }
        }
    }

    $(".uang-dibayar").bindWithDelay("keyup", function() {
        sesuaikanInputUangDibayar();
    }, 1000);

    $(".uang-dibayar").keydown(function(e) {
        if (e.keyCode === 13) {
            $("#tombol-simpan").click();
        }
    });

    $("#diskon-nota").keyup(function() {
        showSubTotal();
        tampilkanKembalian();
    });

    $("#diskon-nota").keydown(function(e) {
        if (e.keyCode === 13) {
            $("#tombol-simpan").click();
        }
    });

    $("#infaq").keyup(function() {
        showSubTotal();
        tampilkanKembalian();
    });

    $("#infaq").keydown(function(e) {
        if (e.keyCode === 13) {
            $("#tombol-simpan").click();
        }
    });

    $("#tarik-tunai").keyup(function() {
        showSubTotal();
        tampilkanKembalian();
    });

    $("#tarik-tunai").keydown(function(e) {
        if (e.keyCode === 13) {
            $("#tombol-simpan").click();
        }
    });

    $("#tombol-simpan").click(function() {
        <?php /* Jika total pembayaran kurang tampilkan error, kemudian exit */ ?>
        if (totalYangHarusDibayar() > totalUangDibayar()) {
            $.gritter.add({
                title: 'Error! ',
                text: "Uang dibayar tidak mencukupi!",
                time: 5000,
            });
            return false;
        }
        if (!(totalYangHarusDibayar() > 0) && !($("#koin-mol").val() > 0)) {
            $.gritter.add({
                title: 'Error! ',
                text: "Belum ada penjualan!",
                time: 5000,
            });
            return false;
        }

        var inputUangDibayar = $("input.uang-dibayar");
        var bayar = new Object;
        var akunTarikTunaiAda = false;
        var pembayaranCukup = true;
        $.each(inputUangDibayar, function(index, el) {
            //bayar.push(['akun' : $(el).parent().parent().find(".account").val(), 'jumlah' : $(el).val()]);
            if ($(el).parent().parent().find(".account").val() == $("#tarik-tunai").parent().parent().find(".account").val()) {
                akunTarikTunaiAda = true;
                var tarikTunai = parseInt($("#tarik-tunai").val(), 10) || 0;
                var jmlBayarAkunIni = parseInt($(el).val(), 10) || 0;
                if (jmlBayarAkunIni < tarikTunai) {
                    pembayaranCukup = false;
                }
            }
            bayar[$(el).parent().parent().find(".account").val()] = $(el).val();
        })
        <?php /* Jika pembayaran pada akun tarik tunai kurang, tampilkan error, kemudian exit */ ?>
        if (pembayaranCukup == false) {
            $.gritter.add({
                title: 'Error! ',
                text: "Pembayaran untuk tarik tunai tidak cukup!",
                time: 5000,
            });
            return false;
        }
        <?php /* Jika akun bank tarik tunai tidak ditemukan, tampilkan error, kemudian exit */ ?>
        if (akunTarikTunaiAda == false && $("#tarik-tunai").val() > 0) {
            $.gritter.add({
                title: 'Error! ',
                text: "Akun Bank Tarik Tunai tidak ditemukan pada pembayaran!",
                time: 5000,
            });
            return false;
        }
        $(this).unbind("click").html("Simpan..").attr("class", "alert bigfont tiny button");
        dataUrl = '<?php echo $this->createUrl('simpan', array('id' => $model->id)); ?>';
        dataKirim = {
            'pos[account]': $("#account").val(),
            'pos[jenistr]': $("#jenisbayar").val(),
            'pos[uang]': $("#uang-dibayar").val(),
            'pos[bayar]': bayar,
            'pos[infaq]': $("#infaq").val(),
            'pos[diskon-nota]': $("#diskon-nota").val(),
            'pos[tarik-tunai]': $("#tarik-tunai").val(),
            'pos[tarik-tunai-acc]': $("#tarik-tunai").parent().parent().find(".account").val(),
        };
        console.log(dataUrl);
        printWindow = window.open('about:blank', '', 'left=20,top=20,width=400,height=600,toolbar=0,resizable=1');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: dataKirim,
            success: function(data) {
                if (data.sukses) {
                    //cetak();
                    printWindow.location.replace('<?php echo $this->createUrl('out', array('id' => $model->id)); ?>');
                    window.location.href = "<?php echo $this->createUrl('index'); ?>";
                } else {
                    $.gritter.add({
                        title: 'Error ' + data.error.code,
                        text: data.error.msg,
                        time: 3000,
                    });
                }
                $("#scan").val("");
                $("#scan").focus();
            }
        });
        return false;
    });

    $("#tombol-batal").click(function() {
        dataUrl = '<?php echo $this->createUrl('hapus', array('id' => $model->id)); ?>';
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success: function(data) {
                if (data.sukses) {
                    window.location.href = "<?php echo $this->createUrl('index'); ?>";
                } else {
                    $.gritter.add({
                        title: 'Error ' + data.error.code,
                        text: data.error.msg,
                        time: 3000,
                    });
                    $("#tombol-admin-mode").addClass('geleng');
                    $("#tombol-admin-mode").addClass('alert');
                }
                $("#scan").val("");
                $("#scan").focus();
            }
        });
        return false;
    });

    <?php
    if (!is_null($scanBarcode)) {
    ?>
        $(function() {
            $("#scan").val("<?= $scanBarcode ?>");
            kirimBarcode("<?= $scanBarcode ?>");
        });
    <?php
    }
    ?>
</script>
<?php
$this->menu = array(
    array('itemOptions' => array('class' => 'divider'), 'label' => false),
    array(
        'itemOptions'    => array('class' => 'has-form hide-for-small-only'), 'label'          => false,
        'items'          => array(
            array('label'       => '<i class="fa fa-plus"></i> <span class="ak">T</span>ambah', 'url'         => $this->createUrl('tambah'), 'linkOptions' => array(
                'class'     => 'button',
                'accesskey' => 't'
            )),
            array('label'       => '<i class="fa fa-asterisk"></i> <span class="ak">I</span>ndex', 'url'         => $this->createUrl('index'), 'linkOptions' => array(
                'class'     => 'success button',
                'accesskey' => 'i'
            ))
        ),
        'submenuOptions' => array('class' => 'button-group')
    ),
    array(
        'itemOptions'    => array('class' => 'has-form show-for-small-only'), 'label'          => false,
        'items'          => array(
            array('label'       => '<i class="fa fa-plus"></i>', 'url'         => $this->createUrl('tambah'), 'linkOptions' => array(
                'class' => 'button',
            )),
            array('label'       => '<i class="fa fa-asterisk"></i>', 'url'         => $this->createUrl('index'), 'linkOptions' => array(
                'class' => 'success button',
            ))
        ),
        'submenuOptions' => array('class' => 'button-group')
    )
);
