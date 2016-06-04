<head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assests/bootstrap/css/login.css')?>">
</head>
<br/><br/>
<div class="container">
 <div class="card card-container">
   <img class="profile-img-card" src="http://icons.iconarchive.com/icons/gakuseisean/ivista-2/128/Misc-User-icon.png" alt="" /> 
   <p id="profile-name" class="profile-name-card"></p>
   <form class="form-signin" action="<?php echo base_url('')?>" method="POST">
     <span id="reauth-email" class="reauth-email"></span>
     <div class="form-group">
      <select class="form-control" id="inputSelect" required>
        <option>Professor</option>
        <option>Aluno</option>
        <option>Organizações</option>
      </select>
    </div>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
    <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
    <div id="remember" class="checkbox">
    </div>
    <button class="btn btn-lg btn-primary btn-block btn-signin" name="btnlogar" type="button">Fazer Login</button>
    <a href="#" id="btnCadastrar" onclick="opcao_cadastro()" class="text-center">Cadastre-se</a>
  </form><!-- /form -->
</div><!-- /card-container -->
</div>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_button" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-button" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body text-center">
                      <p>- Sou -</p>
                     <button type="submit" id="btnSave" name="btnSave" onclick="" class="btn btn-black btn-block">Aluno</button>
                     <hr><p>- Sou -</p>
                     <button type="submit" id="btnSave" name="btnSave" onclick="" class="btn btn-black btn-block">Professor</button>
                     <hr><p>- Sou uma -</p>
                     <button type="submit" id="btnSave" name="btnSave" onclick="" class="btn btn-black btn-block">Organização</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('assests/plugins/jQuery/jQuery-2.1.4.min.js')?>" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assests/bootstrap/js/bootstrap.js')?>" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assests/dist/js/app.js')?>" type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assests/plugins/slimScroll/jquery.slimscroll.js')?>" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assests/dist/js/pages/dashboard2.js')?>" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assests/dist/js/demo.js')?>" type="text/javascript"></script>