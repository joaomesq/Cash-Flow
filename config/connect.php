<?php
class Database{
    public $db;

    public function __construct(){
      $this->db = new SQLite3('./DB/database.db');
    }

    public function requisicao($sql){
      $yia = $this->db->query($sql);
      return $yia;
    }
    public function inserir($sql){
      $this->db->exec($query);
    }
    public function get($sql){
      $yia = $this->requisicao($sql);
      $dados = $yia->fetchArray(SQLITE3_ASSOC);
      return $dados;
    }
    public function total_rows($sql){
      $yia = $this->requisicao($sql);
      $linhas = $yia->fetchArray(SQLITE3_NUM);
      if(!empty($linhas)):
        $total = count($linhas);
        return $total;
      else:
        return 0;
      endif;
    }

    public function clear($input){
      $var = filter_var($input, FILTER_SANITIZE_STRING);
      $var = htmlspecialchars($var);
      return $var;
    }
}

