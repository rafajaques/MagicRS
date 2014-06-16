<!-- Esquerda -->
<section class="col-lg-6">
	<div class="box box-info">
        <div class="box-header">
            <i class="fa fa-envelope"></i>
            <h3 class="box-title">Seja bem-vindo ao <?php echo $projectName; ?></h3>
        </div>
        <div class="box-body">
			<p>
				O <?php echo $projectName; ?> é um site desenvolvido por Rafael Jaques
				com o intuito de simplificar a troca de cartas e socialização
				entre jogadores de Magic dentro do Rio Grande do Sul.
			</p>
			<p>
				Aqui fica um texto de boas-vindas :)
			</p>
		</div>
    </div>
    <!-- Chat box -->
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-comments-o"></i> Mensagens</h3>
            <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>                                            
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
            </div>
        </div>
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
            <!-- chat item -->
            <div class="item">
                <img src="img/avatar.png" alt="user image" class="online">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                        Juquinha
                    </a>
                    E aí, cara! Vi que tu tens um <a href="#">Ritual Sombrio</a>. Tá afim de negociar? Valeu!
                </p>
            </div><!-- /.item -->
            <!-- chat item -->
            <div class="item">
                <img src="img/avatar2.png" alt="user image" class="offline">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                        Mariazinha
                    </a>
                    O torneio foi um fiasco. Não consegui ganhar nenhuma! Mas pelo menos
					conheci bastante gente e descolei umas cartas maneiras.<br>
					Depois eu te mostro umas bacanas. ;)
                </p>
            </div><!-- /.item -->
            <!-- chat item -->
            <div class="item">
                <img src="img/avatar3.png" alt="user image" class="offline">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                        Aninha
                    </a>
                    E aí, tchê! Vai se manifestar ou não?<br>
					Não esquece que tu tá me devendo um <a href="#">Naturalizar</a>
					há uns três meses!
                </p>
            </div><!-- /.item -->
        </div><div class="slimScrollBar" style="background-color: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; z-index: 99; right: 1px; height: 157.035175879397px; background-position: initial initial; background-repeat: initial initial;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div></div><!-- /.chat -->
        <div class="box-footer">
            <div class="input-group">
                <input class="form-control" placeholder="Digite sua mensagem...">
                <div class="input-group-btn">
                    <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div><!-- /.box (chat box) -->

    <!-- TO DO List -->
    <div class="box box-primary">
        <div class="box-header" style="cursor: move;">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Minhas Cartas</h3>
            <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <ul class="todo-list ui-sortable">
                <li>
                    <!-- drag handle -->
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>  
                    <!-- checkbox -->
                    <div class="icheckbox_minimal checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>                                            
                    <!-- todo text -->
                    <span class="text">Design a nice theme</span>
                    <!-- Emphasis label -->
                    <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li><li class="" style="">
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>                                            
                    <div class="icheckbox_minimal checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Make the theme responsive</span>
                    <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Check your messages and notifications</span>
                    <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
            </ul>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
        </div>
    </div><!-- /.box -->

</section>

<!-- Direita -->
<section class="col-lg-6 connectedSortable ui-sortable">
    <!-- Map box -->
    <div class="box box-primary">
        <div class="box-header">
            <i class="glyphicon glyphicon-star"> </i>
            <h3 class="box-title">
                Carta do Dia
            </h3>
        </div>
        <div class="box-body text-center">
			<img src="/content/brimaz.jpg" width="223" height="310" alt="Brimaz">
			<br><br>
			<p><strong>Brimaz, Rei de Oreskos</strong></p>
        </div><!-- /.box-body-->
        <div class="box-footer">
            <button class="btn btn-info"><i class="fa fa-thumbs-up"></i> Eu quero!</button>
            <button class="btn btn-warning"><i class="fa fa-bug"></i> Reportar Bug</button>
        </div>
    </div>
    <!-- /.box -->

    <!-- TO DO List -->
    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Minhas Cartas</h3>
            <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <ul class="todo-list ui-sortable">
                <li>
                    <!-- drag handle -->
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>  
                    <!-- checkbox -->
                    <div class="icheckbox_minimal checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>                                            
                    <!-- todo text -->
                    <span class="text">Design a nice theme</span>
                    <!-- Emphasis label -->
                    <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li><li class="" style="">
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>                                            
                    <div class="icheckbox_minimal checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Make the theme responsive</span>
                    <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Check your messages and notifications</span>
                    <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
                <li>
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </span>
                    <div class="icheckbox_minimal" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="" name="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins></div>
                    <span class="text">Let theme shine like a star</span>
                    <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                    <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                </li>
            </ul>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
        </div>
    </div><!-- /.box -->

    <!-- Chat box -->
    <div class="box box-success">
        <div class="box-header" style="cursor: move;">
            <h3 class="box-title"><i class="fa fa-comments-o"></i> Chat</h3>
            <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>                                            
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
            </div>
        </div>
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
            <!-- chat item -->
            <div class="item">
                <img src="img/avatar.png" alt="user image" class="online">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                        Mike Doe
                    </a>
                    I would like to meet you to discuss the latest news about
                    the arrival of the new theme. They say it is going to be one the
                    best themes on the market
                </p>
                <div class="attachment">
                    <h4>Attachments:</h4>
                    <p class="filename">
                        Theme-thumbnail-image.jpg
                    </p>
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm btn-flat">Open</button>
                    </div>
                </div><!-- /.attachment -->
            </div><!-- /.item -->
            <!-- chat item -->
            <div class="item">
                <img src="img/avatar2.png" alt="user image" class="offline">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                        Jane Doe
                    </a>
                    I would like to meet you to discuss the latest news about
                    the arrival of the new theme. They say it is going to be one the
                    best themes on the market
                </p>
            </div><!-- /.item -->
            <!-- chat item -->
            <div class="item">
                <img src="img/avatar3.png" alt="user image" class="offline">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                        Susan Doe
                    </a>
                    I would like to meet you to discuss the latest news about
                    the arrival of the new theme. They say it is going to be one the
                    best themes on the market
                </p>
            </div><!-- /.item -->
        </div><div class="slimScrollBar" style="background-color: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; z-index: 99; right: 1px; height: 157.035175879397px; background-position: initial initial; background-repeat: initial initial;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div></div><!-- /.chat -->
        <div class="box-footer">
            <div class="input-group">
                <input class="form-control" placeholder="Type message...">
                <div class="input-group-btn">
                    <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div><!-- /.box (chat box) -->

</section>