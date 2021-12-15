Trabalho 2 de programação web II

Alunos: Beatriz Auer Mariano e Mateus Maioli Giacomin
Segmento: Sistema extra-simplificado de um hortifrúti - Pomar Hortifrúti
Criptografia de senha escolhida: MD5

Filtros de sanitização escolhidos:
                    A) TELAS DE CADASTRO
__________________________________________________________________
|      tela      |                    filtros                    |
|________________|_______________________________________________|
| fornecedores   | strings (special chars), email e inteiros     |
|________________|_______________________________________________|
| clientes       | strings (special chars), email e inteiros     |
|________________|_______________________________________________|
| produtos       | strings (special chars), float e inteiros     |
|________________|_______________________________________________|
| vendas         | strings (special chars) e inteiros            |
|________________|_______________________________________________|
| cadernetas     | strings (special chars) e float               |
|________________|_______________________________________________|

Filtros de validação escolhidos:
                    A) TELAS DE CADASTRO
__________________________________________________________________
|      tela      |                    filtros                    |
|________________|_______________________________________________|
| fornecedores   | email e inteiros                              |
|________________|_______________________________________________|
| clientes       | email e inteiros                              |
|________________|_______________________________________________|
| produtos       | inteiros e float                              |
|________________|_______________________________________________|
| vendas         | inteiros e float                              |
|________________|_______________________________________________|
| cadernetas     | inteiros e float                              |
|________________|_______________________________________________|

                    B) TELAS DE CONSULTA
__________________________________________________________________
|      tela      |                    filtros                    |
|________________|_______________________________________________|
| fornecedores   | inteiro                                       |
|________________|_______________________________________________|
| clientes       | inteiro                                       |
|________________|_______________________________________________|
| produtos       | float                                         |
|________________|_______________________________________________|
| vendas         | inteiro                                       |
|________________|_______________________________________________|
| cadernetas     | float                                         |
|________________|_______________________________________________|

> Usamos máscara para alguns campos do formulário de cadastro de clientes e fornecedores.
  Para isso, utilizamos o plugin para JQuery (Jquery Mask Plugin) desenvolvido por Igor Escobar.
  A documentação do plugin pode ser encontrada aqui: https://igorescobar.github.io/jQuery-Mask-Plugin/
  Para a implementação, seguimos o tutorial: https://www.youtube.com/watch?v=U9504YniAFE