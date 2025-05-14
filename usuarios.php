<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
        <style>
            /* Estilos básicos para o painel em modo escuro */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #121212; /* Fundo preto */
                color: #f4f4f9; /* Texto claro */
                display: flex;
            }

            .sidebar {
                width: 250px;
                background-color: #1e1e1e; /* Cinza escuro */
                height: 100vh;
                padding: 20px;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            }

            .sidebar h2 {
                color: #ffcc00; /* Amarelo */
                margin-bottom: 20px;
            }

            .sidebar a {
                display: block;
                color: #f4f4f9;
                text-decoration: none;
                margin-bottom: 10px;
                padding: 10px;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .sidebar a:hover {
                background-color: #ffcc00; /* Amarelo */
                color: #121212; /* Preto */
            }

            .content {
                flex: 1;
                padding: 20px;
            }

            .navbar {
                background-color: #1e1e1e; /* Cinza escuro */
                color: #f4f4f9;
                padding: 15px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .navbar h1 {
                margin: 0;
                font-size: 24px;
                color: #ffcc00; /* Amarelo */
            }

            .navbar form {
                margin: 0;
            }

            .navbar button {
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                background-color: #ffcc00; /* Amarelo */
                color: #121212; /* Preto */
                font-weight: bold;
            }

            .navbar button:hover {
                background-color: #e6b800; /* Amarelo mais escuro */
            }

            .chart-container {
                margin-bottom: 20px;
                background-color: #1e1e1e; /* Cinza escuro */
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
                max-width: 600px; /* Reduz o tamanho do gráfico */
                margin: 0 auto; /* Centraliza o gráfico */
            }

            .chart-container h2 {
                color: #ffcc00; /* Amarelo */
                text-align: center;
            }

            .card {
                background-color: #1e1e1e; /* Cinza escuro */
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
                padding: 20px;
                margin-bottom: 20px;
                color: #f4f4f9;
            }

            .card h2 {
                margin-top: 0;
                color: #ffcc00; /* Amarelo */
            }

            .status-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            .status-container label {
                font-size: 18px;
                font-weight: bold;
            }

            .status-container button {
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                background-color: #ffcc00; /* Amarelo */
                color: #121212; /* Preto */
                font-weight: bold;
            }

            .status-container button:hover {
                background-color: #e6b800; /* Amarelo mais escuro */
            }

            .table thead {
            background-color: #1c1c1c; /* fundo escuro */
            color: #ffc107; /* amarelo (igual ao menu) */
            }

            /* Estiliza as células da tabela */
            .table tbody tr td {
            color: #fff;
            background-color: #121212;
            }

            .botao-destaque {
            background-color: transparent;
            color: #f4f4f9;
            border: 2px solid #ffcc00;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            font-weight: bold;
            }

            .botao-destaque:hover {
                background-color: #ffcc00;
                color: #121212;
            }
        </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
            <h2>Menu</h2>
            <a href="painel.php">Dashboard</a>
            <a href="usuarios.php">Usuários</a>
            <a href="#">Controle de Acesso</a>
            <a href="#">Relatórios</a>
            <a href="index.php">Sair</a>
        </div>

    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <!-- Espaço -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  
                  <div class="col-9">
                    <h3 class="card-title">Usuários</h3>
                  </div>
                  
                  <div class="col-3" align="right">
                  <button type="button" class="botao-destaque" data-toggle="modal" data-target="#novoUsuarioModal">
                        Novo Usuário
                    </button>
                  </div>

                </div>
              </div>

              

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-dark-custom" id="tabela">
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Placa do Veículo</th>
                      <th>Nome</th>
                      <th>Login</th>
                      <th>Ativo</th>                
                      <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php echo listaUsuario(); ?>
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

      <div class="modal fade" id="novoUsuarioModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h4 class="modal-title">Novo Usuário</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="php/salvarUsuario.php?funcao=I" enctype="multipart/form-data">              
                
                <div class="row">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="iNome">Nome:</label>
                      <input type="text" class="form-control" id="iNome" name="nNome" maxlength="50">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label for="iNome">Empresa:</label>
                      <select name="nEmpresa" class="form-control" required>
                      </select>
                    </div>
                  </div>

                  <div class="col-8">
                    <div class="form-group">
                      <label for="iLogin">Login:</label>
                      <input type="email" class="form-control" id="iLogin" name="nLogin" maxlength="50">
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label for="iSenha">Senha:</label>
                      <input type="text" class="form-control" id="iSenha" name="nSenha" maxlength="6">
                    </div>
                  </div>
                
                  <div class="col-12">
                    <div class="form-group">
                      <label for="iFoto">Foto:</label>
                      <input type="file" class="form-control" id="iFoto" name="Foto" accept="image/*">
                    </div>
                  </div>
                
                  <div class="col-12">
                    <div class="form-group">
                      <input type="checkbox" id="iAtivo" name="nAtivo">
                      <label for="iAtivo">Usuário Ativo</label>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>CEP</label>
                      <input required name="CEP" type="text" class="form-control cep">
                    </div>
                  </div>
                  
                  <div class="col-9">
                    <div class="form-group">
                      <label>Endereço</label>
                      <input required name="Endereco" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label>Número</label>
                      <input required name="Numero" type="text" maxlength="8" class="form-control">
                    </div>
                  </div>

                  <div class="col-9">
                    <div class="form-group">
                      <label>Complemento</label>
                      <input name="Complemento" type="text" maxlength="50" class="form-control">
                    </div>
                  </div>

                  <div class="col-5">
                    <div class="form-group">
                      <label>Bairro</label>
                      <input required name="Bairro" type="text" class="form-control">
                    </div>
                  </div>
                  
                  <div class="col-5">
                    <div class="form-group">
                      <label>Cidade</label>
                      <input required name="Cidade" type="text" class="form-control">
                    </div>
                  </div>

                  <div class="col-2">
                    <div class="form-group">
                      <label>UF</label>
                      <input required name="UF" type="text" class="form-control">
                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-success">Salvar</button>
                </div>
                
              </form>

            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- JS -->
<?php include('partes/js.php'); ?>
<!-- Fim JS -->

<script>
  $(function () {
    $('#tabela').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>