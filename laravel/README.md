# Cash-Flow 

## Descrição

O **Cash-Flow** é um sistema de controle financeiro que permite o gerenciamento  de ***fluxo de caixa***, o sistema possui funcionalidades voltadas para o acompanhamento de entradas e saídas, saldo atual, visualização de movimentos por dia, mês e ano. O sistema é ideal para quem quer ter uma visão clara de quanto entra, quanto sai e para onde o dinheiro tá indo.

### Objetivo

Inicialmente o projeto foi desenvolvido como ferrmenta para uso interno da nossa equipe, mas o projeto serve para ajudar pequenos negócois, freelancers ou qualquer pessoa que quer ter controle financeiro com uma ferramenta simples, visual e de fácil uso.

---

## Funcionalidades

- Registro de receitas e despesas
- Categorias personalizadas para lançamentos
- Gráficos de desempenho
- Saldo acumulado por período
- Histórico de transações
- Filtros por data, categoira, descrição, faixa de valor e tipo de transação

---

## Tecnologias

- **Back-end:** Laravel 12
- **Front-end:** Blade, Vite, TailwindCSS, Livewire.
- **Banco de dados:** MySQL

---

## Instalação local

- **Requisitos**

- **PHP:** ^8.2
- **Node.js:** 24.11.1
- **Composer:** 2.9.2
- **npm:**  11.6.2

- **Passos**

- 1.Clone o repositório:

```bash
git clone https://github.com/joaomesq/Arrendamento-Imoveis.git
cd Arrendamento-Imoveis
```

- 2.Crie a base de dados

- 3.Faça a configuração do arquivo .env

- 4.Faça a configuração inicial do projeto através do script setu_project.py[scripts/setup_project.py]:

```bash
python scripts/setup_project.py
```

- 4.Inicie os servidores de desenvolvimento

```bash
php artisan server
```

```bash
npm run dev
```

---

## Como contribuir

Insdiponivel de momento

---

## Documentação

- [Padrões de código](docs/standards)
