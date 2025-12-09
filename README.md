# ProjetoPHP
Projeto PHP (Formulário) de uma Gestão Escolar nomeada "EEEP Raio de Luz".

Sistema web simples, feito para gerenciar cadastros de alunos da escola. Tem autenticação (registro/login), formulário de cadastro completo, painel com cartões e gráficos que mostram estatísticas (alunos por curso, cidade, média de idade, bairros) e uma tabela com relatório completo. Personalizado na cor roxa, para manter o padrão da cor da instituição fictícia. 
O objetivo é didático: mostrar como integrar PHP + MySQL com Bootstrap, gerando relatórios e gráficos para análise.

<img width="486" height="346" alt="tablesql" src="https://github.com/user-attachments/assets/5d9def35-bfeb-42e0-9297-409af7861c6d" />

Essa imagem mostra a tabela criada no MySQL, com todas as colunas que o sistema usa. Ela confirma que o banco está estruturado corretamente e é onde ficam armazenados os dados dos alunos. Sem essa tabela o sistema não teria onde salvar nada.

<img width="1914" height="936" alt="home" src="https://github.com/user-attachments/assets/9f63e0e4-2bb2-4a54-8b6d-4ae3e3d1aebc" />

Essa é a tela inicial do sistema, pensada para o funcionário da gestão escolar. Ela serve como menu principal, permitindo acessar as funções do sistema de forma rápida: cadastro de alunos, listagem e painel de estatísticas. Essa página organiza a navegação e garante que o usuário consiga chegar em qualquer parte do sistema sem confusão. Também é daqui que o funcionário inicia o uso do sistema depois de fazer cadastro.

<img width="1919" height="930" alt="cadastro" src="https://github.com/user-attachments/assets/4688d3d9-7247-4f8a-b11e-c7812a5ad8c9" />

Aqui a gestão pode registrar professores, funcionários da secretaria ou qualquer pessoa que precise acessar o painel e as funções internas. Quando o formulário é enviado, o sistema valida os dados, cria o usuário no banco e aplica segurança, como a senha. Esse cadastro garante que cada funcionário tenha seu próprio login, permitindo controle de acesso, rastreamento de ações e organização interna do sistema. É uma parte fundamental para manter o painel restrito apenas a quem realmente faz parte da administração da escola.

<img width="1906" height="945" alt="painel1" src="https://github.com/user-attachments/assets/f6326535-93b2-414f-8d67-15ab15380d39" />

<img width="1903" height="944" alt="painel2" src="https://github.com/user-attachments/assets/d12c6b03-7ce1-4c33-af60-1965f0fe82fd" />

O painel reúne todas as informações dos alunos e apresenta esses dados de forma simples, usando gráficos e indicadores fáceis de entender. Apenas usuários da gestão que estão logados podem acessá-lo. Com base nas informações armazenadas no sistema, ele gera contadores, comparações e distribuições, como o número de alunos por curso, bairro, cidade, faixa etária e outros detalhes importantes para administrar a escola. Os dois gráficos que aparecem nas imagens fazem parte desse painel e, juntos, dão uma visão geral da situação atual dos alunos. Essa ferramenta ajuda professores, coordenação e secretaria a acompanhar tendências, planejar ações e identificar o que precisa ser feito. É o espaço onde a equipe de gestão analisa os dados cadastrados e toma decisões com base neles.

<img width="1918" height="938" alt="cadastro_aluno" src="https://github.com/user-attachments/assets/bb3082e2-d028-4ea6-82fc-550145926e74" />

Essa imagem mostra o formulário onde o funcionário registra um aluno no sistema. Tudo que for preenchido aqui é enviado para um script PHP que valida e salva no banco. É a tela mais importante do fluxo de dados, porque é ela que alimenta toda a base de informações da escola. Se um aluno é cadastrado, editado ou atualizado, tudo começa por esse formulário. Depois que o aluno é salvo, ele automaticamente aparece na lista e influencia os gráficos do painel.

<img width="1919" height="936" alt="lista_alunos" src="https://github.com/user-attachments/assets/327fe6d2-3e48-4d57-93d5-183e676f0367" />

Aqui a gestão consegue ver todos os alunos cadastrados no sistema. A tabela mostra informações básicas como nome, cidade e curso, além das ações de editar e excluir ao lado de cada aluno. A busca e os filtros ajudam a encontrar alunos específicos, seja por nome, curso ou cidade. Essa página funciona como o centro de controle da gestão: é onde o funcionário monitora, acessa e administra rapidamente todos os registros armazenados no banco.

<img width="1905" height="940" alt="editar" src="https://github.com/user-attachments/assets/fb98f662-de14-4b97-a20c-6cb77f006492" />

Essa tela permite que a gestão atualize os dados de um aluno já cadastrado no sistema. O formulário vem preenchido automaticamente com as informações que já estão no banco, e o usuário pode alterar qualquer campo, como endereço, responsável, curso ou data de nascimento. Quando o funcionário clica em “Salvar Alterações”, o sistema envia tudo para o PHP, que valida e atualiza a linha correta no banco de dados. Essa página garante que a escola mantenha o cadastro sempre correto e atualizado, evitando erros ou dados antigos.

<img width="1913" height="941" alt="excluir" src="https://github.com/user-attachments/assets/41f5fbe9-55a9-4594-a06f-1afef4fe3574" />

Essa página é uma confirmação antes de apagar um aluno. Ela mostra o nome do aluno selecionado e pergunta se o funcionário realmente quer excluir. Ao clicar em “Excluir”, o sistema remove aquele registro do banco de dados de forma definitiva. Esse tipo de confirmação existe para evitar que alguém apague um aluno por engano. É uma função comum em sistemas de gestão, principalmente quando envolve dados importantes.

Depois que o usuário tiver feito tudo o que precisava no site, ele apenas clica em logout e volta para a tela de login.

