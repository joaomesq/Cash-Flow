# Padrão de Código PHP/Laravel

## Convenções
- Seguir **PSR-12** como base.
- Nome de casses em **StudlyCase** (ex: `UserController`)
- Nome de métodos em **camelCase** (ex: `criarImovel`)
- Variáveis em **camelCase** (ex: `$descricao`, `$valorMensal`)
- Constantes em **UPPER_CASE**

## Estrutura das Models
- Models no singular (`Usuario`)
- Usar **snake_case** para nomes de colunas
- Relacionamento claros:
  - `Usuario` pode ser **locador/proprietario**(possui imoveis) ou **locatário**(possui contratos, arrenda imóveis).
  - `Imovel` pertence a um locador.
  - `ImagemImovel` pertence a um imóvel, imovel possui várias imagens

## Exemplo
```php
class Imovel extends Model
{
    protected $table = 'imoveis';

    //Relacionamento
    public function proprietario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function imagens(){
        return $this->hasMany(ImagemImovel::class);
    }
}
```