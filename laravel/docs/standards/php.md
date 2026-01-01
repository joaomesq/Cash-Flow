# Padrão de Código PHP/Laravel

## Convenções
- Seguir **PSR-12** como base.
- Nome de casses em **StudlyCase** (ex: `UserController`)
- Nome de métodos em **camelCase** (ex: `resumoMensal`)
- Variáveis em **camelCase** (ex: `$descricao`, `$valorMensal`)
- Constantes em **UPPER_CASE**

## Estrutura das Models
- Models no singular (`Usuario`)
- Usar **snake_case** para nomes de colunas
- Relacionamento claros:
  - `Transacao` pertence a um Usuário.
  
## Exemplo
```php
class Transacao extends Model
{
    protected $table = 'transacoes';

    //Relacionamento
    public function user(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
```