 <?php
/**
 * wBlocks module for XOOPS
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code 
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         wBlocks
 * @since           0.1
 * @author          Daniel Wilden <dream74@users.sourceforge.net>
 * @author          Julio Napuri <julionc@users.sourceforge.net>
 * @version         $Id$
 */
if (!defined('XOOPS_ROOT_PATH')) { exit(); }

$modversion['name'] 		= _MD_NOMBRE;
$modversion['version'] 		= '0.2';
$modversion['description'] 	=_MD_DESCRIPCION;
$modversion['credits'] 		= 'NatxoCC';
$modversion['author'] 		= 'Daniel Wilden and Julio Napuri';
$modversion['help'] 		= '';
$modversion['license'] 		= '';
$modversion['official'] 	= 0;
$modversion['image']		= 'wblocks_logo.png';
$modversion['dirname']		= 'wblocks';
$modversion['status'] 		= 'Alpha';

// Admin things
$modversion['hasAdmin'] = 0;
$modversion['adminindex'] = "";
$modversion['adminmenu'] = "";

//Menu
$modversion['hasMain'] =0;

// Search
$modversion['hasSearch'] = 0;
$modversion['search']['file'] = "";
$modversion['search']['func'] = "";

// Comments
$modversion['hasComments'] = 0;
$modversion['comments']['itemName'] = "";
$modversion['comments']['pageName'] = "";

// Smarty
$modversion['use_smarty'] = 1;

// Blocks
$modversion['blocks'][1]['file'] = "usuario_block.php";
$modversion['blocks'][1]['name'] = _MD_BL_NOMBRE;
$modversion['blocks'][1]['description'] = _MD_BL_DESCRIPCION;
$modversion['blocks'][1]['show_func'] = "usuario_bloque";
$modversion['blocks'][1]['edit_func'] = "usuario_opciones";
$modversion['blocks'][1]['options']	= "1|1|1|1|1|10";
$modversion['blocks'][1]['template'] = 'usuario_block.html';
$modversion['blocks'][1]['show_all_module'] = true;
$modversion['blocks'][1]['can_clone'] = false ;

?>