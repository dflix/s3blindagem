<?php
session_start();
require '../vendor/autoload.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >-->

     <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/_cdn/node_modules/bootstrap/dist/css/bootstrap.min.css" >

    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/_cdn/css/bootstrap-custom.css" />
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/_cdn/css/admin.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
        <title>Auto Center Dflix Control</title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> 

        <!------ Include the above in your HEAD tag ---------->
       
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
                    <li> <a href="<?= CONF_URL_APP ?>/?p=usuarios">Usuários<i class="fa fa-user" title="entradas" style="float:right;  font-size: 1.2em; margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/?p=entrada">Entradas<i class="fa fa-plus-square" title="entradas" style="float:right; color: green; font-size: 1.2em; margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/?p=saidas">Saida<i class="fa fa-minus-square" title="saidas" style="float:right; color: red; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/?p=carteira">Lojas<i class="fa fa-briefcase" title="carteiras" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
<!--                    <li> <a href="">Fixas<i class="fa fa-flag-checkered" title="contas fixas" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> -->
                    <li> <a href="<?= CONF_URL_APP ?>/?p=agenda" title="agenda">Agenda<i class="fa fa-table" title="agenda de eventos" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/?p=perfil">Perfil<i class="fa fa-user-circle" title="perfil de usuario" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/?p=estoque">Estoque<i class="fa fa-box" title="estoque" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 

                    <?php
                    if ($_SESSION["nivel"] >= 2) {
                        ?>

             <!--<li> <a href="">Caixa<i class="fa fa-comment" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 
                        <li> <a href="<?= CONF_URL_APP ?>/?p=orcamento">Orçamentos<i class="fa fa-comment" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <li> <a href="<?= CONF_URL_APP ?>/?p=cliente">OS....<i class="fa fa-heartbeat" title="clientes" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <!--<li> <a href="<?= CONF_URL_APP ?>/?p=contrato">Contratos<i class="fa fa-folder" title="contratos" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 
                        <!--<li> <a href="">Financeiro<i class="fa fa-cubes" title="cobranças" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 
                        <!--<li> <a href="">Caix<i class="fa fa-cubes" title="cobranc" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 


                        <!--<li> <a href="">Config<i class="fa fa-asterisk" title="config" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 
                        <!--<li> <a href="">Ponto<i class="fa fa-asterisk" title="ponto" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 

                    <?php } ?>

                    <?php
                    if ($_SESSION["nivel"] >= 2) {
                        ?>

                        <!--<li> <a href="<?= CONF_URL_APP ?>/?p=caixa">Caixa<i class="fas fa-cash-register" title="registro" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li>--> 

<!--                        <li> <a href="">Estoque<i class="fa fa-barcode" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> -->
                        <li> <a href="<?= CONF_URL_APP ?>/?p=produtos"">Produtos<i class="fa fa-barcode" title="produtos" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                        <li> <a href="<?= CONF_URL_APP ?>/?p=post">Posts<i class="fas fa-file-import" title="orçamento" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 

                    <?php } ?>
<!--                    <li> <a href="">Suporte<i class="fa fa-life-ring" title="suporte" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> -->

<!--                    <li> <a href="<?= CONF_URL_APP ?>/assinatura">Assinatura<i class="fa fa-star" title="minha assinatura" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> 
                    <li> <a href="<?= CONF_URL_APP ?>/afiliados">Afiliados<i class="fa fa-magnet" title="afiliados" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: -20px;"></i></a></li> -->
                    <li> <a href="<?= CONF_URL_APP ?>/?p=sair">Sair<i class="fa fa-times-circle" title="sair" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 


                </ul>
            </div>

            <div id="page-content-wrapper">
                <!-- Keep all page content within the page-content inset div! -->
                <div class="page-content ">
                    <div class="row">
                        <div class="col-md-12 bg bg-front text-left">
                            <p class="text-left" style="padding: 5px; color:#fff; font-size: 1.5em; float: left;"><?= CONF_SITE_NAME ?></p>
                            <p class="text-right" style="padding: 5px; margin-top:1px; color:#fff; font-size: 1.2em; float: right;"> Seja Bem Vindo   <b style="color: orange;"><?= $_SESSION["nome"]; ?></b> </br> <b></b> <img src="<?= CONF_URL_BASE ?>/uploads/<?php 
                            
                            $avatar = new \Source\Models\Read();
                            $avatar->ExeRead("usuarios","WHERE id = :a", "a={$_SESSION["user_id"]}");
                           echo $avatar->getResult()[0]["foto"];
                            
                            ?>" class="float-right rounded-circle" style="width: 30px; "> </p>






                        </div>
                        <div class="col-md-12">
                            <?php
                            
                            
                            if(empty($_GET["p"])){
                                include 'inc/home.php';
                            }else{
                                include "inc/{$_GET["p"]}.php";
                            }

                            ?>
                        </div>

                     

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

