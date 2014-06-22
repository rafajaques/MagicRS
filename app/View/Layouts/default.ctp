<?php
$cakeDescription = __d('cake_dev', 'Magic RS');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());

$searchForm = '                    <!-- search form -->
                    <form action="/cards" method="post" class="sidebar-form" id="quickform">
                        <div class="input-group">
                            <input type="text" name="quicksearch" class="form-control" placeholder="Buscar carta..." autocomplete="off" id="quicksearch" />
							<input type="hidden" name="quick" value="1">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->';
?><!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>

        <title>
			<?php echo $projectName; ?> |
			<?php echo $title_for_layout; ?>
        </title>
		<?php
			echo $this->Html->meta('icon');

			//echo $this->Html->css('cake.generic');

			echo $this->fetch('meta');
			//echo $this->fetch('css');
			echo $this->fetch('script');
		?>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Autocomplete -->
        <script src="/js/plugins/autocomplete/jquery.autocomplete.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Main JS -->
        <script src="/js/main.js" type="text/javascript"></script>
		<script src="/js/facebook.sdk.js" type="text/javascript"></script>
		<?php if ($logedin): ?>
        <!-- Chat -->
        <script src="/js/chat.js" type="text/javascript"></script>
		<link type="text/css" rel="stylesheet" media="all" href="/css/chat.css" />
		<!--link type="text/css" rel="stylesheet" media="all" href="css/screen.css" /-->
		<!--[if lte IE 7]>
		<link type="text/css" rel="stylesheet" media="all" href="css/screen_ie.css" />
		<![endif]-->
		<?php endif; ?>
		<link rel="stylesheet" href="/css/datatables/dataTables.bootstrap.css" type="text/css" media="screen" charset="utf-8">
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-1034927-6', 'magicrs.com.br');
		  ga('send', 'pageview');

		</script>
    </head>
    <body class="skin-blue">
        <header class="header">
            <a href="/" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo $projectName; ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?php echo __('Abrir/fechar navegação'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
				<?php if ($logedin) { ?>
					
						<!-- Amigos online -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-users"></i>
                                <?php if ($friends_online_count): ?>
								<span class="label label-success"><?php echo $friends_online_count; ?></span>
								<?php endif; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">
									<?php
										if ($friends_online_count == 1) {
											echo 'Você tem 1 amigo online';
										} else if ($friends_online_count > 1) {
											echo "Você tem {$friends_online_count} amigos online";
										} else {
											echo 'Nenhum amigo online';
										}
									?>
								</li>
                                <li>
									<?php
										foreach ($friends_online as $fr):
									?>
									<div>
										
                                        <a href="/profile/view/<?php echo $fr['User']['username']; ?>" style="color:#000">
											<img src="<?php echo $this->User->getAvatar($fr['User']['id']); ?>" width="50">
                                            <?php echo $fr['User']['name'].' '.$fr['User']['surname']; ?>
                                        </a>
										<small class="pull-right" style="margin-top:10px;margin-right:5px">
											<a href="/profile/view/<?php echo $fr['User']['username']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-user"></i></a>
											<a href="#" onclick="chatWith('<?php echo $fr['User']['username']; ?>')" class="btn btn-primary btn-sm"><i class="fa fa-comment"></i></a>
										</small>
									</div>
									<?php endforeach; ?>
                                </li>
                                <li class="footer"><a href="/friends">Minha lista de amigos</a></li>
                            </ul>
                        </li>
						
                        <!-- Notificações -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag"></i>
                                <?php if ($notify_count): ?>
								<span class="label label-danger"><?php echo $notify_count; ?></span>
								<?php endif; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">
									<?php
										if ($notify_count == 1) {
											echo 'Você tem 1 notificação';
										} else if ($notify_count > 1) {
											echo "Você tem {$notify_count} notificações";
										} else {
											echo 'Sem notificações';
										}
									?>
								</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
										<?php
											foreach ($notify as $not):
												$not = $not['UserNotification'];
												// Script correto
												/*switch ($not) {
													case 'friend':
														$not_icon = 'ion-ios7-people';
														$not_href = "/profile/view/{$not['related_id']}";
														break;
												}*/
												// Para fins de otimização, enquanto só existe friend, vai assim mesmo
												$not_icon = 'ion-ios7-people';
												$not_href = "/profile/view/{$not['id_related']}?n={$not['id']}";
										?>
                                        <li class="<?php if (!$not['read']) echo 'bg-highlight'; ?>">
                                            <a href="<?php echo $not_href; ?>">
                                                <i class="ion <?php echo $not_icon; ?> info"></i> <?php echo $not['text']; ?>
                                            </a>
                                        </li>
										<?php endforeach; ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Ver todas <span class="label bg-red">Não implementado</span></a></li>
                            </ul>
                        </li>
						
                        <!-- Dados do usuário -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $user['name']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $avatar; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php printf('%s %s', $user['name'], $user['surname']); ?> - Jogador
                                        <small>Membro desde <?php echo date('d/m/Y', strtotime($user['created'])); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="/mycards">Cartas</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="/messages">Mensagens</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="/frieds">Amigos</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/profile" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/users/logout" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
					<?php } /* if $logedin */ else { ?>
                        <!-- Dados do usuário -->
                        <li class="dropdown user user-menu">
                            <a href="/users/login" class="dropdown-toggle">
                                <i class="glyphicon glyphicon-user"></i>
								Olá visitante!
                                <span>Identifique-se <i class="fa fa-fw fa-arrow-circle-right"></i></span>
                            </a>
                        </li>
						<?php } ?>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">        
				<?php if ($logedin) { ?>        
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
							<img src="<?php echo $avatar; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Olá, <?php echo $user['name']; ?>.</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
					<?php echo $searchForm; ?>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li<?php if ($this->params['controller'] == 'pages') echo ' class="active"'; ?>>
                            <a href="/">
                                <i class="fa fa-home"></i> <span>Página Inicial</span>
                            </a>
                        </li>
                        <li<?php if ($this->params['controller'] == 'cards') echo ' class="active"'; ?>>
                            <a href="/cards">
                                <i class="fa fa-archive"></i> <span>Enciclopédia de Cartas</span>
                            </a>
                        </li>
                        <li<?php if ($this->params['controller'] == 'mycards') echo ' class="active"'; ?>>
                            <a href="/mycards">
                                <i class="fa fa-book"></i> <span>Minhas Cartas</span>
                            </a>
                        </li>
                        <li<?php if ($this->params['controller'] == 'messages') echo ' class="active"'; ?>>
                            <a href="/messages">
                                <i class="fa fa-comments-o"></i> <span>Mensagens</span>
                            </a>
                        </li>
                        <li<?php if ($this->params['controller'] == 'friends') echo ' class="active"'; ?>>
                            <a href="/friends">
                                <i class="fa fa-users"></i> <span>Amigos</span>
                            </a>
                        </li>
                        <li<?php if ($this->params['controller'] == 'profile') echo ' class="active"'; ?>>
                            <a href="/profile">
                                <i class="fa fa-user"></i> <span>Meu perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="/users/logout">
                                <i class="fa fa-sign-out"></i> <span>Sair</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
				<?php } else { ?>
				<!-- Não autenticado -->
                <section class="sidebar">
                    <?php echo $searchForm; ?>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li<?php if ($this->params['controller'] == 'pages') echo ' class="active"'; ?>>
                            <a href="/">
                                <i class="fa fa-home"></i> <span>Página Inicial</span>
                            </a>
                        </li>
                        <li<?php if ($this->params['controller'] == 'cards') echo ' class="active"'; ?>>
                            <a href="/cards">
                                <i class="fa fa-archive"></i> <span>Enciclopédia de Cartas</span>
                            </a>
                        </li>
                        <li>
                            <a href="/users/login">
                                <i class="fa fa-sign-in"></i> <span>Acessar o Sistema</span>
                            </a>
                        </li>
                    </ul>
                </section>
				<?php } ?>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $title_for_layout; ?>
                        <small><?php echo $section_for_layout; ?></small>
                    </h1>
					<ol class="breadcrumb">
						<li><small class="badge bg-red">Período de Testes - Esta aplicação pode apresentar erros</small></li>
					</ol>
                    <!--ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Breadcrumb</a></li>
                        <li class="active">Em desenvolvimento</li>
                    </ol-->
                </section>

                <!-- Main content -->
                <section class="content">

					<!-- Período de testes -->
					<!--div class="alert alert-info">
                        <strong>Atenção:</strong> Você está participando de uma versão de testes desta aplicação.
						Durante a utilização você poderá visualizar erros, páginas ou funcionalidades que não
						existem ou funcionamento fora do esperado. <strong>Os dados do site também podem ser
						completamente removidos sem aviso prévio.</strong>
                    </div-->
					<?php if ($flash = $this->Session->flash('error')) { ?>
					<div class="alert alert-danger alert-dismissable">
                        <i class="fa fa-ban"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b><?php echo __('Erro!')?></b> <?php echo $flash; ?>
                    </div>
					<?php } ?>
					
					<?php if ($flash = $this->Session->flash('success')) { ?>
					<div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $flash; ?>
                    </div>
					<?php } ?>

					<?php echo $this->fetch('content'); ?>
					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    </body>
</html>