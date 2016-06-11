
<br/><br/>
<div class="container">
  <div class="card card-container">
    <img class="profile-img-card" src="http://icons.iconarchive.com/icons/gakuseisean/ivista-2/128/Misc-User-icon.png" alt="" /> 
    <p id="profile-name" class="profile-name-card"></p>
    <form class="form-signin" action="" method="POST">
      <div class="form-group">
        <select class="form-control" id="inputSelect" required>
          <option>Professor</option>
          <option>Aluno</option>
          <option>Organizações</option>
        </select>
      </div>
      <input type="email" name="login" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Senha" required>
      
      <span class="help-block"></span>
      <button class="btn btn-lg btn-primary btn-block btn-signin" name="btnlogar" type="button">Fazer Login</button>
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
        <form action="#" id="form-button" class="form-horizontal">
          <input type="hidden" value="" name="id"/> 
          <div class="form-body text-center">
            <p>- Sou -</p>
            <button type="button" name="btnSave" onclick="add_aluno()" class="btn btn-black btn-block btn-flat">Aluno</button>
            <hr>
            <p>- Sou -</p>
            <button type="button" name="btnSave" onclick="add_professor()" class="btn btn-black btn-block bnt-flat">Professor</button>
            <hr>
            <p>- Sou uma -</p>
            <button type="button" name="btnSave" onclick="" class="btn btn-black btn-block bnt-flat">Organização</button>
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
<div class="modal fade" id="modal_aluno" data-backdrop="static" data-keyboard="false" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <div class="box box-primary flat">
          <div class="box-body">
            <form action="#" id="form_aluno" class="form-horizontal">
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
                  <input name="dt_nascimento" class="form-control" type="text" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
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
                <button type="button" id="btnSalvar_aluno" name="btnSalvar_aluno" onclick="salvar_aluno()"  class="btn btn-black btn-flat">Salvar</button>
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


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_professor"  tabindex="-1"  data-backdrop="static" data-keyboard="false" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <div class="box box-primary flat">
          <div class="box-body">
            <form action="#" id="form_professor" class="form-horizontal">
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
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
                  <input name="dt_nascimento" class="form-control" type="text" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
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
                <button type="button" id="btnSalvar_professor" name="btnSalvar_professor" onclick="salvar_professor()" class="btn btn-black btn-flat">Salvar</button>
                <button type="button" class="btn btn-flat" data-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


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
<!-- /.modal-dialog -->
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('assests/plugins/jQuery/jQuery-2.1.4.min.js')?>" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assests/bootstrap/js/bootstrap.js')?>" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assests/dist/js/app.js')?>" type="text/javascript"></script>
<!-- Masck .js  -->
<script src="<?php echo base_url('assests/plugins/input-mask/jquery.inputmask.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assests/plugins/input-mask/jquery.inputmask.extensions.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assests/plugins/input-mask/inicializacao.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('assests/plugins/input-mask/jquery.inputmask.date.extensions.js')?>" type="text/javascript"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assests/plugins/slimScroll/jquery.slimscroll.js')?>" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assests/dist/js/demo.js')?>" type="text/javascript"></script>