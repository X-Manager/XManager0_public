<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">


.rating1 {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #BEBEBE;
	background-color: #FFC;
}

.rating2 {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #00FF00;
	background-color: #FFC;
}

.rating3 {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #0000FF;
	background-color: #FFC;
}

.rating4 {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFFF00;
	background-color: #FFC;
}

.rating5 {
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FF0000;
	background-color: #FFC;
}

.TabelaRodadaTitulo {
	background-color: #003300;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFF;
	font-size: 12px;
}

.TabelaRodadaLinha {
	font-size: 12px;
	background-color: #FFC;
	color: #000000;
	text-align: center;
}

.TabelaRodadaLinha td {
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #000;
}

.TabelaRodadaLinha a {
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #FF0000;
	font-weight: bold;
}

.TabelaRodadaLinha a:hover {
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #00FF00;
	font-weight: bold;
}


.Botoes  {     
    border: 1px solid #777;
    width: 120px; 
    height: 50px;
    background-color: #8D8D8D;/* /*#191970;  #17507E*/
	text-align: center;
    vertical-align: center;
	font-size: 12px;
	font-family: Georgia, "Times New Roman", Times, serif;
} 

.Botoes:hover   {     
    border: 1px solid #777;
    background: #191970; 
    width: 120px; 
    height: 50px;
    text-align: center;
    vertical-align: center;
	font-size: 12px;
	font-family: Georgia, "Times New Roman", Times, serif;
} 


.NoticiaTitle {
    border: 1px solid #111111;
    background-color: 	#3B3B3B;
	color: #FFFFFF;

    border: 1px solid #777;
    border: 1px;
    width: 2000px;
	font-size: 18px;
    font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
}

.NoticiaValor {
    border: 1px solid #111111;
    color: #222222;
	font-size: 12px;
    text-align: left;
    width: 2000px;
	font-family: Georgia, "Times New Roman", Times, serif;
    background-color: #FFC;
    margin: 4px 4px;
}

.NoticiaValor a {
    color: #00FF00;
}

.NoticiaTitle2 {
    border: 1px solid #111111;
    color: #FC0;
    background-color: #191970;
	font-size: 12px;
    text-align: left;
    width: 2000px;
	font-family: Georgia, "Times New Roman", Times, serif;

}

.NoticiaValor b {
color: #FF0000;
}

</style>
</head>

<body>


<p>
    <table width="100%">
    <tr>
        <th valign="top" align="left" border="1px" width="10%">
            <table>

            <tr><th class="Botoes" width="100%">
            <a href="index.php?f=Home&g=Inicio" title="Inicio">
            Início
            </a>
            </th></tr>
            
            <tr><th class="Botoes" width="100%">
            <a href="index.php?f=Home&g=Manual" title="Manual">
            Manual
            </a>
            </th></tr>

            <tr><th class="Botoes" width="100%">
            <a href="index.php?f=Home&g=FAQ" title="Dúvidas frequentes">
            FAQ
            </a>
            </th></tr>

            <tr><th class="Botoes" width="100%">
            <a href="index.php?f=Home&g=OBJ" title="Objetivos">
            Objetivos do projeto
            </a>
            </th></tr>
            


            <tr><th class="Botoes" width="100%">
            <a href="index.php?f=Home&g=QS" title="Quem somos">
            Quem somos
            </a>
            </th></tr>
            
            <tr><th class="Botoes" width="100%">
            <a href="index.php?f=Home&g=Contato" title="Contato">            
            Contato
            </a>
            </th></tr>


            </table>
        </th>

        <th valign="top" width="70%" align="center">
            <table widht="100%" align="center">

<?php


if (!array_key_exists('g',$_GET)) {
    $_GET['g'] = 'none';
}



switch ($_GET['g']) {
    default:case 'Inicio':
?>
            <tr><th class="NoticiaTitle" width="100%" align="left">Bem vindo!</th></tr>

            <tr><th class="NoticiaValor" width="100%" height="100" valign="top">

Bem-vindo ao novo modelo de simulação empresarial do Brasil, o <b>X-Manager</b>.<p>
Neste simulador, você se torna proprietário de uma empresa virtual, a qual deve comandar
com o intuito de obter a maior cotação de venda.
Além do aprendizado, aliado à diversão e novas amizades, você poderá ganhar
prêmios.
Também, através do sistema de ranking, poderá ser indicado para trabalhar
em empresas que necessitam de um profissional com nível diferenciado de
conhecimento.<p>

Aproveite esta oportunidade e torne-se um <b>X-Manager</b>.<p>
Cadastre-se grátis e entre para o mundo dos negócios!
            </th></tr>


            <tr><th class="NoticiaTitle" width="100%" align="left"> Notícias</th></tr>

            <?php
                include_once ("config.php");
                include_once ("maniadb.php");

                $db = new maniadb;
                $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
                $db->select($GLOBALS['mydb']);

                $db->query("SELECT Titulo, Texto FROM noticias ORDER BY id DESC");

                while ($row = $db->nextRow()) {
                    echo '<tr><th class="NoticiaTitle2" width="100%" align="left">'.$row['Titulo'].'</th></tr>';
                    echo '<tr><th class="NoticiaValor" width="100%" valign="top">'.$row['Texto'].'</th></tr>';
                }

                $db->close();
                break;
            ?>
<?php

    case 'Manual':
		echo '<tr><th class="NoticiaTitle" width="100%" align="left">';
        echo '<iframe src="manual.pdf" width="100%" height="500" valign="top" margin="0" border="0"> </iframe>';
		echo '</th></tr>';
		echo '<tr><th class="NoticiaValor" width="100%" align="left">';		
		echo 'Link para download: <a href="manual.pdf"> Manual</a>';
		echo '</th></tr>';
    break;

    case 'QS':
?>
 <tr><th class="NoticiaTitle" width="100%" align="left"> Quem somos</th></tr>
<tr><th class="NoticiaValor" width="100%" valign="top">
O <b>X-Manager</b> surgiu a partir de uma parceria entre Huiran Fornazieri e Péricles
Lopes Machado, após a constatação da grande demanda existente em torno
de jogos de simulação empresarial no Brasil. Por apreciarem o assunto,
desenvolveram o <b>X-Manager</b>, com muita paixão e empenho, para
proporcionar uma experiência única aos usuários. <p>

<b>Huiran Fornazieri:</b> Formado em Engenharia Agrícola pela URI Campus de
Erechim, ingressou no mundo dos jogos de negócios em 2010 quando chegou
até a segunda fase do Desafio Sebrae 2010 no estado do Rio Grande do Sul.
Em 2011 participou novamente do Desafio Sebrae, dessa vez consagrando-se
campeão estadual pelo RS com a equipe Express Bike (Alessandro Konzen,
Fernanda Copatti, Huiran Fornazieri, Mauricio Alves e Teilor Kalinovski). Em
2012 com a equipe Já Eras Manolo (André Manfron, Guilherme Galina Loch,
Huiran Fornazieri, Lucas Molossi e Renan Manfron) participou do GMC e
conquistou o 5º lugar na final nacional. <p>

<b>Péricles Lopes Machado:</b> Formado em Engenharia da Computação pela Universidade
Federal do Pará em 2011 e mestrando em Engenharia Elétrica pela mesma instituição.
Foi finalista nacional da maratona de programação três vezes (2008, 2009, 2010).
<p>

</th></tr>

<?php
    break;

    case 'Contato':
?>

<tr><th class="NoticiaTitle" width="100%" align="left"> Contato</th></tr>
<tr><th class="NoticiaValor" width="100%" valign="top">
<li>Huíran Fornazieri (godhug[at]gmail.com)</li>
<li>Péricles Lopes Machado (pericles.raskolnikoff[at]gmail.com)</li>
</th></tr>

<?php
    break;
    case 'FAQ':
?>
<tr><th class="NoticiaTitle" width="100%" align="left"> FAQ</th></tr>
<tr><th class="NoticiaValor" width="100%" valign="top">
<li> Quem pode participar do <b>X-Manager</b>?</li><p>
R: Qualquer pessoa que possua um CPF válido, maior de 16 anos.<p>
<p>
<li> Posso formar uma equipe?</li><p>
R: Não. Como o <b>X-Manager</b> utiliza um ranking para promover talentos, a
formação de equipes iria mascarar a aferição de desempenho de cada
componente.<p>
<p>
<li> Preciso pagar para me cadastrar no site?</li><p>
R: Não, o cadastro é gratuito, e com ele você adquire o direito de participar das simulações.<p>
</th></tr>

<?php
    break;
    case 'OBJ':
?>

<tr><th class="NoticiaTitle" width="100%" align="left"> Objetivos</th></tr>
<tr><th class="NoticiaValor" width="100%" valign="top">
<p>Principais objetivos do <b>X-Manager</b>:<p>
<li> Satisfazer a crescente demanda por jogos de simulação empresarial no
Brasil;</li>
<li> Montar um banco de dados de novos talentos, permitindo que empresas
encontrem profissionais diferenciados e cortem gastos com processos de
seleção</li>
<li> Proporcionar uma ferramenta de seleção de talentos para empresas que
necessitam de um programa dedicado;</li>
<li> Formar uma rede social em torno dos participantes ativos.</li>

<p>Objetivos secundários do <b>X-Manager</b>:<p>

<li> Desenvolver a cultura empreendedora;</li>
<li> Estimular o aprendizado da ferramenta planilha de cálculo eletrônica;</li>
<li> Contribuir para o aprendizado de diversas áreas do conhecimento, tais como
Administração, Ciências Contábeis, Direito, engenharias e informática;</li>
<li> Disseminar a cultura do auto-aprendizado e da livre iniciativa;</li>
<li> Divertir e estimular os participantes, através de recompensas pelo
desempenho individual;</li>
<li> Mostrar os pontos positivos e negativos de ser dono do próprio negócio.</li>
</th></tr>
<?php
    break;
?>
            
<?php
}
?>
            </table>
        </th>

		<th valign="top" width="20%" align="center">
            <table widht="100%" align="center">
				<tr><th class="NoticiaTitle" width="100%" align="center">Parceiros</th></tr>

  			<?php
                include_once ("config.php");
                include_once ("maniadb.php");

                $db = new maniadb;
                $db->connect($GLOBALS['mydbpath'], $GLOBALS['mydbusr'], $GLOBALS['mydbpwd']);
                $db->select($GLOBALS['mydb']);

                $db->query("SELECT * FROM Parceiros ORDER BY Tamanho DESC");

                while ($row = $db->nextRow()) {

					$url = $row['Caminho para o site ou pagina'];
					$img = $row['Caminho para a imagem'];
					$size = $row['Tamanho'];
					
                    echo '<tr><th class="NoticiaTitle2" width="100%" align="left">'.$row['Nome'].'</th></tr>';
                    echo '<tr><th><a href="'.$url.'">';
					echo '<img src="'.$img.'" border="0" height='.$size.'></a></th></tr>';

                }

                $db->close();
            ?>
			</table>
		</table>


    </tr>
    </table> 
</p>
</body>
</html>

