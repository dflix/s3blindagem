<?php
require './vendor/autoload.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >

        <title>Dflix Control</title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 

        <!------ Include the above in your HEAD tag ---------->
        <style> 

            body{    background:#f3fafb;

                     font-family: 'Montserrat','sans-serif'; font-size: 0.9em;}
            
                .load {
         width: 100px;
         height: 100px;
         position: absolute;
         top: 30%;
         left: 45%;
         color: blue; z-index:999; background: #000; opacity: 0.8; }

            h1,h2,h3,h4,h4{
                font-size: 2em; padding: 10px; background:#B0E0E6; color:white; border-radius:5px;
            }
            .row{
                margin-left:0px;
                margin-right:0px;
            }

            #wrapper {
                padding-left: 70px;
                transition: all .4s ease 0s;
                height: 100%;
                z-index: 888;
            }

            #sidebar-wrapper {
                margin-left: -200px;
                left: 70px;
                width: 150px;
                background: #222;
                position: fixed;
                height: 100%;
                z-index: 10000;
                transition: all .4s ease 0s;
            }

            .sidebar-nav {
                display: block;
                float: left;
                width: 150px;
                list-style: none;
                margin: 0;
                padding: 0;
            }
            #page-content-wrapper {
                padding-left: 0;
                margin-left: 0;
                width: 90%;
                height: auto;
            }
            #wrapper.active {
                padding-left: 150px;
            }
            #wrapper.active #sidebar-wrapper {
                left: 200px;
            }

            #page-content-wrapper {
                width: 100%;
            }

            #sidebar_menu li a, .sidebar-nav li a {
                color: #999;
                display: block;
                float: left;
                text-decoration: none;
                width: 150px;
                background: #252525;
                border-top: 1px solid #373737;
                border-bottom: 1px solid #1A1A1A;
                -webkit-transition: background .5s;
                -moz-transition: background .5s;
                -o-transition: background .5s;
                -ms-transition: background .5s;
                transition: background .5s;
            }
            .sidebar_name {
                padding-top: 25px;
                color: #fff;
                opacity: .7;
            }

            .sidebar-nav li {
                line-height: 30px;
                text-indent: 50px;

            }

            .sidebar-nav li a {
                color: #999999;
                display: block;
                text-decoration: none;
            }

            .sidebar-nav li a:hover {
                color: #fff;
                background: rgba(255,255,255,0.2);
                text-decoration: none;
            }

            .sidebar-nav li a:active,
            .sidebar-nav li a:focus {
                text-decoration: none;
            }

            .sidebar-nav > .sidebar-brand {
                height: 65px;
                line-height: 60px;
                font-size: 18px;
            }

            .sidebar-nav > .sidebar-brand a {
                color: #999999;
            }

            .sidebar-nav > .sidebar-brand a:hover {
                color: #fff;
                background: none;
            }

            #main_icon
            {
                float:right;
                padding-right: 65px;
                padding-top:20px;
            }
            .sub_icon
            {
                float:right;
                padding-right: 65px;
                padding-top:10px;
            }
            .content-header {
                height: 65px;
                line-height: 65px;
            }

            .content-header h1 {
                margin: 0;
                margin-left: 20px;
                line-height: 65px;
                display: inline-block;
            }

            table {
                border-collapse: collapse;
                border-spacing: 0;
                border: 1px solid #bbb;
            }
            td, th {
                border-top: 1px solid #ddd;
                padding: 4px 8px;
            }
            /* Algumas linhas listradas para ficar legal ;) */
            tbody tr:nth-child(even) td {
                background-color: #eee;
            }

            @media (max-width:767px) {
                #wrapper {
                    padding-left: 70px;
                    transition: all .4s ease 0s;
                }
                #sidebar-wrapper {
                    left: 70px;
                }
                #wrapper.active {
                    padding-left: 150px;
                }
                #wrapper.active #sidebar-wrapper {
                    left: 150px;
                    width: 150px;
                    transition: all .4s ease 0s;
                }

                thead {display: none;}
                tr td:first-child {font-weight:bold;font-size:0.8em;}
                tbody td {display: block;  text-align:center; padding: 5px; width: 100%}
                tbody td:before { 
                    content: attr(data-th); 
                    display: block;
                    text-align:center;  
                }
            }
        </style>
    </head>
    <body>
        
        <!--<div class="load">  <img src="https://www.blogson.com.br/wp-content/uploads/2017/10/loading-gif-transparent-10.gif" /></br> Carregando ... </div>-->

        <div id="wrapper" class="active">  
            <!-- Sidebar -->
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul id="sidebar_menu" class="sidebar-nav">
                    <li class="sidebar-nav"><a id="menu-toggle" href="<?= CONF_URL_APP ?>">Menu<i class="fa fa-bars" title="menu" style="float:right; margin-top: 10px;"></i></a></li>
                </ul>
                <ul class="sidebar-nav" id="sidebar">
                    <li> <a href="<?= CONF_URL_APP ?>/">Dashboard<i class="fas fa-home" title="dashboard" style="float:right; color: #ccc; font-size: 1.2em; margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/entrada">Entradas<i class="fa fa-plus-square" title="entradas" style="float:right; color: green; font-size: 1.2em; margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/saida">Saida<i class="fa fa-minus-square" title="saidas" style="float:right; color: red; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/carteira">Carteiras<i class="fa fa-briefcase" title="carteiras" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
<!--                    <li> <a href="">Fixas<i class="fa fa-flag-checkered" title="contas fixas" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> -->
                    <li> <a href="<?= CONF_URL_APP ?>/agenda" title="agenda">Agenda<i class="fa fa-table" title="agenda de eventos" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/perfil">Perfil<i class="fa fa-user-circle" title="perfil de usuario" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 

                    <?php
                    if ($_SESSION["nivel"] >= 2) {
                        ?>

             <!--<li> <a href="">Caixa<i class="fa fa-comment" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 
                        <li> <a href="<?= CONF_URL_APP ?>/orcamento">Orçamentos<i class="fa fa-comment" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <li> <a href="<?= CONF_URL_APP ?>/cliente">Pedidos<i class="fa fa-heartbeat" title="clientes" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <li> <a href="<?= CONF_URL_APP ?>/contrato">Contratos<i class="fa fa-folder" title="contratos" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <li> <a href="">Financeiro<i class="fa fa-cubes" title="cobranças" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <!--<li> <a href="">Caix<i class="fa fa-cubes" title="cobranc" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 


                        <!--<li> <a href="">Config<i class="fa fa-asterisk" title="config" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 
                        <!--<li> <a href="">Ponto<i class="fa fa-asterisk" title="ponto" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 

                    <?php } ?>

                    <?php
                    if ($_SESSION["nivel"] >= 2) {
                        ?>

                        <li> <a href="<?= CONF_URL_APP ?>/caixa">Caixa<i class="fas fa-cash-register" title="registro" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 

<!--                        <li> <a href="">Estoque<i class="fa fa-barcode" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> -->
                        <li> <a href="<?= CONF_URL_APP ?>/produtos"">Produtos<i class="fa fa-barcode" title="produtos" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <li> <a href="<?= CONF_URL_APP ?>/post">Posts<i class="fas fa-file-import" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 

                    <?php } ?>
<!--                    <li> <a href="">Suporte<i class="fa fa-life-ring" title="suporte" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> -->

<!--                    <li> <a href="<?= CONF_URL_APP ?>/assinatura">Assinatura<i class="fa fa-star" title="minha assinatura" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/afiliados">Afiliados<i class="fa fa-magnet" title="afiliados" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> -->
                    <li> <a href="<?= CONF_URL_APP ?>/sair">Sair<i class="fa fa-times-circle" title="sair" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 


                </ul>
            </div>

            <div id="page-content-wrapper">
                <!-- Keep all page content within the page-content inset div! -->
                <div class="page-content ">
                    <div class="row">
                        <div class="col-md-12 bg bg-dark text-left">
                            <p class="text-left" style="padding: 5px; color:#fff; font-size: 1.5em; float: left;"><span style="color:orange;">Dflix</span>Control</p>
                            <p class="text-right" style="padding: 5px; margin-top:1px; color:#fff; font-size: 1.2em; float: right;"> Seja Bem Vindo   <b style="color: orange;"><?= $_SESSION["nome"]; ?></b> </br> <b>Plano <?php $plano = new \Source\Core\Matriculas(); ?> </b> <img src="<?= CONF_URL_BASE ?>/uploads/images/2020/05/dflixwhats.png" class="float-right rounded-circle" style="width: 30px; "> </p>






                        </div>
                        <div class="col-md-12">
                            <?php
                            if (!empty($_SESSION['retorno'])) {
                                echo $_SESSION['retorno'];
                                unset($_SESSION['retorno']);
                            } else {
                                unset($_SESSION['retorno']);
                                null;
                            }
                            ?>
                        </div>

                        <?= $v->section("content"); ?>

                    </div>
                </div>
            </div>

        </div>

        <script>

            $(document).ready(function () {
                $('#summernote').summernote();
            });

            $(function () {



                $("#menu-toggle").click(function (e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("active");
                });


            });

        </script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->

        <!-- include summernote css/js -->
        <!--        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>-->

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

        <script src="<?= LINK_ASSETS_APP ?>/js/Chart.min.js" ></script>

<!--        <script src="<?= LINK_ASSETS_APP ?>/js/jquery.js"></script>
        <script src="<?= LINK_ASSETS_APP ?>/js/jquery.min.js" type="text/javascript"></script>-->
        <script src="<?= LINK_ASSETS_APP ?>/js/jquery.maskMoney.js" type="text/javascript"></script>




    </body>

</html>

