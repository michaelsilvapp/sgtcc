<!-- Theme Login -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('lib/css/login.css')?>">

<br/><br/>
<div class="container">
  <div class="card card-container">
    <img class="profile-img-card" src="<?php echo base_url('imagens/img_sistema/use.png')?>" alt="" /> 
    <p id="profile-name" class="profile-name-card"></p>

    <form autocomplete="off" action="#" id="form_valida_login" class="form-signin" autocomplete="off">
     <div class="form-group">
        <select name="tipo_usuario" class="form-control" id="inputSelect">
          <option value="">-Categoria Usuario-</option>
          <option value="aluno">Aluno</option>
          <option value="professor">Professor</option>
          <option value="organizacao">Organização</option>
        </select>
        <span class="help-block"></span>
     </div>

      <div class="form-group">
        <input type="text" name="login_email" id="inputEmail" class="form-control" placeholder="Email">
        <span class="help-block"></span>
      </div>

      <div class="form-group">
        <input type="password" name="login_senha" id="inputPassword" class="form-control" placeholder="Senha">
        <span class="help-block"></span>
      </div>
      
      <button type="button" name="btnlogar" id="btnlogar" onclick="autentica_dados_login()" class="btn btn-flat btn-lg btn-primary btn-block btn-signin">Fazer Login</button>
      
      <a href="#" id="btnCadastrar" onclick="opcao_cadastro()" class="text-center">Cadastre-se</a>
    </form>

    <!-- /form -->
  </div>
  <!-- /card-container -->
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
        <form autocomplete="off" action="#" id="form-button" class="form-horizontal">
          <input type="hidden" value="" name="id"/> 
          <div class="form-body text-center">
            <p>- Sou -</p>
            <button type="button" name="btnSave" onclick="add_aluno()" class="btn btn-black btn-block btn-flat">Aluno</button>
            <hr>
            <p>- Sou -</p>
            <button type="button" name="btnSave" onclick="add_professor()" class="btn btn-black btn-block btn-flat">Professor</button>
            <hr>
            <p>- Sou uma -</p>
            <button type="button" name="btnSave" onclick="" class="btn btn-black btn-block btn-flat">Organização</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_user" data-backdrop="static" data-keyboard="false" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <div class="box box-primary flat">
          <div class="box-body">
            <form autocomplete="off" action="#" id="form_user" class="form-horizontal">
              
              <div class="form-group">
                <label class="control-label col-md-3">Nome</label>
                <div class="col-md-9">
                  <input name="nome" class="form-control" type="text" required>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">CPF</label>
                <div class="col-md-9">
                  <input name="cpf" class="form-control" type="text" data-inputmask='"mask": "999.999.999-99"' data-mask  required>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Dt. Nascimento</label>
                <div class="col-md-9">
                  <input name="dt_nascimento" class="form-control " type="text" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Sexo</label>
                <div class="col-md-9">
                  <select name="sexo" class="form-control">
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                  </select>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Telefone</label>
                <div class="col-md-9">
                  <input name="telefone" class="form-control" type="text" data-inputmask='"mask": "(99)9999-9999"' data-mask  required>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Email</label>
                <div class="col-md-9">
                  <input name="email" class="form-control" type="text" required>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Senha</label>
                <div class="col-md-9">
                  <input name="senha" class="form-control" type="password" required>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Confirmar Senha</label>
                <div class="col-md-9">
                  <input name="confirmar" class="form-control" type="password" required>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Copetencias </label>
                <div class="col-md-9">
                  <textarea name="copetencia" placeholder="Descreva suas experiencias, abilidades ..." class="form-control"></textarea>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Aréa de atuação</label>
                <div class="col-md-9">
                  <select name="area_id" class="form-control">
                  <?php $areas = $this->db->select('*')->from('tb_areas')->order_by('area', 'ASC')->get()->result();
                         foreach ($areas as $area) 
                         { ?>
                    <option value="<?php echo $area->id_area?>"> <?php echo $area->area?></option>
                  <?php }?>
                  </select>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="btn_salvar" name="btn_salvar" onclick="salvar()"  class="btn btn-black btn-flat">Salvar</button>
                <button type="button" class="btn btn-flat" data-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.modal-dialog -->
<div class="modal fade bs-example-modal-sm" id="modal_alerta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
         <div class="box-body">
          <div class="row">
             <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
             </div>
             <div class="alert alert-success alert-dismissable">
              <div class="alerta-msg"></div>
             </div>
          </div>
         </div>
        </div>
      </div><!-- /.box-body -->    
   </div>
</div>

<div class="modal fade bs-example-modal-sm" id="modal_alerta_erro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
         <div class="box-body">
          <div class="row">
             <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
             </div>
             <div class="alert alert-danger alert-dismissable">
              <div class="alerta-msg"></div>
             </div>
          </div>
         </div>
        </div>
      </div><!-- /.box-body -->    
   </div>
</div>
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('assets/jquery/dist/jquery.min.js')?>"></script>
<!--Ajax-->
<script src="<?php echo base_url('lib/js/acoes_ajax.js')?>" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js')?>" type="text/javascript"></script>
<!-- JQuery Masck -->
<script src="<?php echo base_url('assets/jquery.inputmask/dist/jquery.inputmask.bundle.js')?>"></script>

<script type="text/javascript">
 $(function(){
   //Datemask dd/mm/yyyy
   $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
   //Datemask2 mm/dd/yyyy
   $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
   //Money Euro
   $("[data-mask]").inputmask();
});
</script>
