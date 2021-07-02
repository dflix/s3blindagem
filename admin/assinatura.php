<?php $v->layout("_theme"); ?>




<div class="container py-5">

  <!-- For demo purpose -->
  <div class="row mb-4">
    <div class="col-lg-8 mx-auto text-center">
        <h1 class="display-4">Assinatura <span style="color:orange">Dflix</span>Control</h1>
      
      <?php 
      
      $verifica = new Source\Models\Read();
      $verifica->ExeRead("app_matriculas", "WHERE user_id = :id AND status = :s", "id={$_SESSION["user_id"]}&s=active");
      $verifica->getResult();
      
      //$matricula = new \Source\Core\Matriculas();
      
      //var_dump($verifica);
      
      if($verifica->getResult()){
          //echo "<h5>Assine e tenha acesso a todos recursos</h5>";
         
          
     
          ?>
        <div class="text-center">
        <table class="table table-responsive text-center"> 
      
          <thead> 
              <tr> 
                  <th> Matricula </th>
                  <th>Plano </th>
                  
                  <th>Vencimento </th>
                  <th>Status </th>
                  
              
              </tr>
          </thead>
          
          <tbody> 
              <tr> 
                  <td><?= $verifica->getResult()[0]["transacao"] ?> </td>
                  <td><?php 
                  $nome = new Source\Models\Read();
                  $nome->ExeRead("app_planos", "WHERE id = :id", "id={$verifica->getResult()[0]["plano_id"]}");
                  echo $nome->getResult()[0]["name"];
                          ?> </td>
                 
                  
                  <td><?= date("d/m/Y" , strtotime($verifica->getResult()[0]["proximo_vencimento"]))  ?> </td>
                  <td style="background: green;"> ATIVO</td>
              </tr>
          </tbody>
      
        </table></div>
         
        <h1 class="display-4"> <i class="far fa-grin-alt" style="font-size:2.0em; color:green;"></i></h1> 
        <h1 class="display-4"> <span style="color:green">Aproveite sua assinatura</span></h1> 
        
      
              <?php return;
      }else{
      ?>
     
        <section class="col-md-12">
  <div class="container py-5 backwhite">

    <div class="row text-center align-items-end">
      <!-- Pricing Table-->
      <div class="col-lg-3 mb-5 mb-lg-0">
        <div class="bg-white p-5 rounded-lg shadow">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">PRO</h1>
          <h2 class="h1 font-weight-bold">$9.90<span class="text-small font-weight-normal ml-2">/ mês</span></h2>

          <div class="custom-separator my-4 mx-auto bg-primary"></div>

          <ul class="list-unstyled my-5 text-small text-left">
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Entrada e Saida de Faturas</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Agenda Eletrônica</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Multiplas Carteiras</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Ganhe Dinheiro com plano de afiliados</li>
            <li class="mb-3 text-muted">
              <i class="fa fa-times mr-2"></i>
              <del>Cadastro de Clientes</del>
            </li>
            <li class="mb-3 text-muted">
              <i class="fa fa-times mr-2"></i>
              <del>Envio de Orçamento via E-mail ou Whatsapp</del>
            </li>
            <li class="mb-3 text-muted">
              <i class="fa fa-times mr-2"></i>
              <del>Geração de contratos e ordem de serviços</del>
            </li>
            <li class="mb-3 text-muted">
              <i class="fa fa-times mr-2"></i>
              <del>Cobranças via boleto</del>
            </li>
          </ul>
          <a href="#pagamento" class="btn btn-primary btn-block p-2 shadow rounded-pill">Assine Abaixo</a>
        </div>
      </div>
      <!-- END -->


      <!-- Pricing Table-->
      <div class="col-lg-3 mb-5 mb-lg-0">
        <div class="bg-white p-5 rounded-lg shadow">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">EXPERT</h1>
          <h2 class="h1 font-weight-bold">$29.90<span class="text-small font-weight-normal ml-2">/ mês</span></h2>

          <div class="custom-separator my-4 mx-auto bg-primary"></div>

          <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
                       <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Entrada e Saida de Faturas</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Agenda Eletrônica</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Multiplas Carteiras</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Cadastro de Clientes</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i>Envio de Orçamento via E-mail ou Whatsapp</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i>Geração de contratos e ordem de serviços</li>
             <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Ganhe Dinheiro com plano de afiliados</li>

            <li class="mb-3 text-muted">
              <i class="fa fa-times mr-2"></i>
              <del>Cobranças via boleto</del>
            </li>
          </ul>
          <a href="#pagamento" class="btn btn-primary btn-block p-2 shadow rounded-pill">Assine Abaixo</a>
        </div>
      </div>
      <!-- END -->


      <!-- Pricing Table-->
      <div class="col-lg-3">
        <div class="bg-white p-5 rounded-lg shadow">
          <h1 class="h6 text-uppercase font-weight-bold mb-4">MASTER</h1>
          <h2 class="h1 font-weight-bold">$49.90<span class="text-small font-weight-normal ml-2">/ mês</span></h2>

          <div class="custom-separator my-4 mx-auto bg-primary"></div>

          <ul class="list-unstyled my-5 text-small text-left font-weight-normal">
           
              <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Entrada e Saida de Faturas</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Agenda Eletrônica</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Multiplas Carteiras</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Cadastro de Clientes</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i>Envio de Orçamento via E-mail ou Whatsapp</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i>Geração de contratos e ordem de serviços</li>
            <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i>Cobranças via boleto</li>
             <li class="mb-3">
              <i class="fa fa-check mr-2 text-primary"></i> Ganhe Dinheiro com plano de afiliados</li>

              
          </ul>
          <a href="#pagamento" class="btn btn-primary btn-block p-2 shadow rounded-pill">Assine Abaixo</a>
        </div>
      </div>
      <!-- END -->

    </div>
  </div>
</section>
        
        
        
        
        
      <?php } ?>
    </div>
      

      
      
      
  </div>
  <!-- End -->


  <div class="row">
    <div class="col-lg-7 mx-auto">
      <div id="pagamento" class="bg-white rounded-lg shadow-sm p-5">
        <!-- Credit card form tabs -->
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                                <i class="fa fa-credit-card"></i>
                                Cartão de Crédito
                            </a>
          </li>
<!--          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                                <i class="fa fa-paypal"></i>
                                Paypal
                            </a>
          </li>-->
<!--          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
                                <i class="fa fa-university"></i>
                                 Boleto Bancário
                             </a>
          </li>-->
        </ul>
        <!-- End -->
        
        <div class="tab-content"> 
            <h5> Planos </h5>
            <?php 
            $planos = new \Source\Models\Read();
            $planos->ExeRead("app_planos", "WHERE status = :s", "s=active");
            $planos->getResult();
            $i=0;
            foreach ($planos->getResult() as $value):
                $i++;
            ?>
            <form role="form" action="" method="post">
            <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="plano" id="inlineRadio<?= $i ?>" value="<?= $value["id"] ?>|<?= $value["preco"] ?>">
  <label style="font-size: 1.2em;" class="form-check-label"  for="inlineRadio<?= $i ?>">Plano <?= $value["name"] ?> R$<?= number_format($value["preco"] / 100 , 2 , "," , "."); ?> (mês)</label>
</div>
            <?php endforeach; ?>


        </div>


        <!-- Credit card form content -->
        <div class="tab-content">

          <!-- credit card info-->
          <div id="nav-tab-card" class="tab-pane fade show active">
<!--            <p class="alert alert-success">Some text success or error</p>-->
              <?php 
              $transacao = new \Source\Core\Transacao();
              $transacao->cartao_credito();
              ?>
            
              <div class="form-group">
                <label for="username">Nome (igual cartão de crédito)</label>
                <input type="text" name="username" placeholder="Nome igual do cartão" required class="form-control">
              </div>
              <div class="form-group">
                <label for="cardNumber">Numero Cartão</label>
                <div class="input-group">
                  <input type="text" name="cardNumber" placeholder="Numero do cartão" class="form-control" required>
                  <div class="input-group-append">
                    <span class="input-group-text text-muted">
                                                <i class="fa fa-cc-visa mx-1"></i>
                                                <i class="fa fa-cc-amex mx-1"></i>
                                                <i class="fa fa-cc-mastercard mx-1"></i>
                                            </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label><span class="hidden-xs" name="">Data Expiração</span></label>
                    <div class="input-group">
                      <input type="number" placeholder="MM" name="expiration_month" class="form-control" required>
                      <input type="number" placeholder="YY" name="expiration_year" class="form-control" required>
                      <input type="hidden"  name="payment_method" value="credit_card">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group mb-4">
                    <label data-toggle="tooltip" title="3  digitos atrás do seu cartão">CVV
                                                <i class="fa fa-question-circle"></i>
                                            </label>
                      <input type="text" name="cvv" required class="form-control">
                  </div>
                </div>



              </div>
                <input type="submit" name="transacao" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" value="Confirmar" />
              <!--<button type="button" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Confirm  </button>-->
            </form>
          </div>
          <!-- End -->

          <!-- Paypal info -->
          <div id="nav-tab-paypal" class="tab-pane fade">
            <p>Paypal is easiest way to pay online</p>
            <p>
              <button type="button" class="btn btn-primary rounded-pill"><i class="fa fa-paypal mr-2"></i> Log into my Paypal</button>
            </p>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
          <!-- End -->

          <!-- bank transfer info -->
          <div id="nav-tab-bank" class="tab-pane fade">
            <h6>Boleto Bancário</h6>
            <dl>
              <dt>Boletos</dt>
              <dd> Gerar boleto em meu e-mail</dd>
            </dl>
            <dl>
              <dt>
                  <form action="" method="post" name="boleto"> 
                  
                      <input type="submit" name="boleto" value="GERAR BOLETO" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" />
                  </form>
                  </dd>
            </dl>
            <dl>
              <dt>IBAN</dt>
              <dd>CZ7775877975656</dd>
            </dl>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
          </div>
          <!-- End -->
        </div>
        <!-- End -->

      </div>
    </div>
  </div>
</div>