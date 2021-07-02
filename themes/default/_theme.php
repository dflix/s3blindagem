<?PHP 
session_start();
require './vendor/autoload.php';

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
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/_cdn/css/website.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <?php 
    $tag = new \Source\Models\Tags();
    //$tag->includesTag();
    ?>

    </script>
    <script src="<?=CONF_URL_BASE ?>/_cdn/node_modules/jquery/dist/jquery.min.js"></script> 
  </head>
  <body>
      <header>
   
<!--          <div class="container-fluid bg-front topinho"> 
              <div class="container text-white text-right font-topo"> <p> <i class="fab fa-youtube"></i> </p> </div>
          </div>-->

          
<nav class="navbar navbar-expand-lg navbar-dark bg-front static-top" id="home">
  <div class="container">
      <a class="navbar-brand" href="<?=CONF_URL_BASE ?>">
          <img src="<?=CONF_URL_BASE ?>/assets/image/logo_s3_blindagem.png" width="150" />
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
               <li class="nav-item">
          <a class="nav-link" for="#empresa" href="#empresa">Empresa</a>
        </li>
               <li class="nav-item">
          <a class="nav-link" for="#servicos" href="#servicos">Serviços</a>
        </li>
        <?php
        $pagina = new Source\Models\Read();
        $pagina->ExeRead("app_post", "WHERE categoria = :a", "a=pagina");
        $pagina->getResult();
        foreach ($pagina->getResult() as $pg) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/<?= $pg["slug"] ?>"><?= $pg["pagina"] ?></a>
        </li>
        <?php } ?>
 <!--<li class="nav-item dropdown">-->
     <?php 
//     $categoria = new Source\Models\Read();
//     $categoria->ExeRead("app_post_categ", "ORDER BY id DESC" );
//     $categoria->getResult();
//     foreach ($categoria->getResult() as $cat) {

     ?>
        <!--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
          <?php //$cat["categoria"] ?>
<!--        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
            <?php
//            $pcat = new Source\Models\Read();
//            $pcat->ExeRead("app_post", "WHERE categoria = :a", "a={$cat["slug"]}");
//            $pcat->getResult();
//            foreach ($pcat->getResult() as $vpcat) {
            ?>
          <!--<a class="dropdown-item" href="<?=CONF_URL_BASE ?>/<?= $vpcat["slug"] ?>"><?= $vpcat["pagina"] ?></a>-->
            <?php //} ?>
        
<!--        </div>
      </li>-->
      
     <?php // } ?>
      
       <li class="nav-item">
          <a class="nav-link" href="#blog">Blog</a>
        </li>
<!--       <li class="nav-item">
          <a class="nav-link" href="#produtos">Produtos</a>
        </li>-->
       <li class="nav-item">
          <a class="nav-link" href="#localizacao">Localização</a>
        </li>
       <li class="nav-item">
          <a class="nav-link" href="#contato">Contato</a>
        </li>
        <?php 
        if(!empty($_SESSION["carrinho"])){
        ?>
        
        
                        <a class="btn btn-info btn-sm ml-3" href="<?=CONF_URL_BASE ?>/carrinho">
                    <i class="fa fa-shopping-cart"></i> Carrinho
<!--                    <span class="badge badge-light">3</span>-->
                </a>
        <?php } ?>
        <?php 
        if(!empty($_SESSION["user_id"])){
        ?>
               <li class="nav-item">
          <a class="nav-link" href="<?=CONF_URL_BASE ?>/pedidos"> Meus Pedidos</a>
        </li>
        <?php } ?>
  
        <a href="<?=CONF_URL_BASE ?>/entrar"><button type="button" class="btn btn-success ">Entrar</button></a>
        
      </ul>
    </div>
  </div>
</nav>
          

          
      </header>   
      
                                         <div class="fixarrodape">

                <a href="#home"><i class="fas fa-arrow-up fontzap"></i></a>
            </div>
      

    
  <?php 
  $rota = new \Source\Models\Rota();
  ?>
   <!-- aqui entra função include de paginas -->
      

            
      <footer class="footer container-fluid bg-front"> 
          

          
          <div class="container p10"> 
              <div class="row"> 
              
                  <div class="col-md-12"> 
                      <p class="text-center text-white"> Todos os Direitos Reservados - <?= CONF_SITE_NAME ?> - 2021 </p>
                      
                      
                  </div>
              </div>
          
          </div>
      </footer>
    
   


   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>-->
    <script src="<?=CONF_URL_BASE ?>/_cdn/node_modules/bootstrap/dist/js/bootstrap.min.js"> </script>
    <script src="<?=CONF_URL_BASE ?>/_cdn/js/script.js"> </script>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>-->
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/assets/js/jquery.form.js" />
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/assets/js/jquery.min.js" />
    <link rel="stylesheet" href="<?=CONF_URL_BASE ?>/assets/js/scripts.js" />

  </body>
</html>