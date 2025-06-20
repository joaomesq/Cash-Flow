<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fluxo de Caixa - Transações | Yia</title>

     <link rel="stylesheet" href="./public/css/custom.css">
     <link rel="stylesheet" href="./public/css/transacoes.css">
     <link rel="stylesheet" href="./public/css/bootstrap.min.css">
</head>
<body>
     <header class="cabecalho bg-info">
          <?php require_once __DIR__.'/includes/dashboard.php'; ?>
     </header>

     <main class="principal p-2">
           <?php require_once __DIR__.'/includes/acesso_rapido.php'; ?> 

           <article class="transacoes">
                <section class="filtrar" id="display-sticky">
                     <form method="POST" action="/?filtrar_transacoes">
                          <legend>Pesquisa por:</legend>
                          <div class="values row">
                              <div class="col-3 seletores">
                                   <p><input type="radio" name="input-filtro" value="data">Data</p>
                                   <p id="seletor-data">
                                        <input type="date" name="input-data-inicial">-
                                        <input type="date" name="input-data-final">
                                   </p>
                              </div>
                              <div class="col-2 seletores">
                                   <p><input type="radio" name="input-filtro" value="descricao">Descrição</p>
                                   <p>
                                        <select name="select-descricao">
                                             <?php  while($desc = $descricao->fetchArray(SQLITE3_ASSOC)):?>
                                                  <option value="<?php echo $desc['descricao']; ?>"><?php echo $desc['descricao']; ?></option>
                                             <?php endwhile; ?>
                                        </select>
                                   </p>
                              </div>
                              <div class="col-2 seletores">
                                   <p><input type="radio" name="input-filtro" value="categoria">Categoria</p>
                                   <p>
                                        <select name="select-categoria">
                                             <?php  while($cat = $categoria->fetchArray(SQLITE3_ASSOC)):?>
                                                  <option value="<?php echo $cat['categoria']; ?>"><?php echo $cat['categoria']; ?></option>
                                             <?php endwhile; ?>
                                        </select>
                                   </p>
                              </div>
                              <div class="col-2 seletores">
                                   <p><input type="radio" name="input-filtro" value="valor">Valor</p>
                                   <p><input type="number" name="input-valor"></p>
                              </div>
                              <div class="col-2 seletores">
                                   <p><input type="radio" name="input-filtro" value="tipo">Tipo</p>
                                   <p id="tipo">
                                        <input type="radio" name="input-tipo" value="entrada">Entrada
                                        <input type="radio" name="input-tipo" value="saida">Saída
                                   </p>
                              </div>
                              <div>
                                   <button name="btn-filtrar" class="btn bg-success">AP. FILTRO</button>
                                   <button name="btn-todos" class="btn bg-primary">Todos</button>
                              </div>
                          </div>
                     </form>
                </section>

                <section class="lista-transacoes">
                    <div class="top-lista row">
                     <h3 class="col-6">Transações</h3>
                     <div class="col-6">
                          <?php $filtro = $filtro?? 'Todos';?>
                          <?php switch($filtro):
                                        case 'data':
                                             echo "<span>".$filtro.": ".$data_inicial." | ".$data_final."</span>";
                                             break;
                                        case 'categoria':
                                             echo "<span>".$filtro.": ".$categoria_s."</span>";
                                             break;
                                        case 'descricao':
                                             echo "<span>Descrição: ".$descricao_s."</span>";
                                             break;
                                        case 'valor':
                                             echo "<span>".$filtro.": ".$valor."</span>";
                                             break;
                                        case 'tipo':
                                             echo "<span>".$filtro.": ".$tipo."</span>";
                                             break;
                                        default:
                                             echo "<span>".$filtro.": Todos</span>";
                                             break;
                                endswitch;
                          ?>
                     </div>
                     </div>

                     <table class="p-3 table table-striped table-hover">
                         <thead class="thead-light">
                              <tr>
                                   <th>#</th>
                                   <th>Descrição</th>
                                   <th>Categoria</th>
                                   <th>Data</th>
                                   <th>Valor</th>
                              </tr>
                          </thead>
                          <tbody>
                               <?php $row = 1; ?>
                               <?php while($registros = $dados->fetchArray(SQLITE3_ASSOC)): ?>
                                   <tr>
                                        <th scope="row"><?php echo $row; ?></th>
                                        <td><?php echo $registros['descricao']; ?></td>
                                        <td><?php echo $registros['categoria']; ?></td>
                                        <td><?php echo $registros['ano_mes_dia']; ?></td>
                                        <td class="<?php echo $registros ['tipo']; ?>"><?php echo "Kz$ ".FormatNumber($registros['valor']); ?></td>
                                   </tr>
                                   <?php $row++; ?>
                              <?php endwhile; ?>
                          </tbody>
                     </table>
                </section>
           </article> 
     </main>
     
     <?php require_once __DIR__.'/includes/files_js_includes.php'; ?>
</body>
</html>