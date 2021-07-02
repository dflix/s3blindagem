
<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Dflix Control</title>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <style> 
            
            body{    background:#d4edda;
    
     font-family: 'Montserrat','sans-serif'; font-size: 0.8em;}
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
                width: 100%;
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
                line-height: 40px;
                text-indent: 20px;
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
            }
        </style>
    </head>
    <body>

        <div id="wrapper" class="active">  
            <!-- Sidebar -->
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul id="sidebar_menu" class="sidebar-nav">
                    <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<i class="fa fa-bars" style="float:right;"></i></a></li>
                </ul>
                <ul class="sidebar-nav" id="sidebar">
                    <li> <a href="">Entradas<i class="fa fa-plus-square" title="entradas" style="float:right; color: green; font-size: 1.2em; margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Saida<i class="fa fa-minus-square" title="saidas" style="float:right; color: red; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Carteiras<i class="fa fa-briefcase" title="carteiras" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Fixas<i class="fa fa-flag-checkered" title="contas fixas" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Agenda<i class="fa fa-table" title="agenda de eventos" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Perfil<i class="fa fa-user-circle" title="perfil de usuario" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Assinatura<i class="fa fa-star" title="minha assinatura" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Suporte<i class="fa fa-life-ring" title="suporte" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Afiliados<i class="fa fa-magnet" title="afiliados" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                    <li> <a href="">Sair<i class="fa fa-times-circle" title="sair" style="float:right; color: #ccc ; font-size: 1.2em;margin-top: 10px;"></i></a></li> 
                   

                </ul>
            </div>
            
                        <div id="page-content-wrapper">
                <!-- Keep all page content within the page-content inset div! -->
                <div class="page-content inset">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="well lead">DflixControl</p>

                        </div>

                        <script> 

             <input type="text" name="dinheiro" id="GRANA" />
             
             <p class="t"> </p>
            
                                </div>
                </div>
            </div>

        </div>

        <script>

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
<!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?= LINK_ASSETS_APP?>/js/Chart.min.js" ></script>-->

    <script src="js/jquery-1.2.6.js"> </script>
   
     <script src="//raw.github.com/plentz/jquery-maskmoney/master/jquery.maskMoney.js" type="text/javascript"></script>

    
    </body>

</html>

