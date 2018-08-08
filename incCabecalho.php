<!DOCTYPE html>
<html>
    <head>
        <title>TechNooB</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilo.css" type="text/css" />
        <script type="text/javascript" src="jquery-2.1.3.js"></script>
        <script type="text/javascript" src="funcao.js"></script>
        <script type="text/javascript" src="slider/bjqs-1.3.js"></script>
        <script type="text/javascript" src="slider/libs/jquery.secret-source.min.js"></script>
    </head>
    <body>
        <div class="top">
            <div class="cabecalho">
                <a href="index.php"><input class="logo" type="image" src="imagem/logo.png" value="Logo" /></a>
                <a href="https://www.facebook.com/realTechNoob"><input class="iconFace" type="image" src="imagem/iconFace.png" value="Facebook" /></a>
                <a href="https://www.twitter.com/"><input class="iconTwitter" type="image" src="imagem/iconTwitter.png" value="Twitter" /></a>
                <a href="https://www.youtube.com/"><input class="iconYoutube" type="image" src="imagem/iconYoutube.png" value="Youtube" /></a>
                <form name="pesquisa" action="buscaResult.php" method="post">
                <input class="searchText" type="text" name="palavra" id="searchInput">
                <input class="iconPesquisar" type="image" name="btnbusca" src="imagem/iconPesquisar.png" value="submit" required="required">
                </form>
            </div>

            <nav id="menu">
                <ul>
                    <li><a href='index.php'><span>HOME</span></a></li>
                    <li><a href='pagCategoriaGames.php'>GAMES</a></li>
                    <li><a href='pagCategoriaTecnologia.php'>TECNOLOGIA</a></li>
                    <li><a href='pagCategoriaMobile.php'>MOBILE</a></li>
                    <li><a href='contatos.php'>Contato</a></li>
                </ul>
            </nav>
        </div>