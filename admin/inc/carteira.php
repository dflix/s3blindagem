<?php 
if(!empty($_GET["del"])){
    $carteira = new \Source\Core\Carteiras();
    $carteira->deletar();
}

?>


 <script type="text/javascript">
    $(function(){
        $("#valor").maskMoney();
    })
    $(function(){
        $("#valor2").maskMoney();
    })
    </script>

<div class="container"> 
    <!-- Counts Section -->
    <section class="dashboard-counts section-padding">
        <div class="container-fluid">

            <div class="page-header"><h3 class="text-white"> Lojas </h3> </div> 

            <div class="col-md-12"> 
                <?php $cart = new \Source\Core\Carteiras();
                $cart->cadastrar();
                ?>
                <div class="row"> 
                    
                </div>

            </div>

            <div class="row"> 

                <div class="col-md-12"> 


                </div>

                <?php
                $verifica = new Source\Models\Read();
                $verifica->ExeRead("app_carterias","WHERE user_id = :i", "i={$_SESSION["user_id"]}");
                $verifica->getResult();
                
                   foreach ($verifica->getResult() as $item):
                      // var_dump($_SESSION);
                ?>
                
                <div class="col-md-12"> 
                    <p class="bg bg-info" style="padding: 15px; font-size: 1.5em; color:#fff;">Carteira <?= $item["wallet"]?>  >> 
                        <?php if($_SESSION["nivel"] < 2 ) {
                            null;
                        }else { ?>
                        <a href="./?p=carteira&del=<?= $item["id"]?>"><span class="btn btn-danger"> Deletar </span></a>
                        <?php } ?>
                    </p>
                </div>
                
                <?php endforeach; ?>

                <?php 
                if($_SESSION["nivel"] < 1){
                    echo "<h5>Você precisa ser ter um assinatura válida para criar novas carteiras</h5>";
                }else{
                ?>
                <div class="col-md-12"> 
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  CRIAR NOVA LOJA
</button>
                <?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Criar Nova Loja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="" method="post" class="form"> 
          
              <div class="col-md-12"> 
                  <label>Criar Nova Loja </label>
                  <input type="text" name="wallet" class="form-control" />
                  <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"]; ?>" />
                  <input type="hidden" name="cadastra" value="cadastra" />
              </div>
          
              <div class="col-md-12"> 
                  <input type="submit" value="cadastrar" class="btn btn-primary" />
              </div>
          </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
                </div>

            </div>


        </div>


</div>

</div>

</div>
</div>

