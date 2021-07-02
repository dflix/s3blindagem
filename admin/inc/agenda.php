

<div class="container-fluid">
    <h3 class="text-white"> Agenda de Eventos</h3>
    <?php 
    $agenda = new \Source\Core\Agenda();
    $agenda->cadastra();
    
    if(!empty($_GET["del"])){
        $deleta = new Source\Models\Delete();
        $deleta->ExeDelete("eventos", "WHERE id = :id", "id={$_GET["del"]}");
        $deleta->getResult();
        if($deleta->getResult()){
             echo "<div class=\"alert alert-success col-md-12\" role=\"alert\">
                <h5>Evento Deletado com Sucesso </h5>  </div>";
        }else{
             echo "<div class=\"alert alert-danger col-md-12\" role=\"alert\">
                <h5>Erro ao deletar evento </h5>  </div>";
        }
    }
    
    ?>
    </br>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
  Cadastrar Evento
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method="post" >
      <div class="modal-body">
          <div class="row">
              
          <div class="col-md-12"> 
              <label>Titulo </label>
              <input type="text" class="form-control" name="title" />
          </div>
              
          <div class="col-md-6"> 
              <label> Data Inicio </label>
             
              <input type="date" id="date" class="form-control"  name="start_dia" />
              
          </div>
              
          <div class="col-md-3"> 
              <label>Horas </label>
              <select class="form-control" name="start_horas">
                  <?php for($i=0 ; $i <= 24; $i++){ ?>
                  <option value="<?= $i ?> "> <?= $i ?> </option>
                  <?php } ?>
              </select>
          </div>
              
          <div class="col-md-3"> 
              <label>Minutos</label>
              <select class="form-control" name="start_minutos">
                  
                  <option value="00"> 00 </option>
                  <option value="15"> 15 </option>
                  <option value="30"> 30 </option>
                  <option value="45"> 45 </option>
                  
              </select>
          </div>
              
          <div class="col-md-6"> 
              <label> Data Fim </label>
             
              <input type="date" id="date" class="form-control"  name="end_dia" />
              
          </div>
              
          <div class="col-md-3"> 
              <label>Horas </label>
              <select class="form-control" name="end_horas">
                  <?php for($i=0 ; $i <= 24; $i++){ ?>
                  <option value="<?= $i ?>"> <?= $i ?> </option>
                  <?php } ?>
              </select>
          </div>
              
          <div class="col-md-3"> 
              <label>Minutos</label>
              <select class="form-control" name="end_minutos">
                  
                  <option value="00"> 00 </option>
                  <option value="15"> 15 </option>
                  <option value="30"> 30 </option>
                  <option value="45"> 45 </option>
                  
              </select>
          </div>
              
          <div class="col-md-6"> 
              <label>Cor </label>
              <select name="color" class="form-control"> 
                  <option value="#6A5ACD" style="background: #6A5ACD;">  AZUL  </option>
                  <option value="#00FFFF" style="background: #00FFFF;">  ACQUA  </option>
                  <option value="#FFFF00" style="background: #FFFF00;">  AMARELO </option>
                  <option value="#F5F5DC" style="background: #F5F5DC;">  BEGE </option>
                  <option value="#FFA500" style="background: #FFA500;">  LARANJA </option>
                  <option value="#00FF00" style="background: #00FF00;">  VERDE </option>
                  
                  <option value="##40E0D0" style="background: #40E0D0;">  TURQUESA </option>
                  <option value="#DAA520" style="background: #DAA520;">  GOLDEN </option>
                  <option value="#FF6347" style="background: #FF6347;">  VERMELHO </option>
              </select>
          </div>
              
              
              
          <div class="col-md-6"> 
              <label>. </label></BR>
              <input type="submit" class="btn btn-success" name="cadastra" value="CADASTRAR" />
          </div>
              
              
          </div>
      </div>
            </form>
      <div class="modal-footer">
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
</div>

<div id='calendar'></div>

<div class="container-fluid">
    <div class="row">
        
        
        
    
        <div class="col-md-12"> <h5>Buscar</h5> </div>
    
        <form class="form-inline" action="" method="post"> 
            <input type="date" id="date" class="form-control"  name="search" />
            <input type="submit" name="subsearch"  class="form-control btn btn-primary" value="Buscar / Editar"   />
        </form>
    </div>
    
<?php 

    
    
    
    ?>
    
    <div class="col-md-12"> 
        <table class="table table-responsive"> 
             <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Inicio</th>
                                    <th>Fim</th>
                                   
                                    <th>Editar</th>
                                    <th>Deletar</th>


                                </tr>
                            </thead>
             <tbody>
                     <?php 
   $filtro = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRIPPED);
    if(!empty($filtro["search"])){ 
    
    $trata = explode("-", $filtro["search"]);
    
    $y = $trata['0'];
    $m = $trata["1"];
    $d = $trata["2"];

        $read = new Source\Models\Read();
        $read->ExeRead("eventos", "WHERE user_id = :id AND YEAR(start) = :y AND MONTH(start) = :m AND DAY(start) = :d", "id={$_SESSION["user_id"]}&y={$y}&m={$m}&d={$d}");
        $read->getResult();

        foreach ($read->getResult() as $value):
    ?>
                                <tr>
                                    <th><?= $value["title"] ?></th>
                                    <th><?= date("d/m/Y H:i:s" , strtotime($value["start"]))   ?></th>
                                    <th><?= date("d/m/Y H:i:s" , strtotime($value["end"]))   ?></th>
                                 
                                    <th>Editar</th>
                                    <th><a href="./agenda&del=<?= $value["id"] ?>" class="btn btn-danger">Deletar</a></th>


                                </tr>
                                
                                <?php endforeach;?>
                              
                            </body>
        
        </table>
    </div>
    <?php } ?>
</div>



<style>

    #calendar {
        max-width:90%;
        margin: 0 auto;
    }

</style>

<link href='<?= CONF_URL_BASE ?>/fullcalendar/css/core/main.min.css' rel='stylesheet' />
<link href='<?= CONF_URL_BASE ?>/fullcalendar/css/daygrid/main.min.css' rel='stylesheet' />
<script src='<?= CONF_URL_BASE ?>/fullcalendar/js/core/main.min.js'></script>
<script src='<?= CONF_URL_BASE ?>/fullcalendar/js/interaction/main.min.js'></script>
<script src='<?= CONF_URL_BASE ?>/fullcalendar/js/daygrid/main.min.js'></script>
<script src='<?= CONF_URL_BASE ?>/fullcalendar/js/core/locales/pt-br.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'pt-br',
            plugins: ['interaction', 'dayGrid'],
            //defaultDate: '2019-04-12',
            editable: true,
            eventLimit: true,
            events: "<?= CONF_URL_BASE ?>/fullcalendar/list_eventos.php",
            extraParams: function () {
                return {
                    cachebuster: new Date().valueOf()
                };
            },
            eventClick: function (info) {

                alert('Evento: ' + info.event.title + '...');


                // change the border color just for fun
                info.el.style.borderColor = 'red';
            }

        });



        calendar.render();
    });
//                    extraParams: function () {
//                        return {
//                            cachebuster: new Date().valueOf()
//                           
//                        };
//                    }
//                });
//                ;
//                calendar.render();
//            });

</script>

