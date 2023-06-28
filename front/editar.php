<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edição de Empregados</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
        #resultado {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }
        #header {
            position: relative;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 10px;
            padding-bottom: 35px;
        }


        .nav-button {
            padding: 20px 35px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: auto;
        }


        .nav-button1:hover,.nav-button2:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php

    ?>
    <div class="container">
        <div id="header" align="center">
          <button class="nav-button" onclick="window.location.href='index.html'">Cadastro</button>
          <button class="nav-button" onclick="window.location.href='listagem.html'">Listagem</button>
        </div>
    </div>
    <br />
    <div class="container">
        <h1>Edição de Empregados</h1>
        <form id="empregado-form">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" required>
            
            <label for="setor">Setor:</label>
            <input type="text" id="setor" required>
            
            <button type="submit">Atualizar</button>
        </form>

        <div id="resultado"></div>
    </div>

    <script>
    document.getElementById('empregado-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var id = <?php echo $_GET['id']; ?>;
        var nome = document.getElementById('nome').value;
        var email = document.getElementById('email').value;
        var setor = document.getElementById('setor').value;
        
        var xhr = new XMLHttpRequest();
        xhr.open('PUT', 'http://localhost/crudrest/api/editar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    document.getElementById('resultado').textContent = xhr.responseText;
                } else {
                    document.getElementById('resultado').textContent = 'Erro ao atualizar empregado.' + xhr.responseText;
                }
            }
        };

        var data = JSON.stringify({ id: id, nome: nome, email: email, setor: setor });
        xhr.send(data);
    });
    window.onload = function() {
    var id = <?php echo $_GET['id']; ?>;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/crudrest/api/lerunico.php?id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var empregado = JSON.parse(xhr.responseText);
                document.getElementById('nome').value = empregado.nome;
                document.getElementById('email').value = empregado.email;
                document.getElementById('setor').value = empregado.setor;
            } else {
                document.getElementById('resultado').textContent = 'Erro ao carregar dados do empregado.' + xhr.responseText;
            }
        }
    };
    xhr.send();
};

    </script>
</body>
</html>
