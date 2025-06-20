 <?php
//routers

class Route{
	private static $routers = [
		                        "GET"=>[
		                        	""=>"Controller@index", "index"=>"Controller@index",
		                        	"adicionar"=>"Controller_transacoes@registrar_transacao",
		                        	"registos"=>"Controller_transacoes@ver_transacoes",
		                        	"balanco"=>'Controller_balanco@index',
		                        	"login"=>'Controller_user@login', "logout"=>'Controller_user@logout'
		                        ],
		                        "POST"=>[
		                        	"adicionar"=>"Controller_transacoes@registrar_transacao",
		                        	"registrar_transacao"=>"Controller_transacoes@registrar_transacao", "deletar"=>"Controller_transacoes@deletar_transacao",
		                        	"filtrar_transacoes"=>"Controller_transacoes@filtrar" ,
		                        	"balanco"=>"Controller_balanco@balanco_periodo",
		                        	"login"=>"Controller_user@login"

		                        ]
	                ];

	public static function router($url, $metodo){
		//Verificando a existência da rota
		$route = isset(self::$routers[$metodo][$url])? self::$routers[$metodo][$url]: false;

		if(!empty($route)):
			list($classe, $method) = explode("@", $route);

			//Chamando o controler
			require_once dirname(__DIR__, 1)."/app/Controllers/$classe.php";
			//Verificando a existência da classe e do metodo
			if(class_exists($classe) && method_exists($classe, $method)):
				$controller = new $classe;
			    $controller->$method();
		    else:
		    	echo "Classe não existe";
		    endif;
		else:
			http_response_code(404); 
        	echo "Página não encotrada! Clique <a href='index.php'>Aqui2</a>";
        endif;

	}
}