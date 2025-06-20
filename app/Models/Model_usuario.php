<?php
require_once dirname(__DIR__, 2).'/config/connect.php'; 
//Classes obrigatórias

class Model_usuario extends Database{
	public $usuario;
	public $password;
	private $tabela;

	function __construct(){
		parent::__construct();
		$this->tabela = "usuarios";
	}
    
    public function validar_usuario(){
    	//Limpando os dados
        $this->usuario = clear($this->usuario);

    	$sql = "SELECT senha FROM $this->tabela WHERE nome = '$this->usuario'";
    	$consulta = $this->total_rows($sql);

    	if($consulta > 0):
    		$dados = $this->get($sql);
            $senha = $dados['senha'];
    		return $senha;
    	else:
    		return false;
    	endif; 
    }

    public function login(){
    	//Limpar os dados
    	$this->password = clear($this->password);
    	$hash_password = $this->validar_usuario();
        
    	if( $this->password === $hash_password ):
    		$sql = "SELECT id_usuario, nome, email, instituicao FROM $this->tabela WHERE nome = '$this->usuario' AND senha = '$hash_password'";
    		$consulta = $this->total_rows($sql);
    		
    		if($consulta === 4):
    			$dados = $this->get($sql);
    			return $dados; 
    		else:
    			return false;
    		endif;
    	else:
    		return false;
    	endif;
    }

    public function sigin(string $tipo, string $escola, string $email, string $telefone){
    	//Limpar dados 
    	$this->password = $this->db->clear($this->password);
    	$this->usuario = $this->db->clear($this->usuario);
    	$tipo_usuario = $this->db->clear($tipo);
    	$escola = $this->db->clear($escola);
    	$email = $this->db->clear($email);
    	$telefone = $this->db->clear($telefone);
        
        //Critptografar a senha
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        
        //Pegando o id da escola
        $sql_escola = "SELECT id_escola FROM escolas WHERE nome_escola = '$escola'";
        $escola = mysqli_query($this->conexao, $sql_escola);
        if(mysqli_num_rows($escola) == 1):
        	$escola = mysqli_fetch_assoc($escola);
        	$escola = $escola['id_escola'];
        endif;

    	if(!$this->validar_usuario()):
    		$sql = "INSERT INTO $this->tabela
    		        (nome_usuario, senha_usuario, email_usuario, telefone_usuario, escola_usuario, tipo_usuario)
    		        VALUES
    		        ('$this->usuario', '$this->password', '$email', '$telefone', $escola, '$tipo_usuario')";
    	    $consulta = mysqli_query($this->conexao, $sql);
    	    if($consulta):
    	    	return true;
    	    else:
    	    	return false;
    	    endif;
    	endif;
    }

    public function update(int $id, string $nome, string $tipo, string $escola, string $email, string $telefone){
        $id_usuario = $this->db->clear($id);
        $nome_usuario = $this->db->clear($nome);
        $tipo_usuario = $this->db->clear($tipo);
        $escola_usuario = $this->db->clear($escola);
        $email_usuario = $this->db->clear($email);
        $telefone_usuario = $this->db->clear($telefone);
        
        //Verificando e pegando a escola
        $sql_escola = "SELECT id_escola FROM escolas WHERE nome_escola = '$escola_usuario'";
        $consulta_escola = mysqli_query($this->conexao, $sql_escola);
        if(mysqli_num_rows($consulta_escola) === 1):
            $escola = mysqli_fetch_assoc($consulta_escola);
            $escola_usuario = $escola['id_escola'];
        endif;

        //Verificando o usuário
        $sql = "SELECT id_usuario FROM $this->tabela WHERE id_usuario = $id_usuario";
        $consulta = mysqli_query($this->conexao, $sql);
        if(mysqli_num_rows($consulta) === 1):
            $sql = "UPDATE $this->tabela SET nome_usuario = '$nome_usuario', tipo_usuario = '$tipo_usuario', email_usuario = '$email_usuario', telefone_usuario = '$telefone_usuario'";
            $consulta = mysqli_query($this->conexao, $sql);
            if($consulta):
                return true;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    public function pegarUsuarios()
    {
        $sql = "SELECT *FROM $this->tabela";
        $consulta = $this->requisicao($sql);

        return $consulta;
    }
}
 