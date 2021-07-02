
<section class="container-fluid blocohome" > 
    


    <section class="container"> 
        <div class="row">
            <div class="col-md-8 boxhome">
                <h3>S3 Blindagem Automotiva </h3>
                <p> Blindagem automotiva para veículos</p>
            </div>

            <div class="col-md-1"> </div>
            <div class="col-md-3 boxhome2 atendimento"> 
                <div class="alert alert-success">ATENDIMENTO </div>
                <p class="text-white">Atendimento via whatsapp</p>
                <p class="text-white"><a href="https://api.whatsapp.com/send?phone=5511947004525" style="text-decoration: none;color:#fff;font-size: 1.5em;"><i class="fab fa-whatsapp-square"></i> clique aqui </a></p>
            </div>
        </div>
    </section>



</section>

<section class="container homeespecialidades" id="empresa"> 

    <div class="row"> 
        
                <div class="col-md-12"> 
        
            <h3>S3 Blindagem </h3>
             <p>Com a violência que ocorre diariamente no nosso país, é preciso buscar uma solução para que todos os seus entes fiquem sempre em segurança. Uma das opções é utilizar um carro blindado, que com os seus revestimentos de fibras de aramida, chapas de aço e vidros de policarbonato, deixará todos protegidos. Saiba o que é blindagem automotiva e descubra como esses materiais trabalham para garantir a sua segurança e a de sua família. </p>
       
            <p>A S3 blindagem possui um histórico rico em blindagem automotiva.</p>
            <p>Com mais de 20 anos no mercado , investimos em tecnologia e aperfeiçoamento de nossos profissionais para ter cada vez mais excelência em seu serviços. </p>
            <p>O processo de blindagem conta com a mais alta tecnologia existente no mercado, tudo para oferecer o mais nivel de segurança para nossos clientes e parceiros.

 </p>
 
        </div>
    
        <div class="col-md-4">
            <p class="text-center iconehome"><i class="fas fa-spray-can"></i> </p>
            <h2 class="text-center text-front">Funilaria </h2>
            <p class="text-center"> Funilaria e Pintura para Blindados</p>
        </div>
    
        <div class="col-md-4">
            <p class="text-center iconehome"><i class="fas fa-hammer"></i> </p>
            <h2 class="text-center text-front">Mecânica</h2>
            <p class="text-center"> Mecância para Blindados e Geral</p>
        </div>
    
        <div class="col-md-4">
            <p class="text-center iconehome"><i class="far fa-thumbs-up"></i> </p>
            <h2 class="text-center text-front">Vidros</h2>
            <p class="text-center"> 10 anos de garantia para vidros</p>
        </div>
        


    
    </div>

</section>

<section class="container homeespecialidades" id="servicos"> 

    <div class="row"> 
        
                <div class="col-md-12"> 
        
            <h3>Serviços</h3>
             <p>A blindagem automotiva é um sistema de proteção para você e para todas as pessoas que estiverem dentro do carro, contra, praticamente, qualquer ataque vindo de fora do veículo. Essa proteção pode ser colocada em todas as partes do automóvel para melhor eficiência.</p>
       
          
 
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fas fa-wrench"></i> </p>
            <h2 class="text-center text-front">Máquinas Quebradas</h2>
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fas fa-compass"></i> </p>
            <h2 class="text-center text-front">Amortecedor de Vidro</h2>
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fab fa-think-peaks"></i> </p>
            <h2 class="text-center text-front">Amortecedor Porta Malas</h2>
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fas fa-tint-slash"></i> </p>
            <h2 class="text-center text-front">Infiltração de Água</h2>
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fas fa-dna"></i> </p>
            <h2 class="text-center text-front">Suspensão</h2>
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fas fa-crop-alt"></i> </p>
            <h2 class="text-center text-front">Molas Reforçadas</h2>
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fas fa-deaf"></i> </p>
            <h2 class="text-center text-front">Barulhos Internos</h2>
        </div>
    
        <div class="col-md-3">
            <p class="text-center iconehome"><i class="fab fa-galactic-republic"></i> </p>
            <h2 class="text-center text-front">Cinta de Rodas</h2>
        </div>
    
      


    
    </div>

</section>



<!--      <div class="imgapp"> <img src="./assets/image/home-app.jpg" class="imgapp" /> </div>-->


<?php
$content = new \Source\Models\Read();
$content->ExeRead("app_post_home", "WHERE id = :a", "a=1");
$content->getResult();

$readBlog = new \Source\Models\Read();
$readBlog->ExeRead("app_post", "ORDER BY id DESC");
$blog = $readBlog->getResult();

$readProd = new \Source\Models\Read();
$readProd->ExeRead("app_prod", "ORDER BY id DESC LIMIT 6");
$produto = $readProd->getResult();


//echo $content->getResult()[0]["content"];
?>


<div class="container-fluid bg-white blog" id="blog"> 


    <div class="row">
        <div class="col-lg-11 mx-auto">
            <h5 class="text-center"> Blog </h5>
            <!-- FIRST EXAMPLE ===================================-->
            <div class="row py-5">
<?php
foreach ($blog as $valBlog) {
    ?>  
                    <div class="col-lg-4">
                        <figure class="rounded p-3 bg-white shadow-sm">
                            <img src="<?= CONF_URL_BASE ?>/uploads/<?= $valBlog["imagem"] ?>" alt="" class="w-100 card-img-top">
                            <figcaption class="p-4 card-img-bottom">
                                <h2 class="h5 font-weight-bold mb-2 font-italic"><?= $valBlog["pagina"] ?></h2>
                                <p class="mb-0 text-small text-muted font-italic"><?= $valBlog["description"] ?></p>
                                <buttom class="btn btn-info"><a href="<?= CONF_URL_BASE ?>/<?= $valBlog["slug"] ?>" style="text-decoration: none; color:#fff;"> Saiba Mais ... </a></buttom>
                            </figcaption>
                        </figure>
                    </div>

<?php } ?>

            </div>
        </div>
    </div>
</div>

<!--<div class="container-fluid bg-light produtos" id="produtos"> 


    <div class="row">
        <div class="col-lg-11 mx-auto">
            <h5 class="text-center"> Produtos </h5>
             FIRST EXAMPLE ===================================
            <div class="row py-5">
<?php
foreach ($produto as $valProd) {

    $read = new \Source\Models\Read();
    $read->ExeRead("app_prod_var", "WHERE produto_id = :a", "a={$valProd["id"]}");
    $imagem = $read->getResult()[0]["imagem"];
    $valor = $read->getResult()[0]["valor"];
    ?>  
                    <div class="col-lg-4">
                        <figure class="rounded p-3 bg-white shadow-sm">
                            <img src="<?= CONF_URL_BASE ?>/uploads/<?= $imagem ?>" alt="" class="w-100 card-img-top">
                            <figcaption class="p-4 card-img-bottom">
                                <h2 class="h5 font-weight-bold mb-2 font-italic"><?= $valProd["produto"] ?></h2>
                                <p class="mb-0 text-small text-muted font-italic"><?= $valProd["descricao"] ?></p>
                                <p class="mb-0 text-small text-muted font-italic">R$ <?= number_format($valor / 100, 2, ",", ".") ?></p>
                                <buttom class="btn btn-info"><a href="<?= CONF_URL_BASE ?>/produtos/<?= $valProd["slug"] ?>" style="text-decoration: none; color:#fff;"> Detalhes ... </a></buttom>
                            </figcaption>
                        </figure>
                    </div>

<?php } ?>

            </div>
        </div>
    </div>


</div>-->

<section class="container-fluid bg-white localizacao" id="localizacao"> 


    <h3>Localização </h3>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.200793331336!2d-46.61143228502363!3d-23.489276084718778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef616e16e3085%3A0x77ba69d6b2883bc3!2sRua%20S%C3%ADlvio%20Rodini%2C%2013%20-%20Parada%20Inglesa%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2002241-000!5e0!3m2!1spt-BR!2sbr!4v1625259628884!5m2!1spt-BR!2sbr" width="100%" height="729" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3654.6153233252267!2d-46.556235285020364!3d-23.653943484636965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce42e008d247ff%3A0x6456abca86b642f7!2sAv.%20Gago%20Coutinho%2C%20544%20-%20Santa%20Maria%2C%20Santo%20Andr%C3%A9%20-%20SP%2C%2009070-000!5e0!3m2!1spt-BR!2sbr!4v1624389324268!5m2!1spt-BR!2sbr" width="100%" height="729" style="border:0;" allowfullscreen="" loading="lazy"></iframe>-->
</section>

<section class="container-fluid bg-light contato" id="contato"> 
    <div class="container contato2"> 
        <div class="row">
            <div class="col-md-8">
        <h3>CONTATO</h3>
        <div class="alert alert-front">ATENDIMENTO </div>
               
                <p class="text-dark"><i class="fas fa-envelope-square"></i> contato@s3blindagem.com.br</p>
                <p class="text-dark">Atendimento via whatsapp</p>
                <p class="text-white"><i class="fab fa-whatsapp-square"></i> <a href="https://api.whatsapp.com/send?phone=5511947627725" style="text-decoration: none; font-size: 3em; color: $color-front;"><i class="fab fa-whatsapp-square"></i> clique aqui </a></p>
        </div>
            <div class="col-md-4 imgcontato">
      
        </div>
            
        </div>
    </div>

</section>



<script>

    $("form['register").on("submit", function (event) {
        event.preventDefault();
        console.log($(this).serialize());
    });

</script>


