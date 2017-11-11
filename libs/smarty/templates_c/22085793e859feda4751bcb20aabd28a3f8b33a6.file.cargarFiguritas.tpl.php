<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-03 13:17:25
         compiled from "vistas\cargarFiguritas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1226459f565aaadb003-41062889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22085793e859feda4751bcb20aabd28a3f8b33a6' => 
    array (
      0 => 'vistas\\cargarFiguritas.tpl',
      1 => 1509710388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1226459f565aaadb003-41062889',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59f565aab3d3c6_40919861',
  'variables' => 
  array (
    'location' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59f565aab3d3c6_40919861')) {function content_59f565aab3d3c6_40919861($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	
	<base href="/Figurettis/">
	<?php echo $_smarty_tpl->getSubTemplate ("bs_js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<title><?php echo $_smarty_tpl->tpl_vars['location']->value;?>
 - Figurettis</title>
	<?php echo '<script'; ?>
 src = "js/cargarFiguritas.js"><?php echo '</script'; ?>
>
</head>
<body>
	<div class = "container">
		<center><h1>Carga de figuritas de álbum del mundial Road To Russia 2018</h1></center>
		<br><br>
		<center><button class = "btn btn-primary" id = "btnCargarFiguritas">Cargar figuritas</button></center>
		<br><br>
		<div class = "alert alert-success" id = "alert" style = "display: none">
			<center>Figuritas cargadas de manera correcta en la base de datos</center>
		</div>
	</div>
</body>
</html><?php }} ?>
