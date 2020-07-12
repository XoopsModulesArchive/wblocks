<?php

if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

function usuario_bloque($options) {

    global $xoopsConfig, $xoopsUser, $xoopsModule, $xoopsDB, $_SERVER;

	$online_handler =& xoops_gethandler('online');
	mt_srand((double)microtime()*1000000);
	$block = array();
	if (mt_rand(1, 100) < 11) {
		$online_handler->gc(300);
	}


	if (is_object($xoopsUser)) {
		$uid = $xoopsUser->getVar('uid');
		$uname = $xoopsUser->getVar('uname');
		$usuario = $xoopsUser->getVar('uname');

		$pm_handler =& xoops_gethandler('privmessage');
		$criteria = new CriteriaCompo(new Criteria('read_msg', 0));
		$criteria->add(new Criteria('to_userid', $xoopsUser->getVar('uid')));
		$mensajesnumero = $pm_handler->getCount($criteria);
		$rangoclase=$xoopsUser->rank();

		$block['rangoimagen']=$rangoclase['image'];
		$block['rangotitulo']=$rangoclase['title'];
		$block['avatar_usuario']=$xoopsUser->getVar('user_avatar');
		$block['mensajesnumero']=$mensajesnumero;

		$block['idioma_cambiaravatar']= _WBB_CAMBIAR_AVATAR;
		$block['idioma_perfilusuario']= _WBB_PERFIL;
		$block['img_perfilusuario']= XOOPS_URL . '/modules/wblocks/images/perfil.png';
		$block['idioma_mensajes']= _WBB_MENSAJES;
		$block['img_mensajes']= XOOPS_URL . '/modules/wblocks/images/mensajes.png';
		$block['idioma_mensajesnuevos']= _WBB_MENSAJESNUEVOS;
		$block['img_mensajesnuevos']= XOOPS_URL . '/modules/wblocks/images/nuevocorreo.png';
		$block['idioma_notificaciones']= _WBB_NOTIFICACIONES;
		$block['img_notificaciones']= XOOPS_URL . '/modules/wblocks/images/notificaciones.png';
		$block['idioma_administracion']= _WBB_ADMINISTRACION;
		$block['img_administracion']= XOOPS_URL . '/modules/wblocks/images/administracion.png';
		$block['idioma_desconectar']= _WBB_DESCONECTAR;		
		$block['img_desconectar']= XOOPS_URL . '/modules/wblocks/images/desconectar.png';		
		

	} else {
		$uid = 0;
		$uname = '';
		$usuario=_WBB_INVITADO;
		$block['idioma_login'] = _WBB_LOGIN;
		$block['idioma_nombre'] = _WBB_NOMBRE;
		$block['idioma_entrar'] = _WBB_ENTRAR;
		//$block['idioma_recuerdame'] = _WBB_RECUERDAME;
        if ($xoopsConfig['use_ssl'] == 1 && $xoopsConfig['sslloginlink'] != '') {
            $block['sslloginlink'] = "<a href=\"javascript:openWithSelfMain('".$xoopsConfig['sslloginlink']."', 'ssllogin', 300, 200);\">"._MB_SYSTEM_SECURE."</a>";
        } elseif ($xoopsConfig['usercookie']) {
            $block['idioma_recuerdame'] = _WBB_RECUERDAME;
        }
		$block['idioma_registratedsc'] = _WBB_REGISTRATEDSC;
		$block['idioma_registro'] = '<a href=\"'.XOOPS_URL.'/register.php" title="'._WBB_REGISTRATEDSC.'">'._WBB_REGISTRATE.'</a>';
		$block['recuperarpass']= '<a href="'.XOOPS_URL.'/user.php#lost" title="'._TIP_RECUPERAR_PASS.'">'._WBB_RECUPERAR_PASS.'</a>';
			}
	
	if (is_object($xoopsModule)) {
		$online_handler->write($uid, $uname, time(), $xoopsModule->getVar('mid'), $_SERVER['REMOTE_ADDR']);
	} else {
		$online_handler->write($uid, $uname, time(), 0, $_SERVER['REMOTE_ADDR']);
	}
	$onlines =& $online_handler->getAll();
	$module_handler =& xoops_gethandler('module');
	$modules =& $module_handler->getList(new Criteria('isactive', 1));
	if (false != $onlines) {
		$total = count($onlines);
		$invitados = 0;
		$miembros = '';
		$invitadosip='';
		$bots = 0;
		$findbot  = 'crawl';
		$findsearch = 'search';

		include_once XOOPS_ROOT_PATH . '/modules/wblocks/include/geoip.inc';
		$gi = geoip_open(XOOPS_ROOT_PATH . "/modules/wblocks/include/GeoIP.dat",GEOIP_STANDARD);
		for ($i = 0; $i < $total; $i++) {
			if ($onlines[$i]['online_uid'] > 0) {
				$bandera = strtolower(geoip_country_code_by_addr($gi, $onlines[$i]['online_ip']));

				if (!$bandera) {$bandera="online";}
				$onlineUsers[$i]['module'] = ($onlines[$i]['online_module'] > 0) ? $modules[$onlines[$i]['online_module']] : '';
				$miembros .= '<tr><td><img src="'.XOOPS_URL.'/modules/wblocks/images/banderas/'.$bandera.'.gif" alt="'.$bandera.'" title="'.$bandera.'" /></td><td><a href="'.XOOPS_URL.'/userinfo.php?uid='.$onlines[$i]['online_uid'].'"><small>'.$onlines[$i]['online_uname'].'</small></a></td><td><small>'.$onlineUsers[$i]['module'].'</small></td></tr>';
			
			} else {
				$bandera = strtolower(geoip_country_code_by_addr($gi, $onlines[$i]['online_ip']));
				$hostname = strtolower(gethostbyaddr($onlines[$i]['online_ip']));
				
				if (!$bandera) {$bandera="online";}

				$pos1 = strpos($hostname, $findbot);
                $pos2 = strpos($hostname, $findsearch);

				if ($xoopsUser)	{ 
					if ($xoopsUser->isAdmin(-1)) {$direccionip=$onlines[$i]['online_ip'];}
					else {$direccionip= _WBB_INVITADO;}
				} else {
					$direccionip= _WBB_INVITADO;
				}

				//if is bot
				if ($pos1 !== false || $pos2 !== false) {
					//$invitadosip .= '<tr><td><img src="'.XOOPS_URL.'/modules/wblocks/images/banderas/bots.gif" alt="bot" title="bot" /></td><td><small>'.$direccionip.'</small></td><td><small>'.$onlineUsers[$i]['module'].'</small</td></tr>';
					$bots++;
                } else {
					$onlineUsers[$i]['module'] = ($onlines[$i]['online_module'] > 0) ? $modules[$onlines[$i]['online_module']] : '';
					$invitadosip .= '<tr><td><img src="'.XOOPS_URL.'/modules/wblocks/images/banderas/'.$bandera.'.gif" alt="'.$bandera.'" title="'.$bandera.'"/></td><td><small>'.$direccionip.'</small></td><td><small>'.$onlineUsers[$i]['module'].'</small></td></tr>';
				}

				$invitados++;
			}
			
		}
		geoip_close($gi);
		
	$member_handler =& xoops_gethandler('member');
	$hari_ini = formatTimestamp(time());
	$usuarios_registrados = $member_handler->getUserCount(new Criteria('level', 0, '>'));
	$registrados_hoy = $member_handler->getUserCount(new Criteria('user_regdate', mktime(0,0,0), '>='));
	$registrados_desdeayer = $member_handler->getUserCount(new Criteria('user_regdate', (mktime(0,0,0)-(24*3600)), '>='));
	$criteria = new CriteriaCompo(new Criteria('level', 0, '>'));
	$criteria->setOrder('DESC');
	$criteria->setSort('user_regdate');
	$criteria->setLimit($options['5']);
	$nuevosmiemb =& $member_handler->getUsers($criteria);
	$ultimo_registrado = $nuevosmiemb[0]->getVar('uname');
	$count = count($nuevosmiemb);
	$nuevosmiembros='<b>'._WBB_NUEVOSMIEMBROS.':</b> ';
	for ($i = 0; $i < $count; $i++)
	{
			$nuevosmiembros.='<small>[<span style="text-transform: uppercase">'.$nuevosmiemb[$i]->getVar('uname').'</span>-<i>'.formatTimestamp($nuevosmiemb[$i]->getVar('user_regdate'), 's').'</i></small>] ';
	}
	
		$miembros.=$invitadosip;
		if ($xoopsConfig['use_ssl'] == 1 && $xoopsConfig['sslloginlink'] != '')
			{
			$block['sslloginlink'] = "<a href=\"javascript:openWithSelfMain('".$xoopsConfig['sslloginlink']."', 'ssllogin', 300, 200);\">"._MB_SYSTEM_SECURE."</a>";
			}
		$block['idioma_bienvenido']=_WBB_BIENVENIDO;
		$block['idioma_conectados']=_WBB_CONECTADOS;
		$block['idioma_miembros']=_WBB_MIEMBROS;
		$block['idioma_invitados']=_WBB_INVITADOS;
		$block['idioma_bots']=_WBB_BOTS;
		$block['idioma_menuusuario'] = _WBB_MENUUSUARIO;
		$block['idioma_online'] = _WBB_ONLINE;
		$block['idioma_nuevomensaje']=_WBB_NUEVOMENSAJE;
		$block['idioma_estadisticas']=_WBB_ESTADISTICAS;
		$block['idioma_registrados']=_WBB_REGISTRADOS;
		$block['idioma_hoy']=_WBB_HOY;
		$block['idioma_ayer']=_WBB_AYER;
		$block['online_total'] = $total;
		$block['online_names'] = $miembros;
		$block['online_miembros'] = $total - $invitados;
		$block['online_invitados'] = $invitados - $bots;
		$block['online_bots'] = $bots;
		$block['usuario']=$usuario;
		$block['nuevosmiembros']=$nuevosmiembros;
		$block['veravatar'] = $options[0];
		$block['verconectados'] = $options[1];
		$block['verpopup'] = $options[2];
		$block['statsreg'] = $options[3];
		$block['ultimousuario'] = $options[4];
		$block['usuariosregistrados']=$usuarios_registrados;
		$block['registradoshoy']=$registrados_hoy;
		$block['registradosayer']=$registrados_desdeayer - $registrados_hoy;
		$block['ultimo']=$ultimo_registrado;
		
		
		return $block;
	} else {
		return false;
	}
}

function usuario_opciones($options) {

    if (!$options[5] || (isset($_GET['op']) && $_GET['op'] == 'clone')) $options[5] = time();

	//Ver Avatar
	$form = _MD_VERAVATAR."&nbsp;";
	if ( $options[0] == 1 ) {
		$chk = " checked='checked'";
	}
	$form .= "<input type='radio' name='options[0]' value='1'".$chk." />&nbsp;"._YES."";
	$chk = "";
	if ( $options[0] == 0 ) {
		$chk = " checked='checked'";
	}
	$form .= "&nbsp;<input type='radio' name='options[0]' value='0'".$chk." />"._NO."<br />";

	//Ver conectados
	$form .= _MD_VERCONECTADOS."&nbsp;";
	if ( $options[1] == 1 ) {
		$chk = " checked='checked'";
	}
	$form .= "<input type='radio' name='options[1]' value='1'".$chk." />&nbsp;"._YES."";
	$chk = "";
	if ( $options[1] == 0 ) {
		$chk = " checked='checked'";
	}
	$form .= "&nbsp;<input type='radio' name='options[1]' value='0'".$chk." />"._NO."<br />";

	//Ver PopUp
	$form .= _MD_POPUP."&nbsp;";
	if ( $options[2] == 1 ) {
		$chk = " checked='checked'";
	}
	$form .= "<input type='radio' name='options[2]' value='1'".$chk." />&nbsp;"._YES."";
	$chk = "";
	if ( $options[2] == 0 ) {
		$chk = " checked='checked'";
	}
	$form .= "&nbsp;<input type='radio' name='options[2]' value='0'".$chk." />"._NO."<br />";

	//Ver Estadisticas
	$form .= _MD_ESTADISTICA."&nbsp;";
	if ( $options[3] == 1 ) {
		$chk = " checked='checked'";
	}
	$form .= "<input type='radio' name='options[3]' value='1'".$chk." />&nbsp;"._YES."";
	$chk = "";
	if ( $options[3] == 0 ) {
		$chk = " checked='checked'";
	}
	$form .= "&nbsp;<input type='radio' name='options[3]' value='0'".$chk." />"._NO."<br />";

	//Ver Ultimos usuarios registrados
	$form .= _MD_ULTIMOUSUARIO."&nbsp;";
	if ( $options[4] == 1 ) {
		$chk = " checked='checked'";
	}
	$form .= "<input type='radio' name='options[4]' value='1'".$chk." />&nbsp;"._YES."";
	$chk = "";
	if ( $options[4] == 0 ) { 
		$chk = " checked='checked'";
	}
	$form .= "&nbsp;<input type='radio' name='options[4]' value='0'".$chk." />"._NO."<br />";

	//Ver Ultimos usuarios reistrados (cantidad)
	
	$form .= _MD_CANTIDAD."&nbsp;";
	$form .= "<input type='text' name='options[5]' value='".$options[5]."'/>";

	return $form;
}

?>