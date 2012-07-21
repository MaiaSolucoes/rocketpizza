/**
 * Created with JetBrains PhpStorm.
 * User: Ricardo
 * Date: 02/06/12
 * Time: 04:37
 * To change this template use File | Settings | File Templates.
 */
// Função que fecha o pop-up ao clicar no botao fechar
function fechar(){
	document.getElementById('fatal_error').style.display = 'none';
}
// Aqui definimos o tempo para fechar o pop-up automaticamente
function abrir(){
	document.getElementById('fatal_error').style.display = 'block';
	setTimeout ("fechar()", 3000);
}