# Sistema de Lista de Tarefas

Sistema Web simples para cadastro e gerenciamento de tarefas, desenvolvido como teste prático para vaga de estágio.

## Publicação da Aplicação

A aplicação foi publicada em um servidor gratuito com suporte a PHP, pois o GitHub Pages não executa código PHP nem permite uso de banco de dados SQL.

Como o sistema utiliza PHP no backend e persistência de dados em banco de dados SQL (SQLite), foi necessário utilizar um ambiente que ofereça suporte a essas tecnologias, atendendo integralmente aos requisitos do edital.

Link da aplicação online (clique o link abaixo para abrir o projeto):
https://lista-tarefas.infinityfreeapp.com

## Funcionalidades
- Listagem de tarefas ordenadas por ordem de apresentação
- Inclusão de nova tarefa
- Edição de tarefa existente
- Exclusão de tarefa com confirmação
- Reordenação das tarefas (subir e descer)
- Destaque visual para tarefas com custo maior ou igual a R$ 1.000,00 (a linha inteira fica  com o fundo amarelo)
- Exibição do total dos custos das tarefas

## Tecnologias Utilizadas
- PHP
- HTML
- CSS
- Banco de dados SQL (SQLite)

## Regras de Execução
- Não permite tarefas com nomes duplicados
- Custo deve ser maior ou igual a zero
- Data limite obrigatória
- Identificador gerado automaticamente
- Ordem de apresentação controlada pelo sistema

