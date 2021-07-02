<?php $v->layout("_theme"); ?>

 <script type="text/javascript">
    $(function(){
        $("#valor").maskMoney();
    })
    $(function(){
        $("#valor2").maskMoney();
    })
    </script>
    
<div class="container-fluid"> 
    <h3> Afiliados </h3>


    <div class="row"> 
    
        <div class="col-md-3" style="margin-top: 10px;"> 
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Dashboard</div>
        </div>
    
        <div class="col-md-3"  style="margin-top: 10px;"> 
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Rede de Clientes</div>
        </div>
    
        <div class="col-md-3"  style="margin-top: 10px;"> 
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Marketing </div>
        </div>
    
        <div class="col-md-3"  style="margin-top: 10px;"> 
            <div class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Escola de Negócios</div>
        </div>
        
        <hr>
        
        <div class="col-md-4">
            <h3 class="border-bottom"> <i class="fa fa-link" aria-hidden="true"></i> Link de Afiliado </h3>
            <p> Link de Afiliado</p>
            <p><a target="_blank" href="<?= CONF_URL_BASE ?>/&aff=<?= $_SESSION["user_id"] ?>"> <?= CONF_URL_BASE ?>/&aff=<?= $_SESSION["user_id"] ?> </a></p>
        </div> 
        
        
        <div class="col-md-4">
            <h3 class="border-bottom"> <i class="fas fa-coins"></i> Meus Bônus </h3>
            <?php $afiliados = new Source\Core\Afiliados(); ?>
            <h5 class="border-bottom">Nivel 1 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"> <?= $afiliados->n1(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 2 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n2(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 3 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n3(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 4 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n4(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 5 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n5(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 6 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n6(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 7 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n7(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 8 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n8(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 9 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n9(); ?></b> </h5>
            <h5 class="border-bottom">Nivel 10 <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->n10(); ?></b> </h5>
            <h5 class="border-bottom">Total Bônus <i class="fas fa-coins" style="font-size:1.2em; color:orange;"></i> <b style="color:green;"><?= $afiliados->total(); ?></b> </h5>
        </div> 
        
        <div class="col-md-4">
            <h3 class="border-bottom"><i class="far fa-money-bill-alt"></i> Meus Saques </h3>
            
            <div class="form"> 
                <form method="post" action="" enctype="multipart/form-data"> 
                    <div class="col-md-12"> 
                        <label> Solicitar Saque (limite <?php
                        $saque = new Source\Core\Afiliados();
                        echo $saque->balanco();
                        ?> )</label>
                        <input type="text" name="valor" id="valor" class="form-control" />
                        <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>" class="form-control" />
                        <input type="hidden" name="status" value="0" class="form-control" />
                    </div>
                    <div class="col-md-12"> 
                        <input type="submit" name="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" value="solicitar" />
                    </div>
                
                </form>
                
                <?php 
                    ;
                    echo $saque->saque();
                    
                 
                ?>
            </div>
        </div> 
    
    </div>
    
<!--        
    <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
</div>-->


</div>
