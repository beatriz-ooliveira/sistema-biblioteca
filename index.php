<?php
session_start();
include_once('config.php');
print_r($_SESSION);
if((!isset($_SESSION['login'])==true) && (!isset($_SESSION['senha'])==true))
{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('Location: login.php');
	exit();
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>BiblioTech</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- <script src="assets/js/jquery.scrollex.min.js"></script> -->
	<!-- <script src="assets/js/jquery.scrolly.min.js"></script> -->
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!-- <script src="assets/js/main.js"></script> -->
	<script src="assets/js/menu.js"></script>
	<script src="assets/js/cadastro-livro.js"></script>

	<link rel="stylesheet" href="assets/css/index.css" />
	<link rel="stylesheet" href="assets/css/cadastro-livro.css" />
	<script src="assets/js/cadastro-livro.js"></script>
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body class="is-preload">
	<!-- Wrapper -->
	<div id="wrapper">
		<!-- Header -->
		<header id="header-inicio" class="alt">
			<span class="logo"><a href="index.html"><img src="images/logo.png" alt="" /></a></span>
			<div class="sair">
				<a href="sair.php"> Sair<i id="botao-sair" class="material-symbols-outlined"><span
							class="material-symbols-outlined">logout</i></a>
			</div>
		</header>

		<!-- Menu -->
		<div class="Navbar__Link-brand">
			Menu
			<div class="Navbar__Link Navbar__Link-toggle">
				<i id="icone-menu" class="material-symbols-outlined">menu</i>
			</div>

		</div>
		<!-- <div class="Navbar__Items">  -->
		<nav class="Navbar__Items">
			<div class="Navbar__Link">
				<a href="#cadastros"><i id="botao-menu" class="material-symbols-outlined"><span
							class="material-symbols-outlined">add_circle</i>Cadastro</a>
				<div class="Navbar__Link__Sub">
					<a href="cadastro-livro.html">
						<i id="botao-menu" class="material-symbols-outlined"><span
								class="material-symbols-outlined">menu_book</i>
						Livro</a>
				</div>
				<div class="Navbar__Link__Sub">
					<a href="#cadastro-livro">
						<i id="botao-menu" class="material-symbols-outlined"><span
								class="material-symbols-outlined">person</i>
						Pessoa</a>
				</div>
				<div class="Navbar__Link__Sub">
					<a href="#cadastro-livro">
						<i id="botao-menu" class="material-symbols-outlined"><span
								class="material-symbols-outlined">admin_panel_settings</i>
						Usuário</a>
				</div>
			</div>
			<div class="Navbar__Link">
				<a href="#emprestimo"><i id="botao-menu" class="material-symbols-outlined"><span
							class="material-symbols-outlined">book_4</i>Empréstimo</a>
			</div>
			<div class="Navbar__Link">
				<a href="#devolucao"><i id="botao-menu" class="material-symbols-outlined"><span
							class="material-symbols-outlined">keyboard_return</i>Devolução</a>
			</div>
			<div class="Navbar__Link">
				<a href="formularioReserva.php"><i id="botao-menu" class="material-symbols-outlined"><span
								class="material-symbols-outlined">access_time</i>Reservar</a>
			</div>
			<div class="Navbar__Link">
				<a href="#relatorios"><i id="botao-menu" class="material-symbols-outlined"><span
							class="material-symbols-outlined">monitoring</i>Relatórios</a>
			</div>
			<div class="Navbar__Link" style="background-color: red;">
				<a href="sistema.php"><i id="botao-menu" class="material-symbols-outlined"><span
							class="material-symbols-outlined">settings</i>Configurações</a>
			</div>
		</nav>

		<!-- Main -->
		<div id="main">

			<!-- Introduction -->
			<section id="intro" class="main">
				<div class="divBusca">
					<input type="text" class="txtBusca" value="" placeholder="Pesquise por autor/livro..." />
					<a classe="botao" href=""><i id="btnBusca" class="material-symbols-outlined">search</i></a>
				</div>


				<div class="card-page">
					<div class="card" style="background-color: #71a4daab;">
						<a href="#"><i id="botao-card" class="material-symbols-outlined"><span
									class="material-symbols-outlined">bubble_chart</i>Consultas</a>
					</div>
					<div id="move" class="card" style="background-color: #d18cd8ba;">
						<a href="#"><i id="botao-card" class="material-symbols-outlined"><span
									class="material-symbols-outlined">swap_horizontal_circle</i>Movimentar Acervo</a>
					</div>
					<div class="card" style="background-color: #c7d289c2;">
						<a href="#"><i id="botao-card" class="material-symbols-outlined"><span
									class="material-symbols-outlined">hourglass_top</i>Fila de Espera</a>
					</div>
				</div>
			</section>

			<!-- First Section -->
			<section id="first" class="main special">
				<header class="major">
					<h2>Últimos exemplares adicionados</h2>
				</header>
				
				<div id="NoBooks">
						<p id="emptyBookList">Nenhum livro cadastrado</p>
				</div>
				<div id="listOfAllBooks">
					
				</div>


				<!-- <script>
					document.addEventListener("DOMContentLoaded", function () {
						displayBooksFromLocalStorageCard(); // Chame a função que exibe os cards
					});
				</script> -->


						
				

			</section>
		</div>

		<!-- Footer -->
		<footer id="footer">
			<section>
				<h2>Sobre nós</h2>
				<p>Bem-vindo à nossa biblioteca virtual, um refúgio de conhecimento e imaginação! Somos mais do que um
					simples repositório de livros; somos guardiões de histórias que transportam os leitores para mundos
					desconhecidos, despertam emoções profundas e alimentam a mente com sabedoria.</p>
				<ul class="actions">
					<li><a href="sobre-nos.html" class="button">Leia mais</a></li>
				</ul>
			</section>
			<section>
				<h2>Onde nos encontrar</h2>
				<dl class="alt">
					<dt>Endereço</dt>
					<dd>Av. São Caetano, 1234, Centro &bull; Indiana, SP &bull; BR</dd>
					<dt>Celular</dt>
					<dd>(18) 99775-4401</dd>
					<dt>Email</dt>
					<dd><a href="#">contato@caminhosdaimaginacao.com.br</a></dd>
				</dl>
				<ul class="icons">
					<li><a href="#" class="icon brands fa-twitter alt"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon brands fa-facebook-f alt"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon brands fa-instagram alt"><span class="label">Instagram</span></a></li>
				</ul>
			</section>
			<p class="copyright">&copy; Desenvolvido para aula de Engenharia de Software.</p>
		</footer>

	</div>

	
	


</body>

</html>