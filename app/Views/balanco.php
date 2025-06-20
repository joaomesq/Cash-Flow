<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fluxo de caixa - Balanço | Yia</title>

	<link rel="stylesheet" href="./public/css/custom.css">
	<link rel="stylesheet" href="./public/css/bootstrap.min.css">
      <link rel="stylesheet" href="./public/css/balanco.css">
</head>
<body>
	<header class="cabecalho bg-info">
          <?php require_once __DIR__.'/includes/dashboard.php'; ?>
     </header>

     <main class="principal p-2">
           <?php require_once __DIR__.'/includes/acesso_rapido.php'; ?> 

           <article class="analise row">
           	        <section class="info-geral design-elemento col-9">
           	        	<h2 class="light">Relatório</h2>
           	        	<div class="periodo">
           	        		<form method="POST">
           	        			<div class="selecao-periodo">
           	        				<p><button name="btn-back-periodo"><</button></p>
           	        				<p><input type="text" name="input-periodo-balanco" value="<?php echo $periodo; ?>"></p>
           	        				<p><button name="btn-next-periodo">></button></p>
           	        			</div>
           	        			<div class="valor-periodo">
           	        				<?php if($periodo == 'diario'): ?>
           	        					<input type="date" name="input-data-balanco-diario" value="<?php echo $data; ?>">
                                                <button name="btn-realizar-balanco" class="bg-primary" id="btn-realizar-balanco">Balanco</button>
           	        				<?php endif; ?>
                                          
                                          <?php if($periodo == 'mensal'): ?>

                                                <p><button name="btn-back-month"><</button></p>
                                                <p><input type="text" name="input-data-balanco-mensal" value="<?php echo $mes." - ".$ano; ?>"></p>
                                                <p><button name="btn-next-month">></button></p>

                                          <?php endif; ?>

                                          <?php if($periodo == 'anual'): ?>
                                                <p><button name="btn-back-year"><</button></p>
                                                <p><input type="text" name="input-data-balanco-anual" value="<?php echo $ano; ?>"></p>
                                                <p><button name="btn-next-year">></button></p>
                                          <?php endif;?>
           	        			</div>
           	        		</form>
           	        	</div>
                        
                        <div class="conteudo row">
                        <div class="grafico col-4">
                           <div class="figura" style="--percentagem: <?php echo number_format($percentagem_receitas, 0, ',', '.'); ?>;"> <?php echo FormatNumber($percentagem_receitas)." %"; ?></div>
                           <p id="receitas" class="receitas">Receitas</p>
                           <p id="despesas" class="despesas">Despesas</p>
                        </div>

                        <div class="dados col-8">
                              <div class="entradas">
                                    <span>Entradas</span>
                                    <p><?php echo "Kz$ ".$total_receitas; ?></p>
                              </div>

                              <div class="saidas">
                                    <span>Saídas</span>
                                    <p><?php echo "Kz$ ".$total_despesas; ?></p>
                              </div>
                              
                              <!--- Automatização da classe para o backgorund de acordo com o valor do saldo -->
                              <?php 
                                  if($saldo < 0):
                                    $fundo = "negativo";
                                  else:
                                    $fundo = "positivo";
                                  endif;
                              ?>
                              <div class="saldo <?php echo " ".$fundo; ?>">
                                    <span>Total</span>
                                    <p><?php echo "Kz$ ".$saldo; ?></p>
                              </div>
                        </div>
                    </div>
           	        </section>

           	        <section class="asside col-3">
                          <div class="n_entradas design-elemento">
                                <p><img src="./public/img/entrada.png" style="width: 20px; height: 20px;"></p>
                                <h5><?php echo "$entradas"; ?></h5>
                          </div>

                          <div class="n_saidas design-elemento">
                                <p><img src="./public/img/saida.png" style="width: 20px; height: 20px;"></p>
                                <h5><?php echo "$saidas"; ?></h5>
                          </div>

                          <div class="total_movimentos design-elemento">
                                <p>
                                    <img src="./public/img/entrada.png" style="width: 20px; height: 20px;">
                                    <img src="./public/img/saida.png" style="width: 20px; height: 20px;">
                                </p>
                                <h5><?php echo "$total_movimentos"; ?></h5>
                          </div>
                    </section>
           </article>
           <article class="listagem row design-elemento">
                 <section class="col-6">
                       <h5>Entradas</h5>
                       <table class="p-2 table table-striped table-hover">
                             <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php if(is_array($dados_movimentos['receitas'])): ?>
                                          <?php $row = 1; ?>
                                          <?php foreach ($dados_movimentos['receitas'] as $lista): ?>
                                                <?php foreach ($lista as $key=> $value): ?>
                                                      <tr>
                                                         <th scope="row"><?php echo $row; ?></th>
                                                         <td><?php echo $key; ?></td>
                                                         <td class="receitas"> <?php echo "Kz$ ".FormatNumber($value); ?></td>

                                                      </tr>
                                                      <?php $row++; ?>
                                                <?php endforeach;?>
                                          <?php endforeach; ?>
                                    <?php else: ?>
                                          <tr>
                                             <th scope="row">0</th>
                                             <td>Sem entradas para <?="
                                             ".$data; ?></td>
                                           </tr>
                                    <?php endif; ?>
                              </tbody>
                        </table>
                 </section>

                 <section class="col-6 linha">
                       <h5>Saídas</h5>
                       <table class="p-2 table table-striped table-hover">
                             <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Descrição</th>
                                        <th>Valor</th>
                                    </tr>
                              </thead>
                              <tbody>
                                    <?php if(is_array($dados_movimentos['despesas'])): ?>
                                          <?php $row = 1; ?>
                                          <?php foreach ($dados_movimentos['despesas'] as $lista): ?>
                                                <?php foreach ($lista as $key=> $value): ?>
                                                      <tr>
                                                         <th scope="row"><?php echo $row; ?></th>
                                                         <td><?php echo $key; ?></td>
                                                         <td class="despesas"> <?php echo "Kz$ ".FormatNumber($value); ?></td>

                                                      </tr>
                                                      <?php $row++; ?>
                                                <?php endforeach;?>
                                          <?php endforeach; ?>
                                    <?php else: ?>
                                          <tr>
                                             <th scope="row">0</th>
                                             <td>Sem saídas para <?="
                                             ".$data; ?></td>
                                           </tr>
                                    <?php endif; ?>
                              </tbody>
                        </table>
                 </section>
           </article>
    </main>

    <footer></footer>

    <?php require_once __DIR__.'/includes/files_js_includes.php'; ?>

</body>
</html>