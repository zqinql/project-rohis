<?php
include_once("functions.php");
include_once("date.php");
if ($_COOKIE['login'] != "" and ($_COOKIE['status'] == 'ADMIN' or $_COOKIE['status'] == 'OPERASIONAL' or $_COOKIE['status'] == 'PEMASARAN')) {
    $login = strtoupper($_COOKIE['login']);
    // $sid = $_SESSION['sid'];
?>
<html>

<head>
    <link rel="shortcut icon" href="icon.ico">
    <script type="text/javascript" src="noselect.js"></script>
    <script type="text/javascript" src="disable.js"></script>
    <script type="text/javascript" src="jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="jquery.search.js"></script>
    <script type="text/javascript" src="scrolltopcontrol.js"></script>
    <script type="text/javascript" src="sorttable.js"></script>
    <link href="css.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="sweetalert.css">
    <!--ballon css tooltip-->
    <link rel="stylesheet" href="baloon.css">
    <!-- data-balloon='Hapus Item' data-balloon-pos='left' -->
    <script type="text/javascript" src="jquery.typeahead.min.js"></script>
    <link rel="stylesheet" href="jquery.typeahead.min.css">
    <!--FanzyZoom Picture-->
    <script src="fancyzoom/js-global/FancyZoom.js" type="text/javascript"></script>
    <script src="fancyzoom/js-global/FancyZoomHTML.js" type="text/javascript"></script>
    <script src="jquery.modal.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="jquery.modal.css" type="text/css" media="screen" />
    <script type="text/javascript" src="jquery.simple-dtpicker.js"></script>
    <link type="text/css" href="jquery.simple-dtpicker.css" rel="stylesheet" />

    <?php
        $c = $_GET['c'];
        switch ($c) {
            case "input":
                $title = "Input Aplikasi Project";
                break;
            case "contract":
                $title = "Data Kontrak Project";
                break;
            case "detil":
                $title = "Detail Data Project";
                break;
        }
        ?>
    <title>::: <?php echo $title; ?> - HEMS v2.5.5 :::</title>
    <script TYPE="text/javascript">
    // copyright 1999 Idocs, Inc. http://www.idocs.com
    // Distribute this script freely but keep this notice in place
    function numbersonly(myfield, e, dec) {
        var key;
        var keychar;
        if (window.event)
            key = window.event.keyCode;
        else if (e)
            key = e.which;
        else
            return true;
        keychar = String.fromCharCode(key);
        // control keys
        if ((key == null) || (key == 0) || (key == 8) ||
            (key == 9) || (key == 13) || (key == 27))
            return true;
        // numbers
        else if ((("0123456789").indexOf(keychar) > -1))
            return true;
        // decimal point jump
        else if (dec && (keychar == ".")) {
            myfield.form.elements[dec].focus();
            return false;
        } else
            return false;
    }

    function formatCurrency(num) {
        num = num.toString().replace(/\Rp.|\,/g, '');
        if (isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        //cents = num%100;
        num = Math.floor(num / 100).toString();
        //if(cents<10)
        //cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
            num = num.substring(0, num.length - (4 * i + 3)) + ',' +
            num.substring(num.length - (4 * i + 3));
        return (((sign) ? '' : '-') + num);
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") //1,000,000
    }


    function konfirm_print() {

        swal({
                title: "<p style=\"font-size:24px;font-weight:bold;color:#F90505;\"><font color='#555'>Print Rate Cost</font><BR><i></p>",
                text: "<p style=\"font-size:20px; color:#32DE16; text-align:left;\">Masukan Periode Tanggal</p>",
                type: "input",
                html: true,
                showCancelButton: true,
                confirmButtonColor: '#FB6B2B',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                animation: "slide-from-top",
                inputPlaceholder: "YYYY/MM/DD"
            },
            function(inputValue) {
                //alert(inputValue);
                var period = inputValue;
                //window.location.href = '?c=delete&id=' + id + '&no=' + nopol + '&nodel=' + nodel + '&contr=' +
                //     no_contr + '&mou=' + mou;'print_app_pro?f1=" .
                window.location.href = 'print_app_ratecost?f1=' + period;

            });
        return false;
    }


    function konfirm_delete(id, nopol, nodel, no_contr, mou) {
        var pwd = '<?php $pwdadmin = $_SESSION['loginpassuperadmin'];
                            echo $pwdadmin; ?>';
        swal({
                title: "<p style=\"font-size:24px;font-weight:bold;color:#F90505;\"><font color='#555'>Yakin akan Menghapus Data Kontrak:</font><BR><i>" +
                    mou + "</i><BR>" + id + " ~ " + nopol + "?</p>",
                text: "<p style=\"font-size:20px; color:#32DE16; text-align:left;\">Masukan Password Admin:</p>",
                type: "input",
                html: true,
                showCancelButton: true,
                confirmButtonColor: '#FB6B2B',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                animation: "slide-from-top",
                inputPlaceholder: "*****"
            },
            function(inputValue) {
                if (inputValue === false) {
                    swal.showInputError("Password Salah!");
                    return false
                } else if (inputValue != pwd) {
                    swal.showInputError("Password Salah!");
                    return false
                } else if (inputValue === "") {
                    swal.showInputError("Silahkan masukan Password Admin!");
                    return false
                } else if (inputValue == pwd) {
                    window.location.href = '?c=delete&id=' + id + '&no=' + nopol + '&nodel=' + nodel + '&contr=' +
                        no_contr + '&mou=' + mou;
                } else {
                    return false
                }
            });
        return false;
    }

    function delete_subcon(id, nmsite, nmpro, nodel) {
        var pwd = '<?php $pwdadmin = $_SESSION['loginpassuperadmin'];
                            echo $pwdadmin; ?>';
        swal({
                title: "<p style=\"font-size:24px;font-weight:bold;color:#F90505;\"><font color='#555'>Yakin akan Menghapus Data SUBCON:</font><BR>" +
                    nmsite + " - " + nmpro + " ?</p>",
                text: "<p style=\"font-size:20px; color:#32DE16; text-align:left;\">Masukan Password Admin:</p>",
                type: "input",
                html: true,
                showCancelButton: true,
                confirmButtonColor: '#FB6B2B',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                animation: "slide-from-top",
                inputPlaceholder: "*****"
            },
            function(inputValue) {
                if (inputValue === false) {
                    swal.showInputError("Password Salah!");
                    return false
                } else if (inputValue != pwd) {
                    swal.showInputError("Password Salah!");
                    return false
                } else if (inputValue === "") {
                    swal.showInputError("Silahkan masukan Password Admin!");
                    return false
                } else if (inputValue == pwd) {
                    //window.location.href = '?c=batalkan_orderan&id_order='+oid+'&rekanan='+rkn+'&alasan='+inputValue+'&nourut='+no;
                    window.location.href = "?c=del_subcon&id=" + id + "&s=" + nmsite + "&p=" + nmpro;
                } else {
                    return false
                }
            });
        return false;
    }

    function confirm_close(apppro, mou) {
        swal({
                title: "<span style=\"font-size:24px; color:#d90000;\">Yakin akan meng-Close Project:</span>",
                text: "<span style=\"font-size:22px; color:#46D90D; text-align:center;\">[" + apppro + "] " + mou +
                    " ?</span>",
                type: "warning",
                html: true,
                showCancelButton: true,
                confirmButtonColor: '#d90000',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "?c=close_project&app_pro=" + apppro + "&mou=" + mou;
                } else {
                    return false
                }
            });
        return false;
    }

    function confirm_add_rent(apppro, mou) {
        swal({
                title: "<span style=\"font-size:24px; color:#00d900;\">Yakin akan meng-Addendum Kontrak ini:</span>",
                text: "<span style=\"font-size:22px; color:#0000ff; text-align:center;\">[" + apppro + "] " + mou +
                    " ?</span><BR><font style='text-align:left;color:#ff0000;font-size:20px'>#Semua Alat ybs akan di-Demobilisasi-kan.<br>#Seluruh komponen akan dihapus, Kecuali sisa Invoice/Tagihan.</font>",
                type: "warning",
                html: true,
                showCancelButton: true,
                confirmButtonColor: '#ff8000',
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(isConfirm) {
                if (isConfirm) {
                    window.location.href = "add_project_rent?c=input2&no_pro=" + apppro + "&app_pro=" + mou;
                } else {
                    return false
                }
            });
        return false;
    }
    </script>
</head>

<body onload="setupZoom();">
    <!-- < script type="text/javascript"> disableSelection(document.body); < /script>-->
    <center>
        <!-- BORDER FRAME -->

        <table width='100%' align='center' border=0 cellSpacing=0 cellPadding=0>
            <tr>
                <td width='1%'><img src='frame_01.png'></td>
                <td width='100%' background='frame_02.png'></td>
                <td width='1%'><img src='frame_03.png'></td>
            </tr>
            <tr>
                <td height='100%' background='frame_04.png'></td>
                <td colspan='1' background='frame_05.png'>

                    <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                        <?php
                            include "header.php"; //$status=$_COOKIE['status']; echo "Status: $status";
                            ?>
                        <!-- ISI-->
                        <tr>
                            <td colspan='3'></td>
                        </tr>
                        <?php
                            switch ($c) {
                                case "input":
                                    //SQL TYPE AHEAD UNIT
                                    //$next_contr_day=time()+(60*60*24*3); //3 hr
                                    //$sql3 = "SELECT id,nopol,nama_alat FROM ekspedisi WHERE id NOT IN (SELECT id_unit FROM kontrak_unit WHERE UNIX_TIMESTAMP(tgl_selesai)>$next_contr_day ORDER BY no) ORDER BY id";
                                    ///$sql1 = "SELECT id,nopol,nama_alat FROM ekspedisi WHERE id NOT IN (SELECT id_unit FROM kontrak_project WHERE kontrak_done='0' ORDER BY no) ORDER BY id";
                                    $sql_un = mysql_query("SELECT id_unit FROM kontrak_project WHERE kontrak_done='0'") or die('SQL_UN ERRROR: ' . mysql_error());
                                    $unit_contr = "";
                                    $adaapp = 0;
                                    while ($row_un = mysql_fetch_array($sql_un)) {
                                        $unit_contr .= "'$row_un[id_unit]', ";
                                        $adaapp++;
                                    }
                                    //echo"UNIT ON_CTRT: $unit_on_ctrt";
                                    $unit_contr1 = rtrim($unit_contr, ", ");
                                    if ($adaapp > 0) {
                                        $rst3 = mysql_query("SELECT id,nopol,nama_alat,tarif_sewa,m3_01,m3_02 FROM ekspedisi WHERE no_pol='CNP' and id NOT IN ($unit_contr1) ORDER BY id") or die('SQL3 ERRROR: ' . mysql_error());
                                        $rst1 = mysql_query("SELECT id,nopol,nama_alat,tarif_sewa,m3_01,m3_02 FROM ekspedisi WHERE no_pol='CNP' and id NOT IN ($unit_contr1) ORDER BY id") or die('SQL1 ERRROR: ' . mysql_error());
                                    } else {
                                        $rst3 = mysql_query("SELECT id,nopol,nama_alat,tarif_sewa,m3_01,m3_02 FROM ekspedisi where no_pol='CNP' ORDER BY id") or die('SQL3 ERRROR: ' . mysql_error());
                                        $rst1 = mysql_query("SELECT id,nopol,nama_alat,tarif_sewa,m3_01,m3_02 FROM ekspedisi where no_pol='CNP' ORDER BY id") or die('SQL3 ERRROR: ' . mysql_error());
                                    }
                            ?>
                        <style>
                        .disableselect {
                            color: #555;
                            background: #EEE;
                            cursor: not-allowed;
                        }

                        .enableselect {
                            color: #000;
                            background: #FFF;
                            cursor: auto;
                        }

                        .disable_text {
                            color: #555;
                            background: #555;
                            cursor: not-allowed;
                        }

                        .enable_text {
                            color: #000;
                            background: #FFF;
                            cursor: auto;
                        }
                        </style>
                        <script language="JavaScript" type="text/JavaScript">
                            function focus_awl() {
						document.forms[0].no_kontrak.focus();
						// var prs_opn=document.forms[0].elements["persen_opn[]"];
						// prs_opn.disabled=true;
						// prs_opn.className = "satu";
						setTimeout("focus_awl()", 600000);//10 mnt
					}
				</script>

                        <script TYPE="text/javascript">
                        ///////ADD ITEM UNIT
                        var no1 = 1;
                        var limit = 10;

                        function add_unit() {
                            //alert("Add Sparepart!");
                            if (no1 == limit) {
                                alert("Batas maks." + limit + " !");
                            } else {
                                no1++;
                                var x = document.getElementById('tbl_unit').insertRow(-1);
                                var y = document.getElementById('tbl_unit').insertRow(-1);
                                var z = document.getElementById('tbl_unit').insertRow(-1);
                                var aa = document.getElementById('tbl_unit').insertRow(-1);
                                var bb = document.getElementById('tbl_unit').insertRow(-1);
                                var cc = document.getElementById('tbl_unit').insertRow(-1);
                                //brs 1
                                var a = x.insertCell(0);
                                var b = x.insertCell(1);
                                var c = x.insertCell(2);
                                var d = x.insertCell(3);

                                a.innerHTML =
                                    "<b>Unit/Alat</b> <a style='margin-right:0px;' class='tooltips' tooltip='ID/No.Unit (Jenis Alat)'> help </a>";
                                b.innerHTML = "<input type='text' name='jml_unit[]' id='no_urut" + no1 +
                                    "' readonly value='" + no1 +
                                    "' class='satu' style='padding:5px;text-align:center;width:30px;'>";
                                c.innerHTML =
                                    "<div class=\"typeahead__container\" style=\"width:100%;\"><div class=\"typeahead__field\"><span class=\"typeahead__query\"><input type=\"text\" name='id_unit[]' id='unit" +
                                    no1 +
                                    "' class=\"js-typeahead-unit1\" placeholder=\"ID Unit~ No.Unit ~ Jenis Alat ~ <100M3 ~ >=100M3\" autocomplete=\"off\" onblur=\"get_biaya(" +
                                    no1 + ");\"></span></div></div>";
                                d.innerHTML = "<input type='button' id='del_no" + no1 +
                                    "' class='batal' style='font-weight:bold;font-size:18px;width:30px;padding:1px;' value=' - ' onclick=\"delitem(this)\" title='Hapus Unit " +
                                    no1 + "'>";
                                //brs 2
                                var a2 = y.insertCell(0);
                                var b2 = y.insertCell(1);
                                var c2 = y.insertCell(2);
                                var d2 = y.insertCell(3);
                                a2.innerHTML = "<b>Bobot</b>";
                                b2.innerHTML = "";
                                brs2 =
                                    "<input type='text' name='bobot[]' id='idbobot" + no1 +
                                    "' style='width:150px;text-align:right;padding:6px;' maxlength='15' value='0' onblur=\"get_biaya(" +
                                    no1 + ");\">&nbsp;M3";
                                c2.innerHTML = brs2;
                                d2.innerHTML = "";

                                //brs3
                                var a3 = z.insertCell(0);
                                var b3 = z.insertCell(1);
                                var c3 = z.insertCell(2);
                                var d3 = z.insertCell(3);
                                a3.innerHTML = "<b>Tarif Bobot</b>";
                                b3.innerHTML = "";
                                var brs3 = "";
                                brs3 +=
                                    "<input type='text' name='tarif_bobot[]' class='satu' style='width:150px;text-align:right;padding:6px;' value='0' readonly id='idtarif_bobot" +
                                    no1 + "'>"

                                c3.innerHTML = brs3;
                                d3.innerHTML = "";

                                //brs4
                                var a4 = aa.insertCell(0);
                                var b4 = aa.insertCell(1);
                                var c4 = aa.insertCell(2);
                                var d4 = aa.insertCell(3);
                                a4.innerHTML = "<b>Biaya</b>";
                                b4.innerHTML = "";
                                var brs4 = "";
                                brs4 +=
                                    "<input type='text' name='biaya_bobot[]' class='satu' style='width:150px;text-align:right;padding:6px;' value='0' readonly id='idbiaya_bobot" +
                                    no1 + "'>"

                                c4.innerHTML = brs4;
                                d4.innerHTML = "";

                                //brs5
                                var a5 = bb.insertCell(0);
                                var b5 = bb.insertCell(1);
                                var c5 = bb.insertCell(2);
                                var d5 = bb.insertCell(3);
                                a5.innerHTML = "<b>Keterangan..</b>";
                                b5.innerHTML = "";
                                var brs5 = "";
                                brs5 +=
                                    "<input type='text' name='keterangan[]'  maxlength='100' placeholder='KETERANGAN UNIT' style='width:100%;text-transform:none;'  value=''  id='keterangan" +
                                    no1 + "'>"

                                c5.innerHTML = brs5;
                                d5.innerHTML = "";

                                $(function() {
                                    $('#tgl_kirim' + no1).appendDtpicker({
                                        //"inline": true,
                                        "dateOnly": true,
                                        "autodateOnStart": true,
                                        "closeOnSelected": true,
                                        "locale": "id",
                                        "dateFormat": "YYYY/MM/DD"
                                    });
                                });
                                $(function() {
                                    $('#tgl_kembali' + no1).appendDtpicker({
                                        //"inline": true,
                                        "dateOnly": true,
                                        "autodateOnStart": true,
                                        "closeOnSelected": true,
                                        "locale": "id",
                                        "dateFormat": "YYYY/MM/DD"
                                    });
                                });


                                //QUERY DATABSE Unit
                                $.typeahead({
                                    input: '.js-typeahead-unit1',
                                    order: "asc",
                                    //hint: true,
                                    source: {
                                        data: [
                                            <?php
                                                            while ($row3 = mysql_fetch_array($rst3)) {
                                                                $tarif1 = number_format($row3['m3_01'], 0, ".", ",");
                                                                $tarif2 = number_format($row3['m3_02'], 0, ".", ",");
                                                                echo "'$row3[nopol] ~ $row3[id] ~ $row3[nama_alat] ~ $tarif1 ~ $tarif2',";
                                                            }
                                                            echo "''";
                                                            ?>
                                        ]
                                    },
                                    callback: {
                                        onInit: function(node) {
                                            console.log('Typeahead Initiated on ' + node.selector);
                                        }
                                    }
                                });
                                ///////////////////////////////
                            }
                        }

                        function delitem(src) {
                            no1--;
                            var i = src.parentNode.parentNode.rowIndex;
                            document.getElementById('tbl_unit').deleteRow(i);
                            document.getElementById('tbl_unit').deleteRow(i);
                            document.getElementById('tbl_unit').deleteRow(i);
                            //var x=document.getElementById('tbl_unit').deleteRow(1);
                            //var y=document.getElementById('tbl_unit').deleteRow(1);
                            //var Z=document.getElementById('tbl_unit').deleteRow(1);
                        }

                        ///////ADD COST/BIAYA LAINNYA
                        var no2 = 1;
                        var limit2 = 10;

                        function add_cost() {
                            //alert("Add Sparepart!");
                            if (no2 == limit2) {
                                alert("Batas maks." + limit2 + " !");
                            } else {
                                no2++;
                                var row1 = document.getElementById('tbl_cost').insertRow(-1);
                                //brs 1
                                var a = row1.insertCell(0);
                                var b = row1.insertCell(1);
                                var c = row1.insertCell(2);
                                var d = row1.insertCell(3);
                                a.innerHTML = "<b>Biaya Lainnya</b>";
                                b.innerHTML = "<input type='text' name='jml_cost[]' id='no_cost" + no2 +
                                    "' readonly value='" + no2 +
                                    "' class='satu' style='padding:5px;text-align:center;width:30px;'>";
                                c.innerHTML =
                                    "<input id='cost1' type=\"text\" name='nama_cost[]' style='width:280px;' maxlength='25' title='Biaya' placeholder=\"Biaya Lainnya " +
                                    no2 + "\">";
                                c.innerHTML +=
                                    " &nbsp; <b>Price</b> <input type='text' name='nilai_cost[]' size='15' maxlength='11' dir='rtl' id='nomcost" +
                                    no2 +
                                    "' value='0' onClick='this.select();' onKeyPress=\"return numbersonly(this, event)\" onkeyup=\"document.getElementById('nomcost" +
                                    no2 + "').value=formatCurrency(nomcost" + no2 + ".value); hit_price()\">";
                                d.innerHTML = "<input type='button' id='del2" + no2 +
                                    "' class='batal' style='font-weight:bold;font-size:18px;width:30px;padding:1px;' value=' - ' onclick=\"delitem2(this)\" title='Hapus Biaya " +
                                    no2 + "'>";
                            }
                        }

                        function delitem2(src) {
                            no2--;
                            //var i=src.parentNode.parentNode.rowIndex;
                            //document.getElementById('tbl_unit').deleteRow(i);	
                            var row1 = document.getElementById('tbl_cost').deleteRow(1);
                        }
                        </script>
                        <script type="text/javascript">
                        $(function() {
                            $('#tgl_skrg').appendDtpicker({
                                //"inline": true,
                                "dateOnly": true,
                                "autodateOnStart": true,
                                "closeOnSelected": true,
                                "locale": "id",
                                "dateFormat": "YYYY/MM/DD"
                            });
                        });
                        $(function() {
                            $('#tgl_mulai').appendDtpicker({
                                //"inline": true,
                                "dateOnly": true,
                                "autodateOnStart": true,
                                "closeOnSelected": true,
                                "locale": "id",
                                "dateFormat": "YYYY/MM/DD"
                            });
                        });
                        $(function() {
                            $('#tgl_selesai').appendDtpicker({
                                //"inline": true,
                                "dateOnly": true,
                                "autodateOnStart": true,
                                "closeOnSelected": true,
                                "locale": "id",
                                "dateFormat": "YYYY/MM/DD"
                            });
                        });

                        function hitungSelisihHari(tgl1, tgl2) {
                            // varibel miliday sebagai pembagi untuk menghasilkan hari
                            var miliday = 24 * 60 * 60 * 1000;
                            //buat object Date
                            var tanggal1 = new Date(tgl1);
                            var tanggal2 = new Date(tgl2);
                            //alert (tanggal1+" "+tanggal2);
                            // Date.parse akan menghasilkan nilai bernilai integer dalam bentuk milisecond
                            var tglPertama = Date.parse(tanggal1);
                            var tglKedua = Date.parse(tanggal2);
                            var selisih = (tglKedua - tglPertama) / miliday;
                            return selisih;
                        }


                        function hit_selisih_hr() {
                            //ambil tanggal mulai dan selesai
                            var skrg = document.getElementsByName('tgl_now');
                            var mulai = document.getElementsByName('tgl_mli');
                            var selesai = document.getElementsByName('tgl_sli');
                            // bangun string untuk tanggal "tahun bulan tanggal"
                            var tgl_sk = tgl_m = tgl_s = tgl_s2 = "";
                            for (var i = 0; i < skrg.length; i++) {
                                tgl_sk += skrg[i].value + " ";
                                tgl_s += selesai[i].value + " ";
                            }
                            //untuk jkt wkt
                            for (var j = 0; j < mulai.length; j++) {
                                tgl_m += mulai[j].value + " ";
                                tgl_s2 += selesai[j].value + " ";
                            }
                            //alert('Tgl: '+skrg.value);
                            var selisih1 = hitungSelisihHari(tgl_sk, tgl_s);
                            var selisih2 = hitungSelisihHari(tgl_m, tgl_s2);

                            //isikan hasil pada input dengan id = hasil
                            document.getElementById('tgl_sisa').value = selisih1;
                            //nilai jkt wkt (bln)
                            document.getElementById('jk_wkt').value = parseInt(selisih2 / 29);
                        }
                        </script>
                        <SCRIPT TYPE="text/javascript">
                        function form_check() {
                            // var input = document.getElementsByName('id_unit[]');
                            // var jml_unit = input.length;

                            //alert('Jml unit: ' + input.length + ' !');
                            //alert(document.input_contract.no_kontrak.value);
                            
                            /*if (document.input_contract.no_kontrak.value == "") {
                                //alert("Silahkan isi No Appliation!");
                                swal("Perhatian!", "Silahkan isi No Appliation!", "error");
                                document.input_contract.no_kontrak.focus()
                                return false;
                            }
                            if (document.input_contract.rent_nama.value == "") {
                                //alert("Silahkan isi Nama Penyewa!");
                                swal("Perhatian!", "Silahkan isi Nama Penyewa!", "error");
                                document.input_contract.rent_nama.focus();
                                return false;
                            }
                            if (document.input_contract.rent_jabatan.value == "") {
                                //alert("Silahkan isi Jabatan Penyewa!");
                                swal("Perhatian!", "Silahkan isi Jabatan Penyewa!", "error");
                                document.input_contract.rent_jabatan.focus();
                                return false;
                            }
                            if (document.input_contract.rent_company.value == "") {
                                //alert("Silahkan isi Perusahaan Penyewa!");
                                swal("Perhatian!", "Silahkan isi Perusahaan Penyewa!", "error");
                                document.input_contract.rent_company.focus();
                                return false;
                            }
                            if (document.input_contract.rent_almt.value == "") {
                                //alert("Silahkan isi Alamat Penyewa!");
                                swal("Perhatian!", "Silahkan isi alamat Penyewa!", "error");
                                document.input_contract.rent_almt.focus();
                                return false;
                            }
                            if (document.input_contract.jbtn_known.value == "") {
                                //alert("Silahkan isi Mengetahui Nama Jabatan!");
                                swal("Perhatian!", "Silahkan isi Mengetahui Nama Jabatan!", "error");
                                document.input_contract.jbtn_known.focus();
                                return false;
                            }
                            if (document.input_contract.spk_file.value == "" || document.input_contract.spk_file.value
                                .length <=
                                5) {
                                swal("Perhatian!", "Silahkan lampirkan file spk-nya!", "error");
                                return false;
                            }
                            if (document.input_contract.no_site_pro.value == "" || document.input_contract.no_site_pro
                                .SelectedIndex == 0) {
                                swal("Perhatian!", "Silahkan Pilih User Site Proyek !", "error");
                                document.input_contract.no_site_pro.focus();
                                return false;
                            }
                            if (document.input_contract.nilai_kontrak.value == "" || document.input_contract
                                .nilai_kontrak
                                .value ==
                                "0") {
                                swal("Perhatian!", "Nilai Kontrak tidak boleh nol !", "error");
                                //document.input_contract.nilai_kontrak.focus();
                                return false;
                            }
                            */

                            //SUBMIT
                            swal({
                                    title: "Yakin datanya sudah benar?",
                                    type: "warning",
                                    //html: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#59F32A',
                                    closeOnConfirm: true,
                                    showLoaderOnConfirm: true
                                },
                                function() {
                                    document.forms[0].submit();
                                });
                            return false;
                        } //end validation check	

                        //file upload
                        //file SPK
                        function delbam_clear() {
                            document.forms[0].spk_file.value = '';
                            document.getElementById('del_bam').innerHTML = "";
                            document.getElementById("uk_file").innerHTML = '';
                        }

                        function delbam() {
                            if (document.forms[0].spk_file.value != "") {
                                document.getElementById('del_bam').innerHTML =
                                    "<a href='javascript:void(0);' class='img' style='cursor:pointer;' onclick=\"delbam_clear();\"><img src='delete.gif' title='kosongkan file' vertical-align='top'></a>";
                            }
                        }

                        function delfile_clear(src) {
                            document.getElementById('file' + src).value = '';
                            document.getElementById('del_file' + src).innerHTML = "";
                            document.getElementById('link' + src).style = "display:none";
                            document.getElementById("uk_file" + src).innerHTML = '';
                        }

                        function delfile(src) {
                            if (document.getElementById('file' + src).value != "") {
                                newitem =
                                    "<a href='javascript:void(0);' class='img' style='cursor:pointer;' onclick=\"delfile_clear(" +
                                    src +
                                    ");\"><img src='delete.gif' width='17' height='17' title='kosongkan file' style='vertical-align:middle;'></a>";
                                //newitem+=" <a id='output' href='' target='_blank' style='cursor:pointer;' title='Lihat gambar'><font id='linkimg'></font></a>";
                                document.getElementById('del_file' + src).innerHTML = newitem;
                            }
                        }

                        function cek_fileseize() {
                            //var file_size=fotos[i].files[i].size/1024/1024;
                            var nmfile = document.getElementById("fileUpload").files[0];
                            var file_size = nmfile.size / 1024 / 1024;
                            file_size = file_size.toFixed(5);
                            if (file_size > 5) { //5MB
                                swal("Perhatian!", "Ukuran file melebihi 5MB!", "error");
                                delfile_clear();
                            } else {
                                document.getElementById("uk_file").innerHTML = 'Ukuran file: ' + file_size +
                                    'MB';
                            }
                        }
                        </SCRIPT>
                        <SCRIPT TYPE="text/javascript">
                        function cek_app_pro(id) {
                            $.ajax({
                                url: 'cek_app_pro.php',
                                data: 'no_app=' + id,
                                type: "post",
                                dataType: "html",
                                timeout: 10000,
                                success: function(response) {
                                    $('#cek_no_app').html(response);
                                }
                            });
                        }
                        </SCRIPT>

                        <?php
                                    //DATA SITE/PROYEK
                                    $rst2 = mysql_query("SELECT * FROM site_proyek ORDER BY no") or die('SQL2 salah: ' . mysql_error());
                                    $ada2 = mysql_num_rows($rst2);
                                    //SQL TYPE AHEAD UNIT
                                    //$next_contr_day=time()+(60*60*24*3); //3 hr
                                    //$sql1 = "SELECT id,nopol,nama_alat FROM ekspedisi WHERE id NOT IN (SELECT id_unit FROM kontrak_unit WHERE UNIX_TIMESTAMP(tgl_selesai)>$next_contr_day ORDER BY no) ORDER BY id";
                                    ///$sql1 = "SELECT id,nopol,nama_alat FROM ekspedisi WHERE id NOT IN (SELECT id_unit FROM kontrak_project WHERE kontrak_done='0' ORDER BY no) ORDER BY id";

                                    echo "
					<tr>
						<td height='25' align='left'>
							<div class='container'>INPUT DATA APPLICATION PROJECT CNP
							<div style='text-align:right; float:right;margin:auto;margin-right:-2px;'>
								<input type='button' class='btn5' style='font-size:12px;width:auto;padding:3px;' value='Data Aplikasi Project' title='Data Aplikasi Project' OnClick=\"window.location='?c=contract'\">	
							</div>
							</div>
						</td>
					</tr>
						<tr>
							<td width:'800px;' align='center' style=\"background-image: url('bg4.jpg');background-repeat:repeat;\">
								<FORM name='input_contract' method='post' enctype='multipart/form-data' action='?c=add_project' onsubmit=\"return form_check();\">
										<input type='hidden' name='tgl_now' value='" . date('Y/m/d') . "'>
										<div class='pageborder' style='width:800px;'>
												<table border='0' width='100%' cellspacing='1' cellpadding='2' style=\"background-color:#EEE;\">
													<tr>
														<td align='center' width='30%' colspan='2' style='margin-bottom:10px;' background='topgradient.jpg'><h2>Input Data Project CNP</h2></td>
													</tr>
													<tr><td colspan='2'></td></tr>
													<tr>
														<th align='left'>Tanggal Input</th>
														<td width='70%'><input type='text' name='tgl_input' size='8' style='text-align:center;cursor:pointer;' readonly placeholder='TANGGAL' id='tgl_skrg'></td>
													</tr>
													<tr>
														<th align='left'>No. Application/MoU Project</th>
														<td width='70%'>
															<input type='text' name='no_kontrak' maxlength='50' style='width:100%;text-align:center;' placeholder='max.50 CHARS'  onkeyup=\"this.value = this.value.toUpperCase(); cek_app_pro(this.value);\" onblur=\"cek_app_pro(this.value);\">
															<!--HSL CEK ID UNIT-->
															<BR><font id='cek_no_app'></font>
														</td>
													</tr>
													<tr>
														<th align='left'>Nama (Penyewa)</th>
														<td><input type='text' name='rent_nama' maxlength='60' style='width:100%;text-align:left;' placeholder='max.60 CHARS'></td>
													</tr>
													<tr>
														<th align='left'>Jabatan (Penyewa)</th>
														<td><input type='text' name='rent_jabatan' maxlength='40' style='width:100%;text-align:left;' placeholder='max.40 CHARS'></td>
													</tr>
													<tr>
														<th align='left'>Perusahaan (Penyewa)</th>
														<td><input type='text' name='rent_company' maxlength='60' style='width:100%;text-align:left;' placeholder='max.60 CHARS'></td>
													</tr>
													<tr>
														<th align='left'>Alamat (Penyewa)</th>
														<td><input type='text' name='rent_almt' maxlength='100' style='width:100%;text-align:left;' placeholder='max.100 CHARS'></td>
													</tr>
													<tr>
														<th align='left'>Mengetahui (Nama / Jabatan)</th>
														<td>
														<input type='text' name='nama_known' maxlength='30' style='width:48%;text-align:left;' placeholder='NAMA: max.30 CHARS'>
														&nbsp;
														<input type='text' name='jbtn_known' maxlength='30' style='width:49%;text-align:left;' placeholder='JABATAN: max.30 CHARS'>
														</td>
													</tr>
									<!--				
													<tr>
														<td align='left'><b>File SPK (.pdf)</b> <a class='tooltips' tooltip='Max. 5MB / .pdf'> help </a></td>
														<td><input style='text-transform:none; border:none;border-bottom:1px solid white;padding:3px;width:94%;' type='file' name='spk_file' id='fileUpload' accept=\"application/pdf\" onChange='delbam();cek_fileseize();'><font id='uk_file'></font> &nbsp <font id='del_bam' style='display:inline-block;'></font></td>
													</tr>
									-->				
													<tr>
														<th align='left'>User (Site & Proyek)</th>
														<td>
															<select name='no_site_pro' style='width:92%;'>";
                                    echo "<option value='' onClick=\"document.forms[0].alamat.value='';document.forms[0].kota.value='';document.forms[0].provinsi.value='';\">Pilih...</option>";
                                    while ($row2 = mysql_fetch_array($rst2)) {
                                        if ($row2['tipe_site'] == "INTERNAL") {
                                            $tipe_site = "INT";
                                        } else {
                                            $tipe_site = "EXT";
                                        }
                                        echo "<option value='$row2[no]'>$row2[no] $row2[nama_site] ~ $row2[nama_proyek] ($tipe_site)</option>";
                                    }
                                    if ($ada2 == 0) {
                                        echo "<option>--Data Site & Proyek masih kosong--</option>";
                                    }
                                    echo "</select>
															&nbsp 
															<input type='button' class='btn5' style='font-weight:bold;font-size:18px;width:30px;padding:1px;' value=' + ' title='Tambah Data Proyek' OnClick=\"window.open('subcon?c=main')\">
														</td>
													</tr>
													<tr><td colspan='3'><hr></td></tr>
													<tr><td colspan='3'>
														<table id='tbl_unit' width='100%' border='0' cellspacing='0' cellpadding='1'>
															<tr>
																<th align='left' width='32%'>Unit/Alat <a style='margin-right:0px;' class='tooltips' tooltip='ID/No.Unit (Jenis Alat)'> help </a></th>
																<td align='left' width='3%'><input type='text' name='jml_unit[]' id='no_urut1' readonly value='1' class='satu' style='padding:5px;text-align:center;width:30px;'></td>
																<td align='left'width='65%'>
																<div class=\"typeahead__container\" style=\"width:100%;\">
																<div class=\"typeahead__field\">
																<span class=\"typeahead__query\">
																<input id='unit1'type=\"text\" name='id_unit[]'id='unit1'style='width:100%;'
																title='Unit'class=\"js-typeahead-unit\" placeholder=\"ID Unit~ No.Unit ~ Jenis Alat ~ <100M3 ~ >=100M3\" autocomplete=\"off\" onblur=\"get_biaya(1);
																\">
																</span>
																</div>
																</div>
																</td>
																<td width='3%' align='center'><input id='btn_add_un' type='button' class='btn5' style='font-weight:bold;font-size:18px;width:30px;padding:1px;' value=' + ' onclick='add_unit()' title='Tambah Unit'></td>
															</tr>
															<tr>
															    <th align='left'>Bobot</th>
															    <td>&nbsp</td><td colspan='2'><input type='text'name='bobot[]'id='idbobot1'maxlength='15'value='0'
															    style='width:150px;text-align:right;padding:6px;'onblur=\"get_biaya(1);
																\">&nbsp;M3</td>															
															</tr>

															<tr>
															    <th align='left'>Tarif Bobot</th>
															    <td>&nbsp</td><td colspan='2'><input type='text'name='tarif_bobot[]'id='idtarif_bobot1'maxlength='15'value='0'
															    style='width:150px;text-align:right;padding:6px;' class='satu' readonly></td>															
															</tr>

															<tr>
															    <th align='left'>Biaya</th>
															    <td>&nbsp</td><td colspan='2'><input type='text'name='biaya_bobot[]'id='idbiaya_bobot1'maxlength='15'value='0'
															    style='width:150px;text-align:right;padding:6px;' class='satu' readonly></td>															
															</tr>

															<tr>
																<th align='left'>Keterangan</th>
																<td>&nbsp</td>
																<td><input type='text' name='keterangan[]' maxlength='100' placeholder='KETERANGAN UNIT 1' style='width:100%;text-transform:none;'></td>
															</tr>
														</table>
													</td></tr>													
													<tr><td colspan='3'><hr></td></tr>

													<tr>
														<th align='left'>TOTAL NILAI KONTRAK (<i>Rp</i>)</th>
														<td>
															<input type='text' name='nilai_kontrak' id='ttl_kontrak' maxlength='14' value='0' style='width:210px;font-weight:bold;' dir='rtl' class='satu' readonly=\"readonly\" onKeyPress=\"return numbersonly(this, event)\" onkeyup=\"document.getElementById('ttl_kontrak').value=formatCurrency(ttl_kontrak.value); hit_price()\" onblur=\"document.getElementById('nom_ttl_contr').value=this.value\">
														</td>
													</tr>
													<tr><td colspan='3'><hr></td></tr>
													<tr>
														<th align='left'>Tgl Mulai - Tgl Selesai</th>
														<td>
															<input type='text' value='" . date('Y/m/d') . "' name='tgl_mli' size='8' style='text-align:center;cursor:pointer;' readonly placeholder='YYYY/MM/DD' id='tgl_mulai' onchange=\"hit_selisih_hr()\">
															-
															<input type='text' value='" . date('Y/m/d') . "' name='tgl_sli' size='8' style='text-align:center;cursor:pointer;' readonly placeholder='YYYY/MM/DD' id='tgl_selesai' onchange=\"hit_selisih_hr()\">	
															&nbsp &nbsp &nbsp  
															<b>Sisa Waktu</b> <small><i>dari hari ini</i></small> &nbsp<input type='text' name='sisa_wkt' disabled value='$sisa_hr' id='tgl_sisa' readonly class='satu' size='8' style='text-align:center;'> Hr
														</td>
													</tr>
													<tr>
														<th align='left'>Jangka Waktu</th>
														<td>
															<input type='text' name='jangka_wkt' id='jk_wkt' class='satu' readonly size='8' style='text-align:center;padding:6px;' onchange=\"hit_price()\"> Bln
														</td>
													</tr>
													<tr><td colspan='3'>&nbsp</td></tr>
													<tr>
													<td colspan='2' align='center' background='topgradient.jpg'>
														<input type=\"submit\" name='simpan' style=\"display:none\">
														<input type='submit' name='simpan' value='Simpan'>
														<input type='reset' name='reset' value='reset' title='Reset'>
														<input type='button' class='batal' value='Batal' onclick=\"window.location='unit?c=database'\">
													</td>
													</tr>
												</table></div>
											</FORM>
									</td></tr>";
                                    echo "<script>focus_awl();</script>";
                                    ?>
                        <script>
                        //JQUERY ALAT/UNIT
                        $.typeahead({
                            input: '.js-typeahead-unit',
                            order: "asc",
                            //hint: true,
                            source: {
                                data: [
                                    <?php
                                                    while ($row1 = mysql_fetch_array($rst1)) {
                                                        $tarif1 = number_format($row1['m3_01'], 0, ".", ",");
                                                        $tarif2 = number_format($row1['m3_02'], 0, ".", ",");
                                                        echo "'$row1[nopol] ~ $row1[id] ~ $row1[nama_alat] ~ $tarif1 ~ $tarif2',";
                                                    }
                                                    echo "''";
                                                    ?>


                                ]

                            },
                            callback: {
                                onInit: function(node) {
                                    console.log('Typeahead Initiated on ' + node.selector);
                                }

                            }

                        });

                        ///////////////////////////////	
                        function get_biaya(no) {

                            var nombiaya = 0;
                            var tarif1 = 0;
                            var tarif2 = 0;

                            var bobotnya = document.getElementById('idbobot' + no).value;
                            //---catatan
                            // kurang <100 M3 = Rp. 35.000,-/m3
                            // > 100m3 = Rp. 3.500.000,-
                            var nombiaya = 0;
                            var unit = document.getElementById('unit' + no)
                                .value; //EXCA-001 ~ UN-0357 ~ HYDRAULIC EXCAVATOR ~ < 50,000,000 ~ > =83838
                            var arr = unit.split("~");
                            if (arr == '') {
                                var tarif1 = 0;
                                var tarif2 = 0;
                            } else {
                                var tarif1 = arr[3]; //.substr(1);
                                var tarif1x = parseFloat(tarif1.replace(/,/g, ""));

                                var tarif2 = arr[4];
                                var tarif2x = parseFloat(tarif2.replace(/,/g, ""));

                            }

                            //---

                            if (bobotnya >= 100) {
                                tarifnya = tarif1x;
                                nombiaya = tarif1x * bobotnya;
                            } else if (bobotnya > 0 && bobotnya < 100) {
                                tarifnya = tarif2x;
                                nombiaya = tarif2x;
                            }
                            var tarifbobot = document.getElementById('idtarif_bobot' + no).value = tarifnya
                                .toLocaleString();;
                            var biaya = document.getElementById('idbiaya_bobot' + no).value = nombiaya.toLocaleString();

                            tot_biaya = 0;
                            //alert(no);
                            for (var i = 1; i <= no; i++) {
                                var biaya1 = document.getElementById('idbiaya_bobot' + i).value;
                                var biaya2 = parseFloat(biaya1.replace(/,/g, ""));
                                //alert(i);
                                tot_biaya = tot_biaya + biaya2;
                            }
                            document.getElementById('ttl_kontrak').value = tot_biaya.toLocaleString();

                        }
                        </script>
                        <?php
                                    break;

                                case "add_project":
                                ?>
                        <!--LOADER -->
                        <div class="loader">Sedang Memproses, Silahkan tunggu...</div>
                        <script type="text/javascript" src="noklik.js"></script>
                        <script>
                        // slight update to account for browsers not supporting e.which
                        function disableF5(e) {
                            if ((e.which || e.keyCode) == 116) e.preventDefault();
                        };
                        // To disable f5
                        /* jQuery < 1.7 */
                        //$(document).bind("keydown", disableF5);
                        /* OR jQuery >= 1.7 */
                        $(document).on("keydown", disableF5);
                        </script>
                        <?php
                                    $officer = strtoupper($_COOKIE['login']);
                                    $mou_kontrak = strtoupper($_POST['no_kontrak']);
                                    $rent_nama = strtoupper($_POST['rent_nama']);
                                    $rent_jabatan = strtoupper($_POST['rent_jabatan']);
                                    $rent_company = strtoupper($_POST['rent_company']);
                                    $rent_almt = strtoupper($_POST['rent_almt']);
                                    $nama_known = strtoupper($_POST['nama_known']);
                                    $jbtn_known = strtoupper($_POST['jbtn_known']);
                                    $nilaikontrak = str_replace(",", "", $_POST['nilai_kontrak']); //nilai sewa alat
                                    $jangka_wkt = $_POST['jangka_wkt'];
                                    $tgl_in = explode("/", $_POST['tgl_input']);
                                    $tgl_m = explode("/", $_POST['tgl_mli']);
                                    $tgl_input = $tgl_in[0] . "-" . $tgl_in[1] . "-" . $tgl_in[2];
                                    $tgl_start = $tgl_m[0] . "-" . $tgl_m[1] . "-" . $tgl_m[2];
                                    $no_site_pro = $_POST['no_site_pro'];
                                    $tgl_s = explode("/", $_POST['tgl_sli']);
                                    $tgl_end = $tgl_s[0] . "-" . $tgl_s[1] . "-" . $tgl_s[2];
                                    $jmlunit = count($_POST['id_unit']);

                                    //Site&Proyek Baru
                                    $sql1b = "SELECT * FROM site_proyek WHERE no='$no_site_pro'";
                                    $rst1b = mysql_query($sql1b) or die('Query 1b salah.<br>' . mysql_error());
                                    $row1b = mysql_fetch_array($rst1b);

                                    $sql1 = "SELECT no_kontrak FROM kontrak_project ORDER BY no DESC LIMIT 1";
                                    $rst1 = mysql_query($sql1) or die('Query mencari no_urut terakhir salah.<br>' . mysql_error());
                                    $ada = mysql_num_rows($rst1);
                                    $row1 = mysql_fetch_array($rst1);
                                    $nourut = $row1[0];

                                    if ($ada > 0) {
                                        $nourut = substr($row1['no_kontrak'], -4);
                                    } else {
                                        $nourut = "";
                                    }
                                    if ($row1['no_kontrak'] == "" or $nourut == "") {
                                        $nourut = 1;
                                    } else $nourut++;
                                    $id_kontrak = "AP-" . sprintf("%04d", $nourut);

                                    //////////////////FILE SPK///////////////
                                    $target_path = "file_spk/";
                                    $namafile = trim(str_replace(" ", "-", $_FILES['spk_file']['name'])); //mengganti spasi menjadi '-'
                                    $tipefile = $_FILES['spk_file']['type'];
                                    $tmpfile = $_FILES['spk_file']['tmp_name'];
                                    $errors = $_FILES['spk_file']['error'];
                                    $ukuranfile = round($_FILES['spk_file']['size'] / 1024); //in KB;
                                    //$size=filesize($_FILES['file_bam']['tmp_name']);
                                    $maxsize = (1 * 1024) * 5; // in-MB ->maksimal 5MB (1KB = 1024 Byte)

                                    function getExtension($str)
                                    {
                                        $i = strrpos($str, ".");
                                        if (!$i) {
                                            return "";
                                        }
                                        $l = strlen($str) - $i;
                                        $ext = substr($str, $i + 1, $l);
                                        return $ext;
                                    }
                                    $extension = getExtension($namafile);
                                    $extension = strtolower($extension);

                                    if (IS_UPLOADED_FILE($_FILES['spk_file']['tmp_name'])) {
                                        if ($errors > 0) {
                                            $error = "Return Code: " . $errors . "";
                                            error_message($error);
                                        } else if ($extension != "pdf") {
                                            $error = "Invalid file type! ($extension)";
                                            error_message($error);
                                        } else if ($ukuranfile > $maxsize) {
                                            $error = "Ukuran melebihi batas max! ($ukuranfile KB >$maxsize KB)";
                                            error_message($error);
                                        } else {
                                            //SUKSES no Error	
                                            //$namafile=strtolower($nama_lkp).'.'.$extension;
                                            $namafile = strtolower($namafile);
                                            $filename = $target_path . $namafile;
                                            MOVE_UPLOADED_FILE($tmpfile, $filename);
                                        }
                                    }
                                    ////////////////////
                                    //INSERT to tbl kontrak_unit
                                    //echo "<script>alert('tes insert data.....')</script>";
                                    //biaya lainnya
                                    $nama_biaya = "";
                                    $price_biaya = "";
                                    for ($i = 0; $i < count($_POST['jml_cost']); $i++) {
                                        $nama_biaya .= strtoupper($_POST['nama_cost'][$i]) . "~";
                                        $price_biaya .= str_replace(",", "", $_POST['nilai_cost'][$i]) . "~"; //nilai biaya lainnya
                                    }
                                    $dt_unit = "";
                                    //echo "<script>alert($jmlunit)</script>";
                                    for ($i = 0; $i < $jmlunit; $i++) {
                                        $idunit = explode("~", $_POST['id_unit'][$i]);
                                        $id_unit = rtrim($idunit[0], " ");
                                        $nilai[$i] = str_replace(",", "", $_POST['nilai'][$i]); //nilai tarif sewa
                                        $xbobot[$i] = str_replace(",", "", $_POST['bobot'][$i]); //nilai tarif sewa
                                        $xtarifbobot[$i] = str_replace(",", "", $_POST['tarif_bobot'][$i]); //nilai tarif sewa
                                        $xbiayabobot[$i] = str_replace(",", "", $_POST['biaya_bobot'][$i]); //nilai tarif sewa
                                        $keterangan[$i] = $_POST['keterangan'][$i];
                                        //-----
                                        //Unit Properties
                                        $sql = mysql_query("SELECT * FROM ekspedisi WHERE nopol='$id_unit'") or die('Query 1a salah: ' . mysql_error());;
                                        $row = mysql_fetch_array($sql);
                                        $sql2 = "INSERT INTO kontrak_project (no_kontrak, mou_kontrak, tgl_reg, id_unit,no_unit, nama_alat, merk, type, id_site, nama_site, nama_proyek, alamat, kota, provinsi, id_site_br, site_br, proyek_br, nilaikontrak,  nilai_kontrak, jangka_wkt, tgl_mulai, tgl_selesai,bobot, tarif_bobot, biaya_bobot, keterangan, file_spk, admin, rent_nama, rent_jabatan, rent_company, rent_almt, nama_known, jbtn_known,no_pol) 
										values('$id_kontrak', '$mou_kontrak', '$tgl_input', '$row[id]', '$row[nopol]', '$row[nama_alat]', '$row[merk]', '$row[type]', '$row[id_site]', '$row[nama_site]', '$row[nama_proyek]', '$row[alamat]', '$row[kota]', '$row[provinsi]', '$row1b[no]', '$row1b[nama_site]', '$row1b[nama_proyek]', '$nilaikontrak', '$nilai[$i]', '$jangka_wkt', '$tgl_start', '$tgl_end', '$xbobot[$i]', '$xtarifbobot[$i]','$xbiayabobot[$i]', '$keterangan[$i]', '$filename', '$officer', '$rent_nama', '$rent_jabatan', '$rent_company', '$rent_almt', '$nama_known', '$jbtn_known','CNP')";

                                        $hasil = mysql_query($sql2) or die('SQL Input Kontrak Salah: ' . mysql_error());
                                        //update site-proyek UNIT
                                        $sql3 = "UPDATE ekspedisi SET
						id_site='$row1b[no]',
						nama_site='$row1b[nama_site]',
						nama_proyek='$row1b[nama_proyek]',
						alamat='$row1b[alamat_site]',
						kota='$row1b[kota_site]',
						provinsi='$row1b[prov_site]'
						WHERE nopol='$id_unit' LIMIT 1";
                                        $hasil3 = mysql_query($sql3) or die('Query 3 Salah: ' . mysql_error());
                                        $dt_unit .= $_POST['id_unit'][$i] . "<BR>";
                                    }
                                    //if($hasil3){

                                    ?>
                        <script>
                        swal({
                            title: "<p style=\"font-size:26px; color:#83C750; text-align:center;\">Aplikasi Project:<BR><font color='green'><?php echo "$mou_kontrak"; ?></font><BR>telah Disimpan.</p>",
                            text: "<p style=\"font-size:24px; color:#0036FF; text-align:center;\">Silahkan Approve & Input Mutasi Alat: <b><u><?php echo "$dt_unit"; ?></b></u>.</p>",
                            html: true,
                            type: "success",
                            timer: 3000,
                            showConfirmButton: false,
                            closeOnConfirm: false
                        });
                        </script>
                        <?php
                                    //echo"<script>setTimeout(\"window.location='?c=contract#bwh'\",5800);</script>";	
                                    echo "<script>setTimeout(\"window.location='?c=detil&no_app=$mou_kontrak&cont=$id_kontrak#bwh'\",3500);</script>";
                                    //} //END SUBMIT
                                    break;

                                case "contract":
                                ?>
                        <style>
                        .loader {
                            position: fixed;
                            left: 0px;
                            top: 0px;
                            width: 100%;
                            height: 100%;
                            z-index: 9999;
                            background: url('green_loader.gif') 50% 50% no-repeat rgb(249, 249, 249);
                        }

                        ::-webkit-scrollbar-thumb {
                            background: #00d900;
                        }

                        .scrollable-element {
                            scrollbar-color: #6cd900 #99ccff;
                            scrollbar-width: thin;
                        }

                        th {
                            background: #0000ff;
                            color: #FFF;
                            height: 30px;
                            position: sticky;
                            top: 0;
                            border-bottom: 1px solid #FFF;
                            border-top: 1px solid #FFF;
                            /*box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);*/
                        }

                        .closed {
                            /*background:url("closed3a.jpg");*/
                            background: url("closed-logo.png");
                            background-position: center center;
                            background-repeat: no-repeat;
                            /*background-attachment: fixed;*/
                            background-size: cover;
                            background-size: 100% 90%;
                            /*z-index: 80;*/
                            opacity: 0.7;
                        }

                        .addendum {
                            background: url("icon_add.jpg");
                            background-repeat: x-repeat;
                            width: auto;
                            height: 50%;
                            opacity: 0.7;
                        }
                        </style>
                        <script type="text/javascript">
                        $(window).load(function() {
                            $(".loader").fadeOut("fast");
                        })
                        </script>
                        <!--LOADER-->
                        <div class="loader">Loading...</div>
                        <script type="text/javascript">
                        function focus_awl() {
                            document.forms[0].form_text_search.focus();
                            //setTimeout("focus_awl()", 300000);//5 mnt
                        }
                        </script>

                        <?php
                                    $referer = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                    //SQL Filter Nama Barang
                                    if (isset($_POST['go_filter'])) {
                                        $field1    = $_POST['field1']; //satuan
                                        $field2    = addslashes($_POST['field2']); //jns alat
                                        $field3    = addslashes($_POST['field3']); //site
                                        $field4    = addslashes($_POST['field4']); //proyek
                                        $wheres = "WHERE ";
                                        if ($field1 == 'ALL') {
                                            $field1 = "satuan LIKE '%%' ";
                                        } else {
                                            $field1 = "satuan='$field1' ";
                                        }

                                        if ($field2 == 'ALL') {
                                            $field2 = "AND nama_alat LIKE '%%' ";
                                        } else {
                                            $field2 = "AND nama_alat='$field2' ";
                                        }

                                        if ($field3 == 'ALL') {
                                            $field3 = "AND site_br LIKE '%%' ";
                                        } else {
                                            $field3 = "AND site_br='$field3' ";
                                        }

                                        if ($field4 == 'ALL') {
                                            $field4 = "AND proyek_br LIKE '%%' ";
                                        } else {
                                            $field4 = "AND proyek_br='$field4' ";
                                        }

                                        $field5 = "AND no_pol='CNP' ";

                                        //SQL Search 
                                        //".$field1." AND ".$field2." AND ".$field3." AND ".$field4."
                                        $s1 = "SELECT * FROM kontrak_project WHERE $field1 $field2 $field3 $field4 GROUP BY no_kontrak ORDER BY no DESC";
                                        $r1 = mysql_query($s1) or die('SQL Filter salah: ' . mysql_error());
                                        $ada = mysql_num_rows($r1);
                                        //echo"SQL: $s1";
                                        $q       = mysql_query("SELECT COUNT(DISTINCT(no_kontrak)) AS jumData FROM kontrak_project");
                                        $data   = mysql_fetch_array($q);
                                        $jumData = $data['jumData'];
                                    } else {
                                        //NORMAL
                                        //$s1="SELECT * FROM kontrak_project GROUP BY no_kontrak ORDER BY no LIMIT $batas,$item_per_page";
                                        $r1 = mysql_query("SELECT * FROM kontrak_project where no_pol = 'CNP' GROUP BY no_kontrak ORDER BY no DESC") or die('sql dt kontrak_project salah: ' . mysql_error());
                                        $ada = mysql_num_rows($r1);
                                        $q       = mysql_query("SELECT COUNT(DISTINCT(no_kontrak)) AS jumData FROM kontrak_project");
                                        $data   = mysql_fetch_array($q);
                                        $jumData = $data['jumData'];
                                    }
                                    //echo"SQL: $s1";
                                    //$alamat=$_SERVER['REQUEST_URI'];

                                    //AUTO CONTRACT DONE
                                    ////$exp_contr_day=time()+(60*60*24*1); //1 hr
                                    ////$sql2=mysql_query("UPDATE kontrak_project SET kontrak_done='1' WHERE $exp_contr_day >= UNIX_TIMESTAMP(tgl_selesai) AND kontrak_done='0'") or die ('sql kontrak_done=1 salah: '.mysql_error());
                                    //////////
                                    /*
				////////SQL AUTO RE-NEW SITE/PROYEK/////////////////
									$sql1="SELECT no,id_unit,site_br,proyek_br FROM kontrak_project WHERE kontrak_done='1' ORDER BY no";
									$rst1=mysql_query($sql1);
									while($row1=mysql_fetch_array($rst1)){
										echo"$row1[no] $row1[id_unit]/ ";
									}
									/*$sql2="UPDATE ekspedisi SET 
										id_site='', 
										nama_site='', 
										nama_proyek=''
										WHERE id=''";
									*/
                                    //////////////////////////////////////////////////////
                                    // echo "<script>bid_focus()</script>";
                                    echo " <tr>
							<td colspan='8' height='25' align='left'>
								<div class='container'>DATA KONTRAK APPLICATION PROJECT ($ada/$jumData)</b>
								<div style='text-align:right;float:right;margin:auto;margin-right:2px;'>
									<input type='button' class='btn5' style='font-size:12px;width:auto;padding:3px;' value='Data Invoice' title='Invoice App Project' OnClick=\"window.location='invoice-unit?c=data_tag'\">	
								</div>
								&nbsp
								<div style='text-align:right;float:right;margin:auto;margin-right:8px;'>
									<input type='button' class='btn5' style='font-size:12px;width:auto;padding:3px;' value='+ Aplikasi Project' title='Input Aplikasi Project' OnClick=\"window.location='?c=input'\">	
								</div>
								</div>
							</td>
						</tr>
						<!--SEARCH-->
						<tr>
						<td align='center' colspan='3'>
							<div class='container'>	
							<table width='100%' border='0' cellspacing='0' cellpadding='0' >
								<tr>
									<FORM name='filter2' action='' method='POST'>
									<!--SEARCH-->
									<td align='center' width='100%'><input type='text' name='form_text_search' class='search2' id='jquery_search_sample' title='Cari di Hal ini' maxlength='25' style='width:250px;border-color:#0707BE' placeholder='No. App. Project / No.ALAT'>
									&nbsp
									<b><i>FILTER</i><b>: 
										<select name='field1' title='Satuan Sewa' style='width:120px;border-color:#5BDB0E'>";
                                    if (isset($_POST['field1'])) {
                                        echo "<option value='" . $_POST['field1'] . "' selected>" . $_POST['field1'] . "</option>";
                                        echo "<option value='ALL'>ALL</option>";
                                    } else {
                                        echo "<option value='ALL' style='font-style:italic;'>ALL</option>";
                                    }
                                    //echo"<option value='' selected>-SEMUA-</option>";
                                    //nama merk
                                    $query2 = "SELECT DISTINCT(satuan) FROM kontrak_project ORDER BY satuan";
                                    $rst2 = mysql_query($query2) or die('QUERY 1 salah: ' . mysql_error());
                                    while ($row2 = mysql_fetch_array($rst2)) {
                                        echo "<option value='$row2[satuan]'>$row2[satuan]</option>";
                                    }
                                    echo "</select>";
                                    echo "&nbsp";
                                    echo "<select name='field2' title='Jenis Alat' style='width:120px;border-color:#5BDB0E'>";
                                    if (isset($_POST['field2'])) {
                                        echo "<option value='" . $_POST['field2'] . "' selected>" . $_POST['field2'] . "</option>";
                                        echo "<option value='ALL'>ALL</option>";
                                    } else {
                                        echo "<option value='ALL' style='font-style:italic;'>ALL</option>";
                                    }
                                    //echo"<option value='' selected>-SEMUA-</option>";
                                    //jenis alat
                                    $query = "SELECT DISTINCT(nama_alat) FROM kontrak_project order by nama_alat";
                                    $rst = mysql_query($query) or die('QUERY 2 salah: ' . mysql_error());
                                    while ($row = mysql_fetch_array($rst)) {
                                        echo "<option value='" . strtoupper($row['nama_alat']) . "'>" . strtoupper($row['nama_alat']) . "</option>";
                                    }
                                    echo "</select>";
                                    echo "&nbsp";

                                    echo "<select name='field3' title='Site' style='width:200px;border-color:#5BDB0E'>";
                                    if (isset($_POST['field3'])) {
                                        echo "<option value='" . $_POST['field3'] . "' selected>" . $_POST['field3'] . "</option>";
                                        echo "<option value='ALL'>ALL</option>";
                                    } else {
                                        echo "<option value='ALL' style='font-style:italic;'>ALL</option>";
                                    }
                                    $query3 = "SELECT DISTINCT(site_br) FROM kontrak_project order by site_br";
                                    $rst3 = mysql_query($query3) or die('QUERY 3 salah: ' . mysql_error());
                                    while ($row3 = mysql_fetch_array($rst3)) {
                                        echo "<option value='$row3[site_br]'>$row3[site_br]</option>";
                                    }
                                    echo "</select>";
                                    echo "&nbsp";
                                    echo "<select name='field4' title='Proyek' style='width:400px;border-color:#5BDB0E'>";
                                    if (isset($_POST['field4'])) {
                                        echo "<option value='" . $_POST['field4'] . "' selected>" . $_POST['field4'] . "</option>";
                                        echo "<option value='ALL'>ALL</option>";
                                    } else {
                                        echo "<option value='ALL' style='font-style:italic;'>ALL</option>";
                                    }
                                    $query4 = "SELECT DISTINCT(proyek_br) FROM kontrak_project order by proyek_br";
                                    $rst4 = mysql_query($query4) or die('QUERY 4 salah: ' . mysql_error());
                                    while ($row4 = mysql_fetch_array($rst4)) {
                                        echo "<option value='$row4[proyek_br]'>$row4[proyek_br]</option>";
                                    }
                                    echo "</select>";
                                    echo "&nbsp <input type='submit' name='go_filter' value='Go' title='Filter' style='cursor:pointer;background:#60D11C;border: 1px solid #FFF;width:auto;' onmouseover=\"style.background='#B8FB90';\" onmouseout=\"style.background='#60D11C'\">";
                                    //PRINT 
                                    if (isset($_POST['field1']) or isset($_POST['field2']) or isset($_POST['field3']) or isset($_POST['field4'])) {
                                        echo "<font style='float:right;vertical-align:bottom;margin-right:0;padding-top:8px;'><a class='img' href='print_app_pro_cnp?f1=" . $_POST['field1'] . "&f2=" . $_POST['field2'] . "&f3=" . $_POST['field3'] . "&f4=" . $_POST['field4'] . "' target='_blank' title='Print hal ini'><img src='printable.gif' border='0' width='20' height='20'></a>
										       </font>";
                                    } else {
                                        echo "<font style='float:right;vertical-align:bottom;margin-right:0;padding-top:8px;'><a class='img' href='print_app_pro_cnp?f1=ALL&f2=ALL&f3=ALL&f4=ALL' target='_blank' title='Print hal ini'><img src='printable.gif' border='0' width='20' height='20'></a>
										      </font>";
                                    }
                                    echo "</td>
								</FORM>
								</tr>
							</table>
							</div>
						</td>
						</tr>
						<!--SEARCH-->
						<tr>
							<td align='center' width='100%'>
							<div class='pageborder' style='width:auto;'>
							<table width='100%' border='0' style='border-collapse: collapse' borderColor='#FFF' cellpadding='3' cellspacing='0'>
								<thead>
								<tr>
									<th width='3%' align='center' style='color:#FFF;'>No.</th>
									<th width='4%' align='center' style='color:#FFF;'>Tgl</th>
									<th width='10%' align='center' style='color:#FFF;'>No.Kontrak</th>
									<th width='12%' align='center' style='color:#FFF;'>Unit</th>
									<th width='5%' align='center' style='color:#FFF;'>Satuan</th>
                                    <th width='5%' align='right' style='color:#FFF;'>Volume</th>
                                    <th width='7%' align='right' style='color:#FFF;'>Tarif</b></th>
									<th width='7%' align='right' style='color:#FFF;'>Biaya</th>
									<th width='10%' align='center' style='color:#FFF;'>Project</th>
									<th width='9%' align='center' style='color:#FFF;'>Nilai Kontrak</th>
									
									<th width='7%' align='center' style='color:#FFF;'>Tgl mulai</th>
									<th width='7%' align='center' style='color:#FFF;'>Tgl selesai</th>
									<th width='5%' align='center' style='color:#FFF;'>Waktu</th>
									
									<th width='25%' align='center' style='color:#FFF;'>ACT</th>
								</tr></thead>";
                                    ///ISI DATA KONTRAK PROJECT///////////
                                    echo "<tbody>";
                                    $no = 0;
                                    $ttl_tag = 0;
                                    $ttl_pay = 0;
                                    $ttl_sisa_pay = 0;
                                    $batas = 0;
                                    while ($row = mysql_fetch_array($r1)) {
                                        $batas++;
                                        $tglin = explode("-", $row['tgl_reg']);
                                        $tgl_in = $tglin[2] . "/" . $tglin[1] . "/" . substr($tglin[0], 2, 2);
                                        $tgl_m = explode("-", $row['tgl_mulai']);
                                        $tgl_mulai = $tgl_m[2] . "/" . $tgl_m[1] . "/" . substr($tgl_m[0], 2, 2);
                                        $tgl_s = explode("-", $row['tgl_selesai']);
                                        $tgl_selesai = $tgl_s[2] . "/" . $tgl_s[1] . "/" . substr($tgl_s[0], 2, 2);

                                        //SISA HARI KONTRAK
                                        $time_exp_sli = 0;
                                        $tgl_sli_kontrak = "";
                                        $now = strtotime(date('Y-m-d'));
                                        $mli_kontrak = strtotime($row['tgl_mulai']);
                                        $timeskrg = $now;
                                        $tglend = strtotime($row['tgl_selesai']);
                                        $lama_kontrak = ceil(($tglend - $mli_kontrak) / (60 * 60 * 24));
                                        if ($tglend > $now) {
                                            $sisa_hr = ceil(($tglend - $now) / (60 * 60 * 24));
                                        } else if ($tglend == $now or $row['addendum'] == 1 or $row['kontrak_done'] == 1) {
                                            $sisa_hr = 0;
                                        } else { //minus
                                            $sisa_hr = ceil(($tglend - $now) / (60 * 60 * 24));
                                        }
                                        //PENANDA HABIS MASA KONTRAK
                                        $time_exp_sli = $tglend;
                                        $timeskrg += 29 * 86400; //dikurang selang 1 bulan
                                        if ($timeskrg >= $time_exp_sli and $sisa_hr <= 0) { //tgl sudah lebih dari 30 hari dr skrg
                                            $tgl_sli_kontrak = "<font color='RED'>$tgl_selesai</font>"; //Merah
                                            $txt_lama = "<font color='red'>($lama_kontrak Hr)</font>";
                                            $txt_sisa_hari = "<font color='red'>$sisa_hr</font>";
                                        } else if ($sisa_hr > 0 and $sisa_hr <= 30) { //tgl sli krg dr 30 hari dr skrg
                                            $tgl_sli_kontrak = "<font color='#ffc926'>$tgl_selesai</font>"; //kuning
                                            $txt_lama = "<font color='#ffc926'>($lama_kontrak Hr)</font>";
                                            $txt_sisa_hari = "<font color='#ffc926'>$sisa_hr</font>";
                                        } else {
                                            $tgl_sli_kontrak = "<font color='#008c00'>$tgl_selesai</font>";    //Hijau
                                            $txt_lama = "<font color='#008c00'>($lama_kontrak Hr)</font>";
                                            $txt_sisa_hari = "<font color='#008c00'>$sisa_hr</font>";
                                        }

                                        $nominal = number_format($row['nilaikontrak'], 0, ".", ",");
                                        //$biayasewa = number_format($row['biaya_sewa'], 0, ".", ",");

                                        //cari sisa pembayaran kontrak unit
                                        $qry1 = mysql_query("SELECT sum(jml_pay) As JmlPay FROM project_pay WHERE no_kontrak='$row[no_kontrak]' AND mou_kontrak='$row[mou_kontrak]'") or die('qry1 salah:' . mysql_error());
                                        $qry1a = mysql_query("SELECT COUNT(no_kontrak) FROM project_pay WHERE no_kontrak='$row[no_kontrak]' AND mou_kontrak='$row[mou_kontrak]'") or die('qry1a salah:' . mysql_error());
                                        $rw1 = mysql_fetch_array($qry1);
                                        $rw1a = mysql_fetch_array($qry1a);
                                        $ada_pay = $rw1a[0];
                                        $sisa_pay = $row['nilaikontrak'] - $rw1['JmlPay'];
                                        //alamat site_br
                                        $qry2 = mysql_query("SELECT alamat_site FROM site_proyek WHERE no = '$row[id_site_br]'");
                                        $rw2 = mysql_fetch_array($qry2);
                                        //INT/EXT
                                        $qry3 = mysql_query("SELECT tipe_site FROM site_proyek WHERE no = '$row[id_site_br]'");
                                        $rw3 = mysql_fetch_array($qry3);
                                        //TTL
                                        $ttl_tag += $row['nilaikontrak'];
                                        $ttl_pay += $rw1['JmlPay'];
                                        $ttl_sisa_pay += $sisa_pay;

                                        //ISI DATA KONTRAK APP PROJECT///////////////////
                                        //Tabel Kontrak Project Habis
                                        if ($now > $tglend and $row['kontrak_done'] == 0) { //KONTRAK HABIS
                                            $bgcolor = '#cacad9'; //grey muda
                                            $bgcolor2 = '#FFF';
                                            $trjdl = "<tr class=\"jsearch-row\" style=\"border-bottom:1px solid green;cursor:auto;\" bgcolor=$bgcolor>";
                                            //}else if($now>$tglend AND $row['kontrak_done']==1){ //kontrak CLOSED
                                        } else if ($sisa_hr <= 30 and $sisa_pay == 0 and $row['kontrak_done'] == 1) { //SUDAH di-close project
                                            $bgcolor = '#666666';
                                            $bgcolor2 = '#FFF';
                                            $trjdl = "<tr class=\"jsearch-row closed\" style=\"border-bottom:1px solid green;cursor:not-allowed;\">";
                                        } else if ($row['addendum'] == 1) { //SUDAH di-Addendum
                                            $trjdl = "<tr class=\"jsearch-row addendum\" style=\"border-bottom:1px solid green;cursor:not-allowed;\">";
                                            /*}else if($batas % 2 == 1) {
										$bgcolor='#DAEFF9';
										$bgcolor2='#FFF';
										$trjdl="<tr class=\"jsearch-row\" style=\"border-bottom:1px solid green;cursor:auto;\" bgcolor=$bgcolor>";
									}*/
                                        } else {
                                            $bgcolor = '#DAEFF9'; //#C3E4F4
                                            $bgcolor2 = '#FFF';
                                            $trjdl = "<tr class=\"jsearch-row\" style=\"border-bottom:1px solid green;cursor:auto;\" bgcolor=$bgcolor>";
                                        }
                                        //jml unit/alat
                                        $sql1 = mysql_query("SELECT COUNT(id_unit) As JmlUnt FROM kontrak_project WHERE no_kontrak='$row[no_kontrak]' AND no_pol='CNP'");
                                        $row1 = mysql_fetch_array($sql1);
                                        $jml_unt = $row1['JmlUnt'];
                                        //ISI
                                        echo "$trjdl
										<td align='center'><a class='enam' name='$batas'><b>$batas</b></a></td>
										<td align='center' valign='top'>$tgl_in</td>
										<td align='left' valign='top' class=\"jsearch-field\">
											<div class='label2b' style='width:95%;'>$row[mou_kontrak]</div>
											<div class='label2b' style='margin-top:2px;width:95%;'><a class='empat' style='font-weight:normal;font-style:italic;' name='$row[no_kontrak]'>$row[no_kontrak]</div>
											<div class='label2b' style='margin-top:2px;width:95%;COLOR:#000;font-weight:normal;'>$jml_unt Unit/Alat</div>
										</td>
										<td align='left' valign='top' class=\"jsearch-field\">";
                                        //item alat
                                        $sql = "SELECT id_unit,no_unit,merk,type,nama_alat,biaya_sewa,bobot,biaya_bobot FROM kontrak_project WHERE no_kontrak='$row[no_kontrak]' AND no_pol='CNP'";
                                        $rst = mysql_query($sql) or die('sql item alat salah:' . mysql_error());
                                        $item = 0;

                                        while ($row1 = mysql_fetch_array($rst)) {
                                            echo "<div class='label5' style='width:100%;text-align:left;'><a class='empat' data-balloon='Detil Unit' data-balloon-pos='right' rel=\"modal:open\" href='detil_unit?no=$row[no]&id=$row[id_unit]&seri=$row[no_unit]&merk=$row[merk]&type=$row[type]'>$row1[no_unit] (<i>$row1[id_unit]</i>)</a><BR>$row1[merk]<BR>$row1[type] <BR><font color='blue'><i>$row1[nama_alat]</i></font></div><BR>";
                                            // echo "<div  style='width:100%;text-align:right;'><b>$row1[biaya_sewa]</b></div>";
                                        }
                                        $sat_sewa = "M3";
                                        echo "</td>
										<td align='center' valign='top'>$sat_sewa</td>";
                                        $sql = "SELECT id_unit,no_unit,merk,type,nama_alat,bobot,biaya_bobot FROM kontrak_project WHERE no_kontrak='$row[no_kontrak]' AND no_pol='CNP'";
                                        $rst1x = mysql_query($sql) or die('sql item alat salah:' . mysql_error());
                                        $item = 0;
                                        echo "<td align='right'>";
                                        while ($row1x = mysql_fetch_array($rst1x)) {
                                            echo "" . number_format($row1x['bobot'], 0, ".", ",") . " M3<br>";
                                        }
                                        echo "</td>";
                                        $sql = "SELECT id_unit,no_unit,merk,type,nama_alat,bobot,tarif_bobot,biaya_bobot FROM kontrak_project WHERE no_kontrak='$row[no_kontrak]' AND no_pol='CNP'";
                                        $rst1y = mysql_query($sql) or die('sql item alat salah:' . mysql_error());
                                        $item = 0;
                                        echo "<td align='right'>";
                                        while ($row1y = mysql_fetch_array($rst1y)) {
                                            echo "" . number_format($row1y['tarif_bobot'], 0, ".", ",") . "<br>";
                                        }
                                        echo "</td>";

                                        $sql = "SELECT id_unit,no_unit,merk,type,nama_alat,bobot,biaya_bobot FROM kontrak_project WHERE no_kontrak='$row[no_kontrak]' AND no_pol='CNP'";
                                        $rst1 = mysql_query($sql) or die('sql item alat salah:' . mysql_error());
                                        $item = 0;
                                        echo "<td align='right'>";
                                        while ($row11 = mysql_fetch_array($rst1)) {
                                            echo "" . number_format($row11['biaya_bobot'], 0, ".", ",") . "<br>";
                                        }
                                        echo "</td>								
										
										<td align='left' valign='top'>[$row[site_br]] $row[proyek_br](<i>$rw3[0]</i>)<BR><i><font color='blue'>$row[proyek_br]</font></i><BR>$rw2[alamat_site]<BR><BR>Penyewa : $row[rent_company]</td>
										<td align='right'>$nominal<br></td>";
										
										
                                        echo "<td width='100px;' align='center'>";
                                        echo "<b>" . $row[''] . "</b><br>";
                                        echo "</td>";
                                        
                                        echo "<td width='100px;' align='center'>";
                                        echo "<b>" . $row[''] . "</b><br>";
                                        echo "</td>";
                                        echo "<td width='100px;' align='center'>";
                                        echo "" . number_format($row[''], 0, ".", ",") . " <br>";
                                        echo "</td>	
                                        <td align='center'>
										
										";
                                        


                                        //ACTION
                                        //if($sisa_hr==0 AND $rw1[sisa_pay]==0){
                                        if ($ada_pay == 0) {
                                            echo "<!--<a class='img' href='contract-pay?c=pay&mou=$row[mou_kontrak]&cont=$row[no_kontrak]#bwh' title='Pembayaran: $row[mou_kontrak]'><img src='dollar3.png' width='20' height='20' border='0'></a>-->
												 <a class='img' href='edit_app_project_cnp?c=edit&no_app=$row[mou_kontrak]&no=$row[no]&cont=$row[no_kontrak]&urut=$batas' title='Edit: $row[mou_kontrak]'><img src='edit.gif' border='0'></a>
												";
                                        } else if ($ada_pay > 0 and $sisa_pay > 0) {
                                            echo "<!--<a class='img' href='contract-pay?c=pay&mou=$row[mou_kontrak]&cont=$row[no_kontrak]#bwh' title='Pembayaran: $row[mou_kontrak]'><img src='dollar3.png' width='20' height='20' border='0'></a>-->
												 <a class='img' href='javascript:void(0);' style='cursor:not-allowed;' title='No-Edit: $row[mou_kontrak]'><img src='none.png' width='20' height='20' border='0'></a>";
                                        } else if ($ada_pay > 0 and $sisa_pay == 0) {
                                            echo "<a class='img' href='javascript:void(0);' style='cursor:not-allowed;' title='Pembayaran-Lunas'><img src='ok2.png' width='20' height='20' border='0'></a>
												 <a class='img' href='javascript:void(0);' style='cursor:not-allowed;' title='No-Edit2: $row[mou_kontrak]'><img src='none.png' width='20' height='20' border='0'></a>";
                                        }
                                        if ($ada_pay == 0 or ($sisa_hr <= 30 and $sisa_pay > 0 and $row['addendum'] == 1)) { //DEL atau //SUDAH di adendum
                                            echo " <a class='img' href='javascript:void(0)' title='Delete: $row[mou_kontrak]' onclick=\"return konfirm_delete('$row[id_unit]','$row[no_unit]','$row[no]','$row[no_kontrak]','$row[mou_kontrak]');\"><img src='delete.gif' border='0'></a>";
                                        } else {
                                            echo " <a class='img' href='javascript:void(0)' title='No-Delete: $row[mou_kontrak]' style='cursor:not-allowed'><img src='none.png' width='20' height='20' border='0'></a>";
                                        }
                                        //detil
                                        echo " <a class='img' href='?c=detil&no_app=$row[mou_kontrak]&no=$row[no]&cont=$row[no_kontrak]' title='Detil & Approve: $row[mou_kontrak]'><img src='order.png' width='20' height='20' border='0'></a>";

                                        //Addendum Project
                                        if ($sisa_hr <= 30 and $sisa_pay > 0 and $row['addendum'] == 0) { //di adendum
                                            echo " <a class='img' title='Addendum Proyek: $row[mou_kontrak]' href='javascript:void(0);' onclick=\"return confirm_add_rent('$row[no_kontrak]','$row[mou_kontrak]')\"><img src='add_file.png' width='20' height='20' border='0'></a>";
                                        } else if ($sisa_hr <= 30 and $sisa_pay > 0 and $row['addendum'] == 1) { //SUDAH di adendum
                                            echo " <a class='img' title='Sudah di Addendum Tgl: $row[tgl_add]' href='javascript:void(0);' style='cursor:not-allowed'><img src='oke_gray.png' width='20' height='20' border='0'></a>";
                                        } else if ($sisa_hr <= 30 and $sisa_pay == 0 and $row['kontrak_done'] == 0 and $_COOKIE['status'] == 'ADMIN') { //close project hanya oleh ADMIN
                                            echo " <a class='img' title='Close Proyek: $row[mou_kontrak]' href='javascript:void(0);' onclick=\"return confirm_close('$row[no_kontrak]','$row[mou_kontrak]')\"><img src='logout.png' width='20' height='20' border='0'></a>";
                                        } else if ($sisa_hr <= 30 and $sisa_pay == 0 and $row['kontrak_done'] == 1) { //SUDAH di-close project
                                            echo " <a class='img' title='Project Closed: $row[tgl_closed]' href='javascript:void(0);' style='cursor:not-allowed'><img src='none.png' width='20' height='20' border='0'></a>";
                                        } else if ($sisa_hr > 0) { //dlm masa kontrak (on contract) +30 hr
                                            echo " <img title='On Contact' src='checked.png' width='20' height='20' border='0'>";
                                        }

                                        //Approve Project	
                                        if ($row['approve'] == 0) {
                                            echo "<BR><BR><a class='empat' style='width:auto; border:1px solid #000;padding:4px 8px;border-radius:3px;background:#EEE' data-balloon='Preview App Project' data-balloon-pos='up' rel=\"modal:open\"  href='preview_ap_cnp?no=$row[no]&app_pro=$row[mou_kontrak]&no_cont=$row[no_kontrak]'>Preview</a>";
                                        } else {
                                            echo "<input type='button' class='btn6' value='Cetak' onclick=\"window.open('print_ap_cnp?app_pro=$row[mou_kontrak]&no_cont=$row[no_kontrak]')\">";
                                        }
                                        echo "</td>
									</tr>";

                                        //Data Pembayaran KONTRAK
                                        $qry = mysql_query("SELECT * FROM project_pay WHERE no_kontrak='$row[no_kontrak]' AND mou_kontrak='$row[mou_kontrak]'") or die('qry salah:' . mysql_error());
                                        $num = 0;
                                        $jml_sisa_pay = $row['nilaikontrak'];
                                        $ttl_pay1 = 0;
                                        while ($rw = mysql_fetch_array($qry)) {
                                            $num++;
                                            //$nom_sisa=number_format($rw[sisa_pay],0,",",".");
                                            $jml_sisa_pay -= $rw['jml_pay'];
                                            $tgl_inv = explode("-", $rw['tgl_invoice']);
                                            $tglinv = $tgl_inv[2] . "/" . $tgl_inv[1] . "/" . $tgl_inv[0];
                                            $ttl_pay1 += $rw['jml_pay'];
                                            echo "
											<!--onmouseover=\"style.background='#B8FB90';\" onmouseout=\"style.background=''\"-->
											<tr class=\"jsearch-row\" bgcolor=$bgcolor2 style='border-bottom:1px solid #EEE'>
												<td align='center' colspan='4' class=\"jsearch-field\"><font color='#FFF'>$row[mou_kontrak]|$row[no_unit]|$row[no_kontrak]</font></td>
												<td align='right' class=\"jsearch-field\"><font color='#008c00'><i>Pymnt-$num</i></font></td>
												<td align='left' style='color:#008c00' onmouseover=\"title='No. Invoice'\"><a class='enam' href='print_inv_contract?inv=$rw[no_invoice]&no=$row[no_kontrak]&mou=$row[mou_kontrak]' target='_blank' title='Print'><i>$rw[no_invoice]</i></a></td>
												<td align='right' style='color:#008c00' colspan='2' onmouseover=\"title='Jml Pembayaran'\"><i>" . number_format($rw['jml_pay'], 0, ".", ",") . "</i></td>
												<td align='right' style='color:#008c00' colspan='2' onmouseover=\"title='Jml Sisa'\"><i>" . number_format($jml_sisa_pay, 0, ".", ",") . "</i></td>
												<td align='center'style='color:#008c00' colspan='2' onmouseover=\"title='Tgl Invoice'\"><i>$tglinv</b>
												<!--EDIT PAYMENT-->
												<!--	
													<font style='float:right;'>
													<a class='img' href='contract-pay?c=edit_pay&mou=$row[mou_kontrak]&cont=$row[no_kontrak]&inv=$rw[no_invoice]#bwh' title='Edit Pembayaran'><img src='edit.gif' border='0'></a>
													</font>
												-->
												</td>
											</tr>";
                                        } //end while
                                        $num = 0;

                                        //Ttl pembayaran per-MOU
                                        echo "<tr bgcolor='#FFF' style='border-top:1px solid green;border-bottom:2px solid green;' class=\"jsearch-row\" height='30'>
										<td colspan='7' class=\"jsearch-field\" align='right' style='color:#008c00'><font color='#FFF'>$row[mou_kontrak]|$row[no_unit]</font> <b>TOTAL (<i>TAGIHAN ~ PEMBAYARAN ~ SISA</i>)</b>
										<td align='right' style='color:#008c00' style=\"onmouseover\"title='Total Tagihan'\"\"><b><i>" . number_format($row['nilaikontrak'], 0, ".", ",") . "</i></b></td>
										<td colspan='2' align='right' style='color:#008c00' style=\"onmouseover\"title='Total Pembayaran'\"\"><b><i>" . number_format($ttl_pay1, 0, ".", ",") . "</i></b></td>
										<td colspan='2' align='right' style='color:#008c00' style=\"onmouseover\"title='Sisa Tagihan'\"\"><b><i>" . number_format($jml_sisa_pay, 0, ".", ",") . "</i></b></td>
										<td align='center' style='color:#008c00'>-</td>
										<td align='center' style='color:#008c00'></td>
									</tr>";
                                        //pembatas
                                        //echo"<tr><td colspan='11'>&nbsp;</td></tr>";
                                    } //end while
                                    echo "<tr><td colspan='11'><a name='bwh'></a></td></tr>";
                                    //jika KOSONG
                                    if ($ada < 1) {
                                        echo "<td class='td3' align='center' colspan='12'><font color='red'>---DATA KONTRAK (APP PROJECT) MASIH KOSONG---</font></td></tr>";
                                    }

                                    //TOTAL PER-HAL
                                    echo "<tr bgcolor='#FFF' height='40'>
								<td colspan='14' align='right' style='font-weight:bold;'>
									<b>GRAND TOTAL: </b>&nbsp;
									<font style='padding:6px;background-color:#00d900;border:1px solid #00d900'>Tagihan</font><font style='padding:6px;background-color:#FFF;border:1px solid #00d900'>&nbsp;" . number_format($ttl_tag, 0, ".", ",") . "</font>
									<font style='padding:6px;background-color:#4ca6ff;border:1px solid #4ca6ff'>Bayar</font><font style='padding:6px;background-color:#FFF;border:1px solid #4ca6ff'>&nbsp;" . number_format($ttl_pay, 0, ".", ",") . "</font>
									<font style='padding:6px;background-color:#ff9326;border:1px solid #ff9326'>Sisa</font><font style='padding:6px;background-color:#FFF;border:1px solid #ff9326'>&nbsp;" . number_format($ttl_sisa_pay, 0, ".", ",") . "</font>
								</td>
							</tr>";
                                    echo "</tbody>";
                                    echo "
							</table>
							</div>
							</td></tr>";
                                    echo "<script>focus_awl();</script>";
                                    ?>
                        <script>
                        //SEARCH SCRIPT
                        $("#jquery_search_sample").jsearch({
                            minLength: 2
                        });
                        </script>
                        <?PHP
                                    break;

                                case "detil":
                                    $mou_app = $_GET['no_app'];
                                    $no = $_GET['no'];
                                    $no_cont = $_GET['cont'];
                                    $qry = "SELECT * FROM kontrak_project WHERE mou_kontrak='$mou_app' AND no_kontrak='$no_cont' AND no_pol='CNP'";
                                    $rst = mysql_query($qry) or die('sql dt kontrak salah: ' . mysql_error());
                                    $row = mysql_fetch_array($rst);
                                    $jml = mysql_num_rows($rst);
                                ?>
                        <script language="JavaScript" type="text/JavaScript">
                            function focus_awl() {
                                hit_selisih_hr();
						document.forms[0].no_kontrak.focus();
						setTimeout("focus_awl()", 300000);//5 mnt
					}
				</script>
                        <script>
                        function confirm_approve_ap(no, mou, kntrk) {
                            swal({
                                    title: "<span style=\"font-size:26px; color:#128BFC;\">Approve Application Project?</span>",
                                    text: "<span style=\"font-size:24px; color:#46D90D; text-align:center;\"><b>" +
                                        mou + " ?</span>",
                                    type: "warning",
                                    html: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#07AF2E',
                                    closeOnConfirm: false,
                                    showLoaderOnConfirm: true,
                                    //animation: "slide-from-top"
                                    //inputPlaceholder: "*****"
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.href = "app_project?c=approve_ap&no=" + no +
                                            "&app_pro=" +
                                            mou + "&no_cont=" + kntrk;
                                    } else {
                                        return false
                                    }
                                });
                            return false;
                        }
                        </script>

                        <?php
                                    $tgl_in = explode("-", $row['tgl_reg']);
                                    $tglreg = $tgl_in[2] . "/" . $tgl_in[1] . "/" . $tgl_in[0];
                                    if ($row['tgl_mulai'] != '0000-00-00') {
                                        $tgl_s = explode("-", $row['tgl_mulai']);
                                        $tgl_start = $tgl_s[2] . "/" . $tgl_s[1] . "/" . $tgl_s[0];
                                    } else {
                                        $tgl_start = '0000/00/00';
                                    }
                                    if ($row['tgl_selesai'] != '0000-00-00') {
                                        $tgl_e = explode("-", $row['tgl_selesai']);
                                        $tgl_end = $tgl_e[2] . "/" . $tgl_e[1] . "/" . $tgl_e[0];
                                    } else {
                                        $tgl_end = '0000/00/00';
                                    }

                                    //SISA HARI KONTRAK
                                    $now = time();
                                    $tglend = strtotime($row['tgl_selesai']);
                                    $sisa_hr = ceil(($tglend - $now) / (60 * 60 * 24));
                                    //nilai kontrak
                                    $nilai = number_format($row['nilai_kontrak'], 0, ".", ",");
                                    //SQL ID SITE-PROYEK
                                    $sql2a = mysql_query("SELECT * FROM site_proyek WHERE no='$row[id_site_br]'");
                                    $row2a = mysql_fetch_array($sql2a);
                                    $sql2b = mysql_query("SELECT * FROM site_proyek");

                                    $file = explode("/", $row['file_spk']);
                                    $file_spk = $file[1];
                                    $size_file = round(filesize($file[0] . '/' . $file[1]) / 1000) . " Kb"; //in KB	

                                    echo "
					<tr>
						<td height='25' align='left'>
							<div class='container'>DETIL DATA APPLICATION PROJECT CNP
							<div style='text-align:right; float:right;margin:auto;margin-right:-2px;'>
								<input type='button' class='btn5' style='font-size:12px;padding:3px;width:auto' value='Data Kontrak Unit' title='Data Kontrak Unit' OnClick=\"window.location='app_project?c=contract'\">	
							</div>
							</div>
						</td>
					</tr>
					<tr>
							<td width:'800px;' align='center' style=\"background-image: url('bg4.jpg');background-repeat:repeat;\">
								<FORM name='input_contrct'>
									<div class='pageborder' style='width:800px;'>
										<table border='0' width='100%' cellspacing='1' cellpadding='2' style=\"background-color:#EEE;\">
													<tr>
														<td align='center' width='30%' colspan='2' style='margin-bottom:10px;' background='topgradient.jpg'><h2>Detil Data Aplikasi Project ($row[mou_kontrak])</h2></td>
													</tr>
													<tr><td colspan='2'></td></tr>
													<tr>
														<th align='left'>Tanggal Input</th>
														<td width='70%'><input type='text' value='$tglreg' name='tgl_input' size='8' style='text-align:center;cursor:pointer;' class='satu' readonly placeholder='TANGGAL' id='tgl_skrg'></td>
													</tr>
													<tr>
														<th align='left'>No. Kontrak Proyek <i>(Int)</i></th>
														<td width='70%'><input type='text' name='id_kontrak' class='satu' readonly value='$row[no_kontrak]' style='width:100%;text-align:center;cursor:not-allowed;' readonly></td>
													</tr>
													<tr>
														<th align='left'>No. Aplication Project</th>
														<td width='70%'>
															<input type='text' value='$row[mou_kontrak]' name='mou_kontrak' class='satu' readonly maxlength='50' style='width:100%;text-align:center;font-weight:bold;' placeholder='max.50 CHARS' onkeyup=\"this.value = this.value.toUpperCase()\">
														</td>
													</tr>
													<tr>
														<th align='left'>Nama (Penyewa)</th>
														<td><input type='text' name='rent_nama' value='$row[rent_nama]' class='satu' readonly maxlength='60' style='width:100%;text-align:left;'></td>
													</tr>
													<tr>
														<th align='left'>Jabatan (Penyewa)</th>
														<td><input type='text' name='rent_jabatan' value='$row[rent_jabatan]' class='satu' readonly maxlength='40' style='width:100%;text-align:left;'></td>
													</tr>
													<tr>
														<th align='left'>Perusahaan (Penyewa)</th>
														<td><input type='text' name='rent_company' value='$row[rent_company]' class='satu' readonly maxlength='60' style='width:100%;text-align:left;'></td>
													</tr>
													<tr>
														<th align='left'>Alamat (Penyewa)</th>
														<td><input type='text' name='rent_almt' value='$row[rent_almt]' class='satu' readonly maxlength='100' style='width:100%;text-align:left;'></td>
													</tr>
													<tr>
														<th align='left'>Mengetahui (Nama / Jabatan)</th>
														<td>
														<input type='text' value='$row[nama_known]' class='satu' readonly style='width:48%;text-align:left;'>
														&nbsp;  
														<input type='text' value='$row[jbtn_known]' class='satu' readonly style='width:49%;text-align:left;'>
														</td>
													</tr>
													<tr>
														<th align='left'>File SPK</th>
														<td><img style='vertical-align:middle' src='pdficon.jpg' width='20' height='20'>&nbsp <a href='$row[file_spk]' target='_blank' title='lihat file SPK'>$file_spk (<i>$size_file</i>)</a></td>
													</tr>
													<tr>
														<th align='left'>User (Site & Proyek)</th>
														<td>
														
														<input type='text' name='almt' value='$row[id_site_br] $row[site_br] ~ $row[proyek_br]' class='satu' disabled placeholder='Alamat' style='width:552px;'>

									                    </td>
													</tr>
													<tr>
														<th align='left'>Alamat</th>
														<td><input type='text' name='almt' value='$row2a[alamat_site]' class='satu' disabled placeholder='Alamat' style='width:552px;'></td>
													</tr>

													<tr><td colspan='3'><hr></td></tr>";
                                    echo "<tr><td colspan='3'><table id='tbl_unit' width='100%' border='0' cellspacing='0' cellpadding='1'>";
                                    $no_un = 0;
                                    //DATA UNIT IN APP PROJECT
                                    $qry2 = "SELECT * FROM kontrak_project WHERE no_kontrak='$no_cont' and no_pol='CNP'";
                                    $rst2 = mysql_query($qry2) or die('sql dt unit salah: ' . mysql_error());
                                    while ($row2 = mysql_fetch_array($rst2)) {
                                        $no_un++;
                                        echo "<tr>
																<th align='left' width='32%'>Unit/Alat</th>	
																<td width='3%'><input type='text' value='$no_un' name='jml_unit[]' id='no_urut$no_un' readonly class='satu' style='padding:5px;text-align:center;width:30px;'></td>
																<td width='65%'>
																	<input type='hidden' name='no_edit[]' value='$row2[no]'>
																	<input type='text' value='$row2[no_unit] ~ $row2[id_unit] ($row2[nama_alat])' id='unit$no_un' name='id_unit[]' style='width:100%;' title='Unit' class='satu' readonly ></td>
																</td>
															</tr>
															<tr>
															    <th align='left'>Bobot</th>
															    <td>&nbsp</td><td colspan='2'><input type='text'name='bobot[]'id='bobot$no_un'maxlength='15'value='" . number_format($row2['bobot'], 0, ".", ",") . "'
															    style='width:150px;text-align:right;padding:6px;'class='satu'>&nbsp;M3</td>															
															</tr>

                                                            <tr>
                                                            <th align='left'>Tarif Bobot</th>
                                                            <td>&nbsp</td><td colspan='2'><input type='text'name='tarif_bobot[]'id='idtarif_bobot$no_un'maxlength='15'value='" . number_format($row2['tarif_bobot'], 0, ".", ",") . "'
                                                            style='width:150px;text-align:right;padding:6px;'class='satu'>&nbsp;M3</td>															
                                                        </tr>

															<tr>
															    <th align='left'>Biaya</th>
															    <td>&nbsp</td><td colspan='2'><input type='text'name='biaya_bobot[]'id='biaya_bobot1'maxlength='15'value='" . number_format($row2['biaya_bobot'], 0, ".", ",") . "'
															    style='width:150px;text-align:right;padding:6px;'class='satu' readonly></td>															
															</tr>															
															<tr>
																<th align='left'>Keterangan</th>
																<td>&nbsp</td>
																<td><input type='text' value='" . $row2['keterangan'] . "' name='keterangan[]' class='satu' readonly maxlength='100' placeholder='KETERANGAN UNIT 1' style='width:100%;text-transform:none;'></td>
															</tr>
														";
                                    }
                                    echo "</table></td></tr>";

                                    echo "<tr><td colspan='3'><hr></td></tr>
													<tr>
														<th align='left'>TOTAL NILAI KONTRAK (<i>Rp</i>)</th>
														<td>
															<input type='text' name='nilai_kontrak' value='" . number_format($row['nilaikontrak'], 0, ".", ",") . "' style='width:210px;font-weight:bold;' dir='rtl' class='satu' readonly=\"readonly\">
														</td>
													</tr>
													<tr><td colspan='3'><hr></td></tr>";
                                    echo "
													<tr>
														<th align='left'>Tgl Mulai - Tgl Selesai</th>
														<td>
															<input type='text' value='$tgl_start' name='tgl_mli' size='8' style='text-align:center;cursor:none;' class='satu' readonly>
															-
															<input type='text' value='$tgl_end' name='tgl_sli' size='8' style='text-align:center;cursor:none;'  class='satu' readonly>	
															&nbsp &nbsp &nbsp  
															<b>Sisa Waktu</b> <small><i>dari hari ini</i></small> &nbsp<input type='text' name='sisa_wkt' disabled value='$sisa_hr' readonly class='satu' size='8' style='text-align:center;'> Hr
														</td>
													</tr>
													<tr>
														<th align='left'>Jangka Waktu</th>
														<td><input type='text' value='$row[jangka_wkt]' name='jangka_wkt' id='jk_wkt' class='satu' readonly size='8' style='text-align:center;padding:6px;'> Bln</td>
													</tr>
													<tr>
													<td colspan='2' align='center' background='topgradient.jpg'><a name='bwh'></a>";
                                    if ($row['approve'] == 0) {
                                        echo "<tr><td colspan='2' align='center' background='topgradient.jpg'>
																<input type='button' value='Back' onclick=\"window.location='?c=contract'\">";
                                        //if($_COOKIE['login']='admin' AND $_COOKIE['status']=='ADMIN'){
                                        if ($_COOKIE['status'] == 'ADMIN') {
                                            echo " <input type='button' class='btn5' value='Approve' onclick=\"confirm_approve_ap('$row[no]','$row[mou_kontrak]','$row[no_kontrak]')\">";
                                        }
                                        echo " <a class='empat' style='border:1px solid #000;padding:6px 16px;border-radius:3px;' data-balloon='Preview Kontrak Alat' data-balloon-pos='up' rel=\"modal:open\" href='preview_ap_cnp?no=$row[no]&app_pro=$row[mou_kontrak]&no_cont=$row[no_kontrak]'>Preview</a>
															</td></tr>";
                                    } else {
                                        echo "<tr><td colspan='2' align='center' background='topgradient.jpg'>
																<input type='button' value='Back' onclick=\"window.location='?c=contract'\">
																<input type='button' class='btn6' value='Cetak' onclick=\"window.open('print_ap_cnp?app_pro=$row[mou_kontrak]&no_cont=$row[no_kontrak]')\">
															</td></tr>";
                                    }
                                    echo "</td>
													</tr>
												</table></div>
										</FORM>
									</td></tr>";
                                    echo "<script>focus_awl();</script>";
                                    break;

                                case "approve_ap":
                                    $no = $_GET['no'];
                                    $app_pro = $_GET['app_pro'];
                                    $no_cont = $_GET['no_cont'];
                                    $sql = "UPDATE kontrak_project SET approve='1' WHERE no_kontrak='$no_cont' AND mou_kontrak = '$app_pro'";
                                    $rst = mysql_query($sql) or die('sql approve salah: ' . mysql_error());
                                    //echo"berhasil";
                                    if ($rst) {
                                    ?>
                        <script>
                        swal({
                            title: "SUKSES",
                            html: true,
                            //animation: "slide-from-top",
                            text: "<?php echo "<font style='font-weight:bold;'>Kontrak Alat-Unit: <u>$app_pro</u></font>"; ?><BR> Telah Di Approve.",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: true
                        });
                        </script>
                        <?php
                                        echo "<script>setTimeout(\"window.location.href='?c=detil&no_app=$app_pro&no=$no&cont=$no_cont'\",2500);</script>";
                                    }
                                    break;

                                case "delete":
                                    $id_unit = $_GET['id'];
                                    $no = $_GET['nodel'];
                                    $no_unit = $_GET['no'];
                                    $contr = $_GET['contr'];
                                    $mou = $_GET['mou'];
                                    //include_once("dbconnection.php");
                                    $sql = "DELETE FROM kontrak_project WHERE no = '$no' AND no_kontrak = '$contr' LIMIT 1";
                                    $rst = mysql_query($sql) or die('sql hapus salah: ' . mysql_error());
                                    $sql1 = "DELETE FROM kontrak_pay WHERE no_kontrak = '$contr'";
                                    $rst1 = mysql_query($sql1) or die('sql1 hapus salah: ' . mysql_error());
                                    //echo"berhasil";
                                    if ($rst1) {
                                    ?>
                        <script>
                        swal({
                            title: "SUKSES",
                            html: true,
                            animation: "slide-from-top",
                            text: "<?php echo "<font style='font-weight:bold;'>[$mou]<BR>$id_unit ~ $no_unit</font>"; ?><BR>TELAH DIHAPUS.",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: true
                        });
                        </script>
                        <?php
                                        echo "<script>setTimeout(\"window.location.href='$_SERVER[PHP_SELF]?c=contract'\",2300);</script>";
                                    }
                                    break;

                                case "close_project":
                                    $contr = $_GET['app_pro'];
                                    $mou = trim(addslashes($_GET['mou']));
                                    //DATA KONTRAK
                                    $sql = "UPDATE kontrak_project SET kontrak_done='1' WHERE no_kontrak = '$contr' AND mou_kontrak = '$mou'";
                                    $rst = mysql_query($sql) or die('sql salah: ' . mysql_error());
                                    $sql1 = "SELECT no_kontrak,mou_kontrak,no_unit FROM kontrak_project WHERE no_kontrak='$contr' AND mou_kontrak='$mou'";
                                    $rst1 = mysql_query($sql1) or die('sql1 salah: ' . mysql_error());
                                    $wkt_skrg = date('Y-m-d H:i:s');
                                    //DT POOL PUSAT
                                    $sql2 = "SELECT * FROM site_proyek WHERE nama_proyek LIKE '%POOL PUSAT%'";
                                    $rst2 = mysql_query($sql2) or die('sql2 salah: ' . mysql_error());
                                    $row2 = mysql_fetch_array($rst2);
                                    $nopol_unit = "";
                                    while ($row1 = mysql_fetch_array($rst1)) {
                                        //DATA MUTASI
                                        $qry2 = mysql_query("UPDATE mutasi_alat SET 
						done='1', 
						tgl_demobilisasi='$wkt_skrg',
						keterangan='CLOSE PROJECT (By ADMIN)',
						kelengkapan2=kelengkapan,
						keterangan2='CLOSE PROJECT (By ADMIN)' WHERE no_kontrak='$contr' AND mou_kontrak='$mou'") or die('qry2 salah: ' . mysql_error());
                                        //UNIT kembali ke POOL PUSAT
                                        $qry3 = mysql_query("UPDATE ekspedisi SET 
						id_site='$row2[no]', 
						nama_site='$row2[nama_site]',
						nama_proyek='$row2[nama_proyek]',
						alamat='$row2[alamat_site]',
						kota='$row2[kota_site]',
						provinsi='$row2[prov_site]' WHERE nopol='$row1[no_unit]'") or die('qry3 salah: ' . mysql_error());
                                        $nopol_unit .= "$row1[no_unit]<BR>";
                                    }
                                    ?>
                        <script>
                        swal({
                            title: "<p style=\"font-size:26px; color:#83C750; text-align:center;\">Aplikasi Project:<BR><font color='green'><?php echo "[$contr] $mou"; ?></font><BR>telah DICLOSE.</p>",
                            text: "<p style=\"font-size:24px; color:#0036FF; text-align:center;\"><b><?php echo "$nopol_unit"; ?></b>Dikembalikan ke POOL PUSAT. <BR><u><b><?php echo "$row2[nama_site] ~ $row2[nama_proyek]"; ?></b></u>.<BR>Silahkan isi LBP nya.</p>",
                            html: true,
                            type: "success",
                            timer: 4500,
                            showConfirmButton: false,
                            closeOnConfirm: false
                        });
                        </script>
                        <?php
                                    echo "<script>setTimeout(\"window.location.href='lap_proyek'\",4800);</script>";
                                    break;
                            } //end switch c	
                            ?>

                        <!-- END ISI-->
                        <!-- FOOTER-->
                        <?php include "footer.php" ?>
                    </table>
                    <!-- END TABEL BORDER ALL CONTENT-->
                </td>
                <td background='frame_06.png'></td>
            </tr>
            <tr>
                <td width='1'><img src=frame_07.png></td>
                <td width='100%' background='frame_08.png'></td>
                <td><img src='frame_09.png'></td>
            </tr>
        </table>
    </center>
</body>

</html>
<?php
} else {
    echo "<script>window.location='index.php';</script>";
}
?>