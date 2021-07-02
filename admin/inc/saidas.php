


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

            <div class="page-header"><h3 class="text-white"> Saidas </h3> 
                
                <?php 
                $entrada = new Source\Core\Faturas();
                $entrada->registra();
                ?>
            
                 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalreceita">
                                Lançar Saidas
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="modalreceita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-flag" aria-hidden="true" style="color:red;"></i> Lançar Despesas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="" id="receita" class="form">
                                                <input type="hidden" name="modo" value="saida" />
                                                <div class="col-lg-12"> 
                                                    <p><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Descrição </p>
                                                    <input type="text" name="descricao" placeholder="Descrição do Lançamento" class="form-control" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-money " ></i> Valor </p>
                                                      
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
                                                        <label><i class="fa fa-filter"></i> Categoria </label>
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

                                                        <label><i class="fa fa-filter"></i> Repetição </label>
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
                                                <input type="submit" name="submit" value="LANÇAR RECEITAS" class="btn btn-danger" />
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
            
            </br>

            <div class="col-md-12"> 

                <div class="row"> 
                    <form action="" method="post" name="buscar" class="form-inline">
                        <div class="form-group">
                            <label>Periodo 
                                <?php
                                $cad = new Source\Models\Read();
                                $cad->ExeRead("usuarios", "WHERE id = :i", "i={$_SESSION['user_id']}");
                                $sub = $cad->getResult()[0]["created_at"];

                                $prep = explode("-", $sub);

                                $mnow = date("m");
                                $anow = date("Y");

                                $m = $prep['1'];
                                $y = $prep['0'];

                                $agora = date("Y-m-d");
                                $data1 = new DateTime("{$y}-{$m}");
                                $data2 = new DateTime("{$anow}-{$mnow}");

                                $intervalo = $data1->diff($data2);

                                $agora = date("Y") . "-" . date("m");

                                // echo "Intervalo é de  {$intervalo->m} meses ";
                                ?>
                            </label>
                            <select name="periodo" class="form-control"> 
                                <?php
                                for ($i = 0; $i <= "{$intervalo->m}"; $i++):

                                    echo $period = date('m/Y', strtotime("-{$i} month", strtotime("{$agora}")));
                                    ?>
                                    <option value="<?= $period ?>"><?= $period ?> </option>
                                <?php endfor; ?>
                                <option value="todas">Todo Periodo </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Carteira </label>
                            <select name="carteira" class="form-control"> 
                                <?php
                                $cart = new Source\Models\Read();
                                $cart->ExeRead("app_carterias", "WHERE user_id = :r", "r={$_SESSION["user_id"]}");
                                $cart->getResult();
                                foreach ($cart->getResult() as $value):
                                    ?>
                                    <option value="<?= $value["id"] ?>"> <?= $value["wallet"] ?> </option>
                                <?php endforeach; ?>
                                <option value="geral">Geral </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Categoria </label>
                            <select name="categoria" class="form-control"> 
                                <?php
                                $cat = new Source\Models\Read();
                                $cat->ExeRead("app_categorias", "WHERE type = :r", "r=renda");
                                $cat->getResult();
                                foreach ($cat->getResult() as $value):
                                    ?>
                                    <option value="<?= $value["id"] ?>"> <?= $value["name"] ?> </option>
                                <?php endforeach; ?>
                                <option value="geral">Todas Categorias </option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status </label>
                            <select name="status" class="form-control"> 
                                <option value="paid">Pagas </option>
                                <option value="unpaid">Em aberto </option>
                                <option value="todas">Todas </option>

                            </select>
                        </div>
                        <div class="form-group"> 
                            <input type="submit" name="buscar" value="BUSCAR" class="btn btn-success" />
                        </div>
                    </form>
                </div>

            </div>

            <div class="row"> 

                <div class="col-md-12"> 


                    <div class="table table-responsive table-condensed">
                        <table id="example" style="width:100%" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Vencimento</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                    <th>Carteira</th>
                                    <th>Categoria</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Editar</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $filtro = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                                
                                $entradas = new \Source\Core\Saidas();
                                $entradas->update();
                                $entradas->buscar();
                                
                                 $atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
           
           $pager = new \Source\Support\Pager('entrada&atual=', 'Primeira', 'Ultima', '1');
             $pager->ExePager($atual, 5);
            
             $pager->ExePaginator("app_faturas");

           

                                $total = 0;
                                foreach ($entradas->buscar() as $exibe):
                                    
                                    $total += $exibe["valor"];
                                    ?>
                                
                                    <tr>
                                        <td><?= date("d/m/Y", strtotime($exibe["vencimento_em"])) ?></td>
                                        <td><?= $exibe["descricao"] ?></td>
                                        <td><?= number_format($exibe["valor"] / 100, 2, ",", "."); ?></td>
                                        
                                        <td><?php
                                    $cart = new Source\Models\Read();
                                    $cart->ExeRead("app_carterias", "WHERE id = :id", "id={$exibe["carteira_id"]}");
                                    $cart->getResult();

                                    echo $cart->getResult()[0]['wallet'];
                                    ?></td>
                                        <td><?php

                                        $exibe["categoria_id"]; 
                                    $categ = new Source\Models\Read();
                                    $categ->ExeRead("app_categorias", "WHERE id = :id", "id={$exibe["categoria_id"]}");
                                   echo $categ->getResult()[0]['name'];
                                        
                                        
                                        ?></td>
                                        
                                        <td> <?= $exibe["tipo"] ?> </td>
                                        
                                        <td><?php
                                            if ($exibe["status"] == "paid") {
                                                echo "PAGO";
                                            }
                                            if ($exibe["status"] == "unpaid") {
                                                echo "EM ABERTO";
                                            }
                                            ?></td>
                                        
                                        <td> <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal<?= $exibe["id"] ?>">
  Editar
</button></td>

<div class="modal fade" id="Modal<?= $exibe["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title <?= $exibe["id"] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
        <?php 
        $viewedit = new Source\Models\Read();
        $viewedit->ExeRead("app_faturas", "WHERE id = :id", "id={$exibe["id"]}");
        $viewedit->getResult();
        
        
        ?>
      <div class="modal-body">
         <form method="post" action="" id="receita" class="form">
                                                <input type="hidden" name="modo" value="saida" />
                                                <input type="hidden" name="id" value="<?= $viewedit->getResult()[0]["id"] ?>" />
                                                <div class="col-lg-12"> 
                                                    <p><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Descrição </p>
                                                    <input type="text" name="descricao" value="<?= $viewedit->getResult()[0]["descricao"] ?>" placeholder="Descrição do Lançamento" class="form-control" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-money " ></i> Valor </p>
                                                      
                                                        <input type="text" name="valor" value="<?= number_format($viewedit->getResult()[0]["valor"] / 100, 2, ".", ".")  ?>" id="valor" class="form-control" />
                                                        
                                                     
                                                    </div>
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-table" aria-hidden="true"></i> Data </p>
                                                        <input type="date" id="date" name="vencimento_em" value="<?= $viewedit->getResult()[0]["vencimento_em"] ?>"  class="form-control input-datepicker" />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6"> 
                                                        </br>
                                                        <p><i class="fa fa-book" ></i> Carteira </p>
                                                        <select name="carteira_id" class="form-control"> 
                                                            <option value="<?= $viewedit->getResult()[0]["carteira_id"] ?>"> <?php
                                                            
                                                            
                                                                    
                                                                    $nomecart = new Source\Models\Read();
                                                            $nomecart->ExeRead("app_carterias", "WHERE id = :id", "id={$viewedit->getResult()[0]["carteira_id"]}");
                                                           echo $nomecart->getResult()[0]['wallet'];
                                                                    
                                                                    ?> </option>
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
                                                        <label><i class="fa fa-filter"></i> Categoria </label>
                                                        <select name="categoria_id" class="form-control"> 
                                                            <option value="<?= $viewedit->getResult()[0]["categoria_id"] ?>"> <?php
                                                                    
                                                                    $nomecategoria = new Source\Models\Read();
                                                            $nomecategoria->ExeRead("app_categorias", "WHERE id = :id", "id={$viewedit->getResult()[0]["categoria_id"]}");
                                                            echo $nomecategoria->getResult()[0]["name"];
                                                                    
                                                                     ?> </option>
                                                            <?php 
                                                            foreach ($renda as $forrenda):
                                                       
                                                            ?>

                                                            <option value="<?= $forrenda["id"] ?>"><?= $forrenda["name"] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="col-lg-6"> 
                                                    
                                                        <label><i class="fa fa-filter"></i> Status </label>
                                                        <select name="status" class="form-control"> 
                                                            <option value="<?= $viewedit->getResult()[0]["status"] ?>"> <?php 
                                                            if($viewedit->getResult()[0]["status"] == "paid"){ 
                                                                echo "Pago";
                                                                
                                                            }else{
                                                                echo "Em aberto";} ?>  </option>
                                                            <option value="paid"> Pago</option>
                                                            <option value="unpaid"> Em Aberto</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="col-lg-6"> 
                                                    <input type="submit" name="editar" value="EDITAR RECEITA" class="btn btn-success" />
                                                    </div>
                                                    
                                                </div>
                                                </br>
   

                                                </div>
                                                </br>
                                                
                                                       </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>



                                    </tr>
                                        <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                        <div class='col-md-12'> <h5>Total de Entradas R$ <?= number_format($total / 100,2, ",", "."); ?> </h5> </div>

                                        <?php  ?>
                    </div>
                </div>



            </div>


        </div>


</div>

</div>

</div>
</div>

