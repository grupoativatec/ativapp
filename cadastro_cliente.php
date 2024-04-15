<?php
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['nome'])) {
    header('Location: index.php'); // Redireciona para a página de login se o usuário não estiver logado
    exit();
}

// Verifica se o botão de logout foi clicado
if (isset($_GET['logout'])) {
    // Destroi a sessão
    session_destroy();
    // Redireciona para a página de login
    header('Location: index.php?logout=true');
    exit();
}

// Função para conexão com o banco de dados e recuperação de empresas
function getEmpresasFromDatabase() {
    // Configurações de conexão ao banco de dados
    $host = "localhost";
    $user = "root"; // Substitua 'seu_usuario' pelo nome de usuário do seu banco de dados
    $senha = ""; // Substitua 'sua_senha' pela senha do seu banco de dados
    $banco = "login"; // Substitua 'seu_banco' pelo nome do seu banco de dados

    // Conexão ao banco de dados
    $conn = mysqli_connect($host, $user, $senha, $banco);

    // Verifique se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Consulta ao banco de dados
    $sql = "SELECT * FROM empresas";
    $result = mysqli_query($conn, $sql);

    // Fechar conexão com o banco de dados
    mysqli_close($conn);

    return $result;
}

// Função para recuperar as equipes do banco de dados
function getEquipesFromDatabase() {
    // Configurações de conexão ao banco de dados
    $host = "localhost";
    $user = "root"; // Substitua 'seu_usuario' pelo nome de usuário do seu banco de dados
    $senha = ""; // Substitua 'sua_senha' pela senha do seu banco de dados
    $banco = "login"; // Substitua 'seu_banco' pelo nome do seu banco de dados

    // Conexão ao banco de dados
    $conn = mysqli_connect($host, $user, $senha, $banco);

    // Verifique se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Consulta ao banco de dados
    $sql = "SELECT * FROM equipes_ativa";
    $result = mysqli_query($conn, $sql);

    // Array para armazenar as equipes
    $equipes = [];

    // Loop através dos resultados e armazenar as equipes no array
    while ($row = mysqli_fetch_assoc($result)) {
        // Crie uma string com as informações da equipe
        $equipe_info = $row['analista_responsavel'];
        // Adicione a string ao array de equipes
        $equipes[] = $equipe_info;
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conn);

    return $equipes;
}
// Função para recuperar os países do banco de dados
function getPaisesFromDatabase() {
    // Configurações de conexão ao banco de dados
    $host = "localhost";
    $user = "root"; // Substitua 'seu_usuario' pelo nome de usuário do seu banco de dados
    $senha = ""; // Substitua 'sua_senha' pela senha do seu banco de dados
    $banco = "login"; // Substitua 'seu_banco' pelo nome do seu banco de dados

    // Conexão ao banco de dados
    $conn = mysqli_connect($host, $user, $senha, $banco);

    // Verifique se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Consulta ao banco de dados para recuperar os países
    $sql = "SELECT nome_pt FROM pais";
    $result = mysqli_query($conn, $sql);

    // Array para armazenar os países
    $paises = [];

    // Loop através dos resultados e armazenar os países no array
    while ($row = mysqli_fetch_assoc($result)) {
        // Adicione o nome do país ao array de paises
        $paises[] = $row['nome_pt'];
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conn);

    return $paises;
}
// Função para recuperar os estados do banco de dados
function getEstadosFromDatabase() {
    // Configurações de conexão ao banco de dados
    $host = "localhost";
    $user = "root"; // Substitua 'seu_usuario' pelo nome de usuário do seu banco de dados
    $senha = ""; // Substitua 'sua_senha' pela senha do seu banco de dados
    $banco = "login"; // Substitua 'seu_banco' pelo nome do seu banco de dados

    // Conexão ao banco de dados
    $conn = mysqli_connect($host, $user, $senha, $banco);

    // Verifique se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Consulta ao banco de dados para recuperar os estados
    $sql = "SELECT CONCAT(nome_estado, ', ', uf_estado) AS estado FROM estado";
    $result = mysqli_query($conn, $sql);

    // Array para armazenar os estados
    $estados = [];

    // Loop através dos resultados e armazenar os estados no array
    while ($row = mysqli_fetch_assoc($result)) {
        // Adicione o nome do estado ao array de estados
        $estados[] = $row['estado'];
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conn);

    return $estados;
}
function getCidadesFromDatabase() {
    // Configurações de conexão ao banco de dados
    $host = "localhost";
    $user = "root"; // Substitua 'seu_usuario' pelo nome de usuário do seu banco de dados
    $senha = ""; // Substitua 'sua_senha' pela senha do seu banco de dados
    $banco = "login"; // Substitua 'seu_banco' pelo nome do seu banco de dados

    // Conexão ao banco de dados
    $conn = mysqli_connect($host, $user, $senha, $banco);

    // Verifique se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Erro na conexão: " . mysqli_connect_error());
    }

    // Consulta ao banco de dados para recuperar os estados
    $sql = "SELECT CONCAT(nome, ', ', uf) AS estado FROM estado";
    $result = mysqli_query($conn, $sql);

    // Array para armazenar os estados
    $estados = [];

    // Loop através dos resultados e armazenar os estados no array
    while ($row = mysqli_fetch_assoc($result)) {
        // Adicione o nome do estado ao array de estados
        $estados[] = $row['estado'];
    }

    // Fechar conexão com o banco de dados
    mysqli_close($conn);

    return $estados;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo Ativa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/stylecadastroempresa.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a href="sucesso.php" class="sair-link"> <!-- Adicione a classe sair-link para posicionar a imagem -->
			<img src="img/voltar.png" alt="voltar" width="40" height="40";>
		</a>
		<span class="span-voltar";>| MENU PRINCIPAL</span> <!-- Adicione o texto ao lado da imagem -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<img class="logout-img" src="img/sair.png" onclick="location.href='logout.php';">
				</li>
			</ul>
	</nav>          
    
    <div class="container mt-4">
        
    <h2>CADASTRO</h2>
    <form method="POST">
    <div class="form-row">
    <div class="form-group col-md-6">
        <label for="nome">NOME:</label>
        <input type="text" id="nome" name="nome" class="form-control" required="">
    </div>
    <div class="form-group col-md-6">
        <label for="cnpj">CNPJ:</label>
        <input type="text" id="cnpj" name="cnpj" class="form-control" required="">
    </div>
    <div class="form-group col-md-6">
        <label for="nome">Analista responsável:</label>
            <select id="equipe" name="equipe" class="form-control" required="">
    <option value="" disabled="" selected="">Selecione um analista</option>
    <?php
    // Chama a função para recuperar as equipes do banco de dados
    $equipes = getEquipesFromDatabase();

    // Loop através das equipes e imprimir as opções
    foreach ($equipes as $equipe) {
        echo "<option value=\"$equipe\">$equipe</option>";
    }
    ?>
    </select>
    </div>

    <div class="form-group col-md-6">
    <label for="aniversario_empresa">Aniversário Empresa:</label>
    <input type="date" id="aniversario_empresa" name="aniversario_empresa" class="form-control">
    </div>
</div>
<div class="form-group">
    <label>Serviços:</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="servico_ativadespachos" name="servico_ativadespachos">
        <label class="form-check-label" for="servico_ativadespachos">Ativa Despachos</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="servico_juridico" name="servico_juridico">
        <label class="form-check-label" for="servico_juridico">Serviço Jurídico</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="servico_aiyra" name="servico_aiyra">
        <label class="form-check-label" for="servico_aiyra">Aiyra</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="servico_oplog" name="servico_oplog">
        <label class="form-check-label" for="servico_oplog">Oplog</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="servico_contabilidade" name="servico_contabilidade">
        <label class="form-check-label" for="servico_contabilidade">Contabilidade</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="servico_apoema" name="servico_apoema">
        <label class="form-check-label" for="servico_apoema">Apoema</label>
    </div>
</div>
<div class="form-group">
        <label for="pais_empresa">País Empresa:</label>
        <select id="pais_empresa" name="pais_empresa" class="form-control">
            <option value="" disabled selected>Selecione um país</option>
            <?php
            // Chama a função para recuperar os países do banco de dados
            $paises = getPaisesFromDatabase();

            // Loop através dos países e imprimir as opções
            foreach ($paises as $pais) {
                echo "<option value=\"$pais\">$pais</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="estado_empresa">Estado Empresa:</label>
        <select id="estado_empresa" name="estado_empresa" class="form-control">
            <option value="" disabled selected>Selecione um estado</option>
            <?php
            // Chama a função para recuperar os estados do banco de dados
            $estados = getEstadosFromDatabase();

            // Loop através dos estados e imprimir as opções
            foreach ($estados as $estado) {
                echo "<option value=\"$estado\">$estado</option>";
            }
            ?>
        </select>
    </div>
<div class="form-group">
    <label for="cidade_empresa">Cidade Empresa:</label>
    <input type="text" id="cidade_empresa" name="cidade_empresa" class="form-control">
</div>
<div class="form-group">
    <label for="endereco_empresa">Endereço Empresa:</label>
    <input type="text" id="endereco_empresa" name="endereco_empresa" class="form-control">
</div>
<div class="form-group">
    <label for="bairro_empresa">Bairro Empresa:</label>
    <input type="text" id="bairro_empresa" name="bairro_empresa" class="form-control">
</div>
<div class="form-group">
    <label for="numeroend_empresa">Número Empresa:</label>
    <input type="text" id="numeroend_empresa" name="numeroend_empresa" class="form-control">
</div>
<div class="form-group">
    <label for="cep_empresa">CEP Empresa:</label>
    <input type="text" id="cep_empresa" name="cep_empresa" class="form-control">
</div>
<div class="form-group">
    <label for="telefone_empresa">Telefone Empresa:</label>
    <input type="text" id="telefone_empresa" name="telefone_empresa" class="form-control" required="">
</div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="empresas.php" class="btn btn-secondary">Voltar</a>

    </div></form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
        $(document).ready(function() {
            // Feche os pop-ups de mensagem ao clicar no botão Fechar
            $('.alert .close').on('click', function() {
                $(this).parent().fadeOut('fast');
            });

            // Feche os pop-ups automaticamente após alguns segundos (opcional)
            setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 1000);  // Feche após 1 segundo (ajuste conforme necessário)
        });
    </script>
    <script>
    let timer;

    document.body.addEventListener('mousemove', function(){
        clearTimeout(timer);
        timer = setTimeout(function(){
            window.location.href = "/logout";  // redireciona para a rota de logout
        }, 300000);  // 300000 milissegundos (5 minutos)
    });
    </script>

</div></body></html>