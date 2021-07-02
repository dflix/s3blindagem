<?php $v->layout("_theme"); ?>

<?php $fixas; ?>

<!-- Page content -->

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
            <div class="row">
                <!-- Count item widget-->
                <div class="col-xl-3 col-md-3 col-6 js_entrada">
                    <div class="wrapper count-title d-flex">
                        <div class="icon"><i class="fa fa-plus-square" style="color:green; font-size: 2.2em;"></i></div>
                        <div class="name"><strong class="text-uppercase " >Entradas</strong></br><span>Este Mes</span>
                            <div class="count-number" style="font-size: 1.5em;"><?= number_format($entradadash, 2 , "," , ".") ; ?></div>
                                                        
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalreceita">
                                Lançar Entradas
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="modalreceita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-flag" aria-hidden="true" style="color:green;"></i> Lançar Receitas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="" id="receita" class="form">
                                                <input type="hidden" name="modo" value="entrada" />
                                                <div class="col-lg-12"> 
                                                    <p><i class="fas fa-pen-fancy" aria-hidden="true"></i>Descrição </p>
                                                    <input type="text" name="descricao" placeholder="Descrição do Lançamento" class="form-control" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="far fa-money-bill-alt " ></i> Valor </p>
                                                      
                                                        <input type="text" name="valor" id="valor" class="form-control" />
                                                        
                                                     
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-table" aria-hidden="true"></i> Data </p>
                                                        <input type="date" id="date" name="vencimento_em"  class="form-control input-datepicker" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-book" ></i> Carteira </p>
                                                        <select name="carteira_id" class="form-control"> 
                                                            <?php 
                                                            foreach ($carteira as $forcarteira):
                                                       
                                                            ?>

                                                            <option value="<?= $forcarteira["id"] ?>"><?= $forcarteira["wallet"] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <label><i class="fas fa-retweet"></i> Categoria </label>
                                                        <select name="categoria_id" class="form-control"> 
                                                            <?php 
                                                            foreach ($renda as $forrenda):
                                                       
                                                            ?>

                                                            <option value="<?= $forrenda["id"] ?>"><?= $forrenda["name"] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                </br>
                                                <h3> Repetições </h3>

                                                <div class="col-md-12">


                                                    <div class="col-lg-12 col-md-12"> 

                                                        <label><i class="fas fa-retweet"></i> Repetição </label>
                                                        </br>




                                                        <script>



                                                            $(function () {

                                                                $(".camposExtras").hide();
                                                                $(".js_fixa").hide();
                                                                $(".js_parcelas").hide();
                                                                $('input[name="tipo"]').change(function () {
                                                                    if ($('input[name="tipo"]:checked').val() === "Fixa") {
                                                                        $('.js_fixa').show();
                                                                    } else {
                                                                        $('.js_fixa').hide();
                                                                    }
                                                                    if ($('input[name="tipo"]:checked').val() === "Parcela") {
                                                                        $('.js_parcelas').show();
                                                                    } else {
                                                                        $('.js_parcelas').hide();
                                                                    }
                                                                });

                                                            });
                                                        </script>



                                                        <input type="radio" name="tipo" value="Unica" class="form" >  Unica

                                                        <input type="radio" name="tipo" value="Fixa" >  Fixa 

                                                        <input type="radio" name="tipo" value="Parcela" > Parcela

                                                        <!--<div class="camposExtras">
                                                            Aqui vem os dados que é para esconder ou aparecer
                                                        </div>-->

                                                    </div>                                       

                                                </div>

                                                <div class="row"> 

                                                    <div class="col-lg-12 js_fixa" id="ocultar"> 
                                                        </br>
                                                        <label class="js_fixa"> Fixas </label>
                                                        <select name="js_fixa" class="form-control"> 
                                                            <option value="0">Selecione periodo  </option>
                                                            <option value="mensal">Mensal </option>
                                                            <option value="anual">Anual </option>

                                                        </select>
                                                    </div>

                                                    <div class="col-lg-12 js_parcelas" id="ocultar"> 
                                                        </br>
                                                        <label class="js_parcelas"> Parcelas </label>
                                                        <select name="js_parcelas" class="form-control"> 
                                                            <?php for ($i = 0; $i < 80; $i++) { ?>
                                                                <option value="<?= $i; ?>"><?= $i; ?> </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>


                                                </div>
                                                </br>
                                                <input type="submit" name="submit" value="LANÇAR RECEITAS" class="btn btn-success" />
                                                       </form>



                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <!--fim modal entradas -->


                            </div>
                        </div>
                    </div>
                    <!-- Count item widget-->
                    <div class="col-xl-3 col-md-3 col-6">
                        <div class="wrapper count-title d-flex">
                            <div class="icon"><i class="fa fa-minus-square" style="color: red;font-size: 2.2em;"></i></div>
                            <div class="name"><strong class="text-uppercase">Saidas</strong></br><span>Este mes</span>
                                <div class="count-number" style="font-size: 1.5em;"><?= number_format($saidadash, 2 , "," , ".") ; ?></div>
                                
                                
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldespesa">
                                Lançar Despesa
                            </button>


                             Modal 
                            <div class="modal fade" id="modaldespesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-flag" aria-hidden="true" style="color:red;"></i> Lançar Despesas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="" id="despesa" class="form">
                                                <input type="hidden" name="modo" value="saida" />
                                                <div class="col-lg-12"> 
                                                    <p><i class="fas fa-pen-fancy" aria-hidden="true"></i>Descrição </p>
                                                    <input type="text" name="descricao" placeholder="Descrição do Lançamento" class="form-control" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="far fa-money-bill-alt " ></i> Valor </p>
                                                        <input type="text" name="valor" id="valor2"  class="form-control">
                                                        
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-table" aria-hidden="true"></i> Data </p>
                                                        <input type="date" id="date" name="vencimento_em"  class="form-control input-datepicker" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-book" ></i> Carteira </p>
                                                        <select name="carteira_id" class="form-control"> 
                                                            <?php 
                                                            foreach ($carteira as $forcarteira):
                                                       
                                                            ?>

                                                            <option value="<?= $forcarteira["id"] ?>"><?= $forcarteira["wallet"] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <label><i class="fas fa-retweet"></i> Categoria </label>
                                                        <select name="categoria_id" class="form-control"> 
                                                            <?php 
                                                            foreach ($despesa as $fordespesa):
                                                       
                                                            ?>

                                                            <option value="<?= $fordespesa["id"] ?>"><?= $fordespesa["name"] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                </br>
                                                <h3> Repetições </h3>

                                                <div class="col-md-12">


                                                    <div class="col-lg-12 col-md-12"> 

                                                        <label><i class="fas fa-retweet"></i> Repetição </label>
                                                        </br>




                                                        <script>



                                                            $(function () {

                                                                $(".camposExtras").hide();
                                                                $(".js_fixa").hide();
                                                                $(".js_parcelas").hide();
                                                                $('input[name="tipo"]').change(function () {
                                                                    if ($('input[name="tipo"]:checked').val() === "Fixa") {
                                                                        $('.js_fixa').show();
                                                                    } else {
                                                                        $('.js_fixa').hide();
                                                                    }
                                                                    if ($('input[name="tipo"]:checked').val() === "Parcela") {
                                                                        $('.js_parcelas').show();
                                                                    } else {
                                                                        $('.js_parcelas').hide();
                                                                    }
                                                                });

                                                            });
                                                        </script>



                                                        <input type="radio" name="tipo" value="Unica" >  Unica

                                                        <input type="radio" name="tipo" value="Fixa" >  Fixa 

                                                        <input type="radio" name="tipo" value="Parcela" > Parcela



                                                    </div>                                       

                                                </div>

                                                <div class="row"> 

                                                    <div class="col-lg-12 js_fixa" id="ocultar"> 
                                                        </br>
                                                        <label class="js_fixa"> Fixas </label>
                                                        <select name="js_fixa" class="form-control"> 
                                                            <option value="mensal">Mensal </option>
                                                            <option value="anual">Anual </option>

                                                        </select>
                                                    </div>

                                                    <div class="col-lg-12 js_parcelas" id="ocultar"> 
                                                        </br>
                                                        <label class="js_parcelas"> Parcelas </label>
                                                        <select name="js_parcelas" class="form-control"> 
                                                            <?php for ($i = 0; $i < 80; $i++) { ?>
                                                                <option value="<?= $i; ?>"><?= $i; ?> </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>


                                                </div>
                                                </br>
                                                <input type="submit" name="submit" value="LANÇAR DESPESAS" class="btn btn-danger" />
                                                       </form>



                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <!--fim modal saida -->



                            </div>
                        </div>
                    </div>
                    <?php 
                    if($balanco >= 0){
                        $modelo = "success";
                    }else{
                        $modelo = "danger";
                    }
                    ?>
                    <!-- Count item widget-->
                    <div class="text-center col-lg-6 col-md-6 col-12 bg-<?= $modelo; ?>" >
                        <div class="wrapper count-title d-flex text-center " style="text-align: center;">
                            <div class="icon"><i class="fa fa-dashboard"></i></div>
                            <div class="name"><strong class="text-uppercase text-left" style="color:#fff; font-size: 1.5em;">Balanço</strong>
                                <div class="count-number" style="font-size: 2em; color: #fff; text-align: centert">R$ <?= number_format($balanco, 2 , "," , ".") ; ?></div>
                            
                                <div class="page-header"> Carteira // =><p style="font-size:1.5em; color:yellow;"> <?=  $sessao_carteira ?></p>  </div>
                                
                                
                                                                                        <script>



                                                            $(function () {

                                                                $(".select_carteira").hide();
                                                               
                                                                $('input[name="select"]').change(function () {
                                                                    if ($('input[name="select"]:checked').val() === "select") {
                                                                        $('.select_carteira').show();
                                                                    } else {
                                                                        $('.select_carteira').hide();
                                                                    }
                                                                   
                                                                });

                                                            });
                                                        </script>



                                                     
<input type="radio" name="select" value="select" id="select" > <label for="select">  <p style="font-size:1.5em; color: #fff;"> Trocar Carteira</p></label>
                                                        
                                
                                <div class="select_carteira col-md-12">
                                    <form name="carteira" action="<?= CONF_URL_APP?>/sessao_carteira" method="post" class="form-inline"> 
                                    <select name="carteira" class="form-control">
                                        <?php 
                                        $read = new \Source\Models\Read;
                                        $read->ExeRead("app_carterias", "WHERE user_id = :id", "id={$_SESSION['user_id']}");
                                        $read->getResult();
                                        foreach ($read->getResult() as $value):
                                        ?>
                                        <option value="<?=$value['id'] ?>"> <?=$value['wallet'] ?> </option>
                                        
                                        <?php endforeach; ?>
                                        <option value="geral"> Geral </option>
                                    </select>
                                    <input type="submit" value="ALTERAR" class="btn btn-warning" />
                                </form> </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>




        <!-- Line Chart -->
        
        <div class="col-lg-8">
            <h2 class="display h4">Movimentação Financeira</h2>
            <p> Entradas e saidas de suas finanças</p>
            <div class="line-chart">
                <canvas id="lineCahrt"></canvas>
            </div>
        </div>
        
        <div class="col-lg-4">
                          <div class="card project-progress">
                            <h2 class="display h4">Projeção de Saidas</h2>
                            <p>Saidas por categoria.</p>
                            <div class="pie-chart">
                              <canvas id="pieChart" width="300" height="300"> </canvas>
                            </div>
                          </div>
                        </div>

            
       




        <!-- fim chart -->  <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <!-- Recent Updates Widget          -->
                    <div id="new-updates" class="card updates recent-updated ">
                        <div id="updates-header" class="card-header d-flex justify-content-between align-items-center bg-success">
                            <h2 class="h5 display"><a style="text-decoration:none; color:#fff;" data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box">Contas A Receber</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box"><i class="fa fa-angle-down"></i></a>
                        </div>
                        <div id="updates-box" role="tabpanel" class="collapse show">
                            <ul class="news list-unstyled">

 <?php 
                                        foreach ($proxreceita as $value):
                                    ?>
                                    <!-- Item-->
                                    <li class="d-flex justify-content-between"> 
                                        <div class="left-col d-flex">
                                            <div class="icon"><i class="fa fa-plus-square" style="font-size:1.5em; color:green;"></i></div>
                                            <div class="title"><strong style="font-size:1.5em; color:#000;"><?= $value["descricao"] ?></strong>
                                                <p style="font-size:1.5em; color:#000;">R$ <?= number_format($value["valor"] / 100, 2, ",", ".")  ?> </p>
                                              <form action="" method="post">
                                             <input type="hidden" name="id" value="<?= $value["id"]?>" />
                                             <input type="hidden" name="valor" value="<?= $value["valor"]?>" />
                                             <input type="hidden" name="descricao" value="<?= $value["descricao"]?>" />
                                             <input type="hidden" name="vencimento_em" value="<?= $value["repetir_em"]?>" />
                                             <input type="hidden" name="user_id" value="<?= $value["user_id"]?>" />
                                             <input type="hidden" name="carteira_id" value="<?= $value["carteira_id"]?>" />
                                             <input type="hidden" name="modo" value="<?= $value["modo"]?>" />
                                             <input type="hidden" name="periodo" value="<?= $value["periodo"]?>" />
                                             <input type="hidden" name="moeda" value="<?= $value["moeda"]?>" />
                                             <input type="hidden" name="js_parcelas" value="<?= $value["js_parcelas"]?>" />
                                             <input type="hidden" name="js_fixa" value="<?= $value["js_fixa"]?>" />
                                             <input type="hidden" name="tipo_b" value="<?= $value["tipo"]?>" />
                                             <input type="hidden" name="categoria_id" value="<?= $value["categoria_id"]?>" />
                                           
                                             <input type="hidden" name="status" value="paid" />
                                             
                                             <input type="hidden" name="tipo" value="entrada" />
                                            <input type="submit" value="Registrar Entrada" class="btn btn-success" />
                                        </form>
                                            </div>
                                        </div>
                                        <div class="right-col text-right">
                                            <div class="update-date"><em><p style="font-size:1em; "></br><?php                                                                
                                            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                            
                                            date_default_timezone_set('America/Sao_Paulo');
                                            echo strftime('%A, %d de %B de %Y', strtotime("{$value["repetir_em"]}"));
                                            
                                            ?><span class="month"></span></p></em></div>
                                        </div>
                                    </li>

                                <?php endforeach; ?>


                            </ul>
                        </div>
                    </div>
                    <!-- Recent Updates Widget End-->
                </div>
                <div class="col-lg-6 col-md-6">
                    <!-- Daily Feed Widget-->
                    <div id="daily-feeds" class="card updates daily-feeds">
                        <div id="feeds-header" class="card-header d-flex justify-content-between align-items-center bg-danger">
                            <h2 class="h5 display"><a style="text-decoration:none; color:#fff;" data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box">Contas a Pagar </a></h2>
                            <div class="right-column">
                                <a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box"><i class="fa fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div id="feeds-box" role="tabpanel" class="collapse show">
                            <div class="feed-box">
                                <ul class="feed-elements list-unstyled">

                                    <?php 
                                        foreach ($proxpgto as $value):
                                    ?>
                                    <!-- Item-->
                                    <li class="d-flex justify-content-between"> 
                                        <div class="left-col d-flex">
                                            <div class="icon"><i class="fa fa-minus-square" style="font-size:1.5em; color:red;"></i></div>
                                            <div class="title"><strong style="font-size:1.5em; color:#000;"><?= $value["descricao"] ?></strong>
                                                <p style="font-size:1.5em; color:#000;">R$ <?= number_format($value["valor"] / 100, 2, ",", ".")  ?> </p>
                                                            <form action="" method="post">
                                             <input type="hidden" name="id" value="<?= $value["id"]?>" />
                                             <input type="hidden" name="valor" value="<?= $value["valor"]?>" />
                                             <input type="hidden" name="descricao" value="<?= $value["descricao"]?>" />
                                             <input type="hidden" name="vencimento_em" value="<?= $value["repetir_em"]?>" />
                                             <input type="hidden" name="user_id" value="<?= $value["user_id"]?>" />
                                             <input type="hidden" name="carteira_id" value="<?= $value["carteira_id"]?>" />
                                             <input type="hidden" name="modo" value="<?= $value["modo"]?>" />
                                             <input type="hidden" name="periodo" value="<?= $value["periodo"]?>" />
                                             <input type="hidden" name="moeda" value="<?= $value["moeda"]?>" />
                                             <input type="hidden" name="js_parcelas" value="<?= $value["js_parcelas"]?>" />
                                             <input type="hidden" name="js_fixa" value="<?= $value["js_fixa"]?>" />
                                             <input type="hidden" name="tipo_b" value="<?= $value["tipo"]?>" />
                                             <input type="hidden" name="categoria_id" value="<?= $value["categoria_id"]?>" />
                                           
                                             <input type="hidden" name="status" value="paid" />
                                             
                                             <input type="hidden" name="tipo" value="entrada" />
                                            <input type="submit" value="Registrar Saida" class="btn btn-danger" />
                                        </form>
                                            </div>
                                        </div>
                                        <div class="right-col text-right">
                                            <div class="update-date"><em><p style="font-size:1em; "></br><?php
                                            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                            
                                            date_default_timezone_set('America/Sao_Paulo');
                                            echo strftime('%A, %d de %B de %Y', strtotime("{$value["repetir_em"]}"));
                                             ?><span class="month"></span></p></em></div>
                            
                                        </div>
                                        
                                    </li>

                                <?php endforeach; ?>

                                   
                            </div>
                        </div>
                    </div>
                    <!-- Daily Feed Widget End-->
                </div>

            </div>
        </div>



        <script>
            /*global $, document, Chart, LINECHART, data, options, window*/
            $(document).ready(function () {



                'use strict';

// Main Template Color
                var brandPrimary = '#33b35a';


// ------------------------------------------------------- //
// Line Chart
// ------------------------------------------------------ //
                var LINECHART = $('#lineCahrt');
                var myLineChart = new Chart(LINECHART, {
                    type: 'line',
                    options: {
                        legend: {
                            display: false
                        }
                    },
                    data: {
                        labels: [<?= $rodape ?>],
                       
                        datasets: [
                            {
                                label: "Entradas",
                                fill: true,
                                lineTension: 0.3,
                                backgroundColor: "rgba(77, 193, 75, 0.4)",
                                borderColor: brandPrimary,
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                borderWidth: 1,
                                pointBorderColor: brandPrimary,
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: brandPrimary,
                                pointHoverBorderColor: "rgba(220,220,220,1)",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 0,
                               // data: [0.00, 0.00, 1200.00, 2200.00, 3500.00, 800.00, 1200.00, 900.00],
                                data: [<?= $entrada ?>],
                                spanGaps: false
                            },
                            {
                                label: "Saidas",
                                fill: true,
                                lineTension: 0.3,
                                backgroundColor: "rgba(255,0,0,0.4)",
                                borderColor: "rgba(255,255,0,1)",
                                borderCapStyle: 'butt',
                                borderDash: [],
                                borderDashOffset: 0.0,
                                borderJoinStyle: 'miter',
                                borderWidth: 1,
                                pointBorderColor: "rgba(255,255,0,1)",
                                pointBackgroundColor: "#fff",
                                pointBorderWidth: 1,
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(255,255,0,1)",
                                pointHoverBorderColor: "rgba(255,255,0,1)",
                                pointHoverBorderWidth: 2,
                                pointRadius: 1,
                                pointHitRadius: 10,
                                data: [<?= $saida ?>],
                                spanGaps: false
                            }
                        ]
                    }
                });


// ------------------------------------------------------- //
// Pie Chart
// ------------------------------------------------------ //
//entradas
                var PIECHART = $('#pieChart');
                var myPieChart = new Chart(PIECHART, {
                    type: 'doughnut',
                    data: {
                        labels: [
                            'Alimentação' , 
                                    'Aluguel',
                                    'Compras' ,
                                    'Educação' ,
                                    'Entretenimento',
                                    'Impostos e Taxas',
                                    'Outras despesas',
                                    'Saude',
                                    'Viagens',
                                    'Combustivel'
                        ],
                        datasets: [
                            {
                                data: [<?= $alimentacao ?>, <?= $aluguel ?>, <?= $compras ?> , <?= $educacao ?> , <?= $entretenimento ?> , <?= $impostos ?> , <?= $outros ?> , <?= $saude ?> , <?= $viagens ?> , <?= $combustivel ?>],
                                borderWidth: [1, 1, 1 ],
                                backgroundColor: [
                                    brandPrimary,
                                    "rgba(75,192,192,1 )",
                                    "#FFCE56",
                                    "#dd5500",
                                    "FF5500",
                                    "#4A94E1",
                                    "#4A94E1",
                                    "#CC6400",
                                    "#66CC99",
                                    "#CC66CC"
                                ],
                                hoverBackgroundColor: [
                                    brandPrimary,
                                    "rgba(75,192,192,1)",
                                    "#FFCE56"
                                ]
                            }]
                    }
                });
 

            });


        </script>


