<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Fluxo de caixa - Adiconar | Yia</title>
    
    <link rel="stylesheet" href="./public/css/custom.css">
    <link rel="stylesheet" href="./public/css/adicionar_transacao.css">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
</head>
<body>
     <header class="cabecalho bg-info">
          <?php require_once __DIR__.'/includes/dashboard.php'; ?>
     </header>

     <main class="principal p-2">
           <?php require_once __DIR__.'/includes/acesso_rapido.php'; ?> 

    	<article class="transacoes">
    		<div class="top" id="display-sticky">
    		<section class="resumo">
               <div class="periodo">
               	<form action="" method="POST">
               		
               		<p><button name="btn-back"><-</button></p>
               		<p><input type="text" name="input-periodo" value="<?php echo $nome_mes."-".$ano;?>"></p>
               		<p><button class="btn" name="btn-next">-></button></p>
               	</form>
               </div>
    			<table>
    				<thead>
    					<th>Receitas</th>
    					<th>Despesas</th>
    					<th>Saldo</th>
    				</thead>
    				<tbody>
    					<td><?php echo "Kz$ +".$receitas; ?></td>
    					<td><?php echo "Kz$ -".$despesas; ?></td>
    					<td class="<?php $class = ($saldo > 0)?'entrada': 'saida'; echo $class; ?>"><?php echo "Kz$ ".$saldo; ?></td>
    				</tbody>
    			</table>
    		</section>

    		<section class="registrar">
    			<form action="/index.php?registrar_transacao" method="POST">
    				<p>
    					<label>Descrição</label>
    					<input type="text" name="input-descricao" autofocus>
    				</p>
    				<p>
    					<label>Categoria</label>
    					<select name="select-categoria">
    						<option value="Vendas" class="c_receitas" cheked>Vendas</option>
    						<option value="P. Serviços" class="c_receitas">Prestação de Serviços</option>
    						<option value="Recebimentos" class="c-receitas">Recebimentos</option>
    						<option value="Investimentos">Investimentos</option>
    						<option value="Despesas fixas" class="c_depsesas">Despesas fixas</option>
    						<option value="Despesas variáveis" class="c_despesas">Despesas variáveis</option>
    						<option value="Gastos não essenciais" class="c_despesas">Gastos não essenciais</option>
    						<option value="outros">Outros</option>
    					</select>
    				</p>
    				<p>
    					<label>Data</label>
    					<input type="date" name="input-data">
    				</p>
    				<p>
    					<label>Valor</label>
    					<input type="text" name="input-valor" value="0">
    				</p>
    				<p class="tipo-radio">
    					<input type="radio" name="input-tipo" value="entrada" checked><label>Entrada</label>
    				</p>
    				<p class="tipo-radio">
    					<input type="radio" name="input-tipo" value="saida"><label>Saída</label>
    				</p>
    				<p>
    					<button name="btn-registrar-transacao" class="btn bg-primary">Adicionar</button>
    				</p>
    			</form>
    		</section>
          </div>

    		<section class="lista-transacoes">
    			<table class="p-3 table table-striped table-hover">
    				<thead class="thead-light">
    					<tr class="p-3">
    						<th>#</th>
    						<th>Descrição</th>
    						<th>Cateroria</th>
    						<th>Data</th>
    						<th>Valor</th>
    						<th></th>
    					</tr>
    				</thead>
    				<tbody> 
    					<?php $row = 1; ?>
    				     <?php while ($dados = $transacoes->fetchArray(SQLITE3_ASSOC)): ?>
    						<tr>
    							<th scope="row"><?php echo $row;?></th>
    							<td><?php  echo $dados['descricao']; ?></td>
    							<td><?php  echo $dados['categoria']; ?></td>
    							<td><?php  echo $dados['ano_mes_dia']; ?></td>
    							<td class="<?php echo $dados['tipo']; ?>" ><?php  echo "Kz$ ".FormatNumber($dados['valor']); ?></td>
							<td>
                                       <form method="POST">
                                            <input type="hidden" name="input-id" value="<?php echo $dados['id_transacao']; ?>">
                                            <button name="btn-deletar" id="deletar" >Delete</button>
                                       </form>                            
                                   </td>
    						</tr>
    						<?php $row++; ?>
    					<?php endwhile; ?>
    					<?php if(!$transacoes->fetchArray(SQLITE3_ASSOC)): ?>
    						<tr>
    							<td><?php echo "Sem registros"; ?></td>
    						</tr>
    					<?php endif; ?>

    				</tbody>
    			</table>
    		</section>
    	</article>

    </main>

    <?php require_once __DIR__.'/includes/files_js_includes.php'; ?>
</body>
</html>