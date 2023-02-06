<div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box">
            <a href="cadServidor.php">
              <div class="icon"><i class="bi bi-people"></i></div>
              <h4 class="title">CADASTRO SERVIDORES</h4>
              <p class="description">Acesse aqui o Sistema de cadastro dos Servidores Municipais filiados ao Sindserva.</p>
              </a>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box"><a href="caduser.php">
              <div class="icon"><i class="bi bi-person-bounding-box"></i></div>
              <h4 class="title">CADASTRO DE USUÁRIOS</h4>
              <p class="description">Acesse aqui o Sistema de cadastro de usuários para os Servidores Municipais filiados ao Sindserva.</p></a>
            </div>
          </div>

          
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="box"><a href="cadloja.php">
              <div class="icon"><i class="bi bi-shop"></i></div>
              <h4 class="title">CADASTRO DE EMPRESAS</h4>
              <p class="description">Acesse aqui o Sistema de cadastro de lojistas filiados ao Sindserva.</p></a>
            </div>
          </div>
          <?php
              if($tipologado=="operador" && $idcolaboradorlogado==6616)
              {
                $bloqueiaoperador = "readonly";
                $esconderbotao = "none";
                //$bloqueiaoperador = "";
              }
              else {
                $bloqueiaoperador = "";
                $esconderbotao = "block";
              }

         ?>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100" style="display: <?=$esconderbotao?>;">
            <div class="box">
            <a href="relatorio_sindcard.php">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title">RELATÓRIO SINDCARD</h4>
              <p class="description">Acesse aqui o relatório de compras dos filiados ao Sindserva.</p>
              <?=$esconderbotao?>
              </a>
            </div>
          </div>

             

        </div>

        