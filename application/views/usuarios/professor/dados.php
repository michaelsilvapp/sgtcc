<div id="page-wrapper">
   <div class="row">
      <div class="col-md-12">
         <div class="card hovercard">
            <div class="card-background">
               <img class="card-bkimg" alt="" src="<?php echo base_url('imagens/img_sistema/use.png')?>">
               <!-- http://lorempixel.com/850/280/people/9/ -->
            </div>
            <div class="useravatar">
               <img alt="" src="<?php echo base_url('imagens/img_sistema/use.png')?>" width="200" height="200">
            </div>
            <div class="card-info"> <span class="card-title">{myname}</span></div>
         </div>
         <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
               <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab">
                  <div>Dados Pessoais</div>
               </button>
            </div>
            <div class="btn-group" role="group">
               <button type="button" id="following" class="btn btn-default" href="#tab2" data-toggle="tab">
                  <div>Formação</div>
               </button>
            </div>
         </div>
         <div class="well">
            <div class="tab-content">
               <div class="tab-pane fade in active" id="tab1">
                  <div class="row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <button type="button" onclick="editar_professor(<?php echo $this->session->userdata('id');?>) "class="btn btn-primary btn-circle btn-lg">
                              <i class="fa fa-edit"></i>
                           </button>
                        </div>
                     </div>

                        <div class="col-md-10" id="container_dados_p">
                           <div id="lista_dados_p"></div>
                        </div>

                  </div>
               </div>
               <div class="tab-pane fade in" id="tab2">
                  <div class="row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <button type="button" onclick="add_formacao()"class="btn btn-primary btn-circle btn-lg">
                            <i class="fa fa-plus"></i>
                           </button>
                        </div>
                     </div>
                  </div>
                     <div class="row">
                        <div class="col-md-6" id="container_dados_f">
                              <div id="lista_dados_f"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- /.content-wrapper -->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_user"  tabindex="-1"  data-toggle="modal"  data-backdrop="static" data-keyboard="false" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
         </div>
         <div class="modal-body form">
            <div class="box box-primary flat">
               <div class="box-body">
                  <form action="#" id="form_user" class="form-horizontal">
                     <div class="form-group">
                        <label class="control-label col-md-3">Nome</label>
                        <div class="col-md-9">
                           <input name="nome" class="form-control " type="text" >
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Dt. Nascimento</label>
                        <div class="col-md-9">
                           <input name="dt_nascimento" class="form-control " type="text" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Sexo</label>
                        <div class="col-md-9">
                           <select name="sexo" class="form-control ">
                              <option value="masculino">Masculino</option>
                              <option value="feminino">Feminino</option>
                           </select>
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Telefone</label>
                        <div class="col-md-9">
                           <input name="telefone" class="form-control " type="text" data-inputmask='"mask": "(99)9999-9999"' data-mask  >
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Senha</label>
                        <div class="col-md-9">
                           <button type="button" class="btn btn-block btn-primary" onclick="add_senha()"><span class="fa fa-key"></span> Alterar Senha </button>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Copetencias </label>
                        <div class="col-md-9">
                           <textarea name="copetencia" placeholder="Descreva suas experiencias, abilidades ..." class="form-control "></textarea>
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Aréa de atuação</label>
                        <div class="col-md-9">
                           <select name="area_id" class="form-control ">
                              <?php $areas = $this->db->select('*')->from('tb_areas')->order_by('area', 'ASC')->get()->result();
                                 foreach ($areas as $area) 
                                 { ?>
                              <option value="<?php echo $area->id_area?>"> <?php echo $area->area?></option>
                              <?php }?>
                           </select>
                           <span class="help-block"></span>
                        </div>
                     </div>
                  </form>
                  <div class="modal-footer">
                     <button type="button" id="btnSalvar_professor" name="btnSalvar_professor" onclick="salvar()" class="btn btn-primary">Salvar</button>
                     <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Bootstrap modal -->
<div class="modal fade in" id="modal_senha" data-backdrop="static" data-keyboard="false" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
         </div>
         <div class="modal-body form">
            <div class="box box-primary flat">
               <div class="box-body">
                  <form action="#" id="form_senha" class="form-horizontal">
                     <div class="form-group">
                        <label class="control-label col-md-3">Senha atual</label>
                        <div class="col-md-9">
                           <input name="senha_atual" class="form-control" type="password" >
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Nova Senha</label>
                        <div class="col-md-9">
                           <input name="nova_senha" class="form-control" type="password" >
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Confirmar Senha</label>
                        <div class="col-md-9">
                           <input name="confirmar_senha" class="form-control" type="password" >
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <input type="hidden" value="" name="id"/> 
                     <div class="modal-footer">
                        <button type="button" id="btn_salvar" name="btn_salvar" onclick="alterar_senha()"  class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade in" id="modal_formacao" data-backdrop="static" data-keyboard="false" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
         </div>
         <div class="modal-body form">
            <div class="box box-primary flat">
               <div class="box-body">
                  <form action="#" id="form_formacao" class="form-horizontal">
                   
                  <div class="form-group">
                     <label class="control-label col-md-3">Tipo Curso</label>
                         <div class="col-md-9">
                          <select name="tipo_curso" id="tipo_curso" class="form-control" onchange="busca_curso($(this).val())">   
                              <option value=""> Selecione a categoria do seu curso</option>       
                              <option value="1">Técnico</option>
                              <option value="2">Tecnólogo</option>
                              <option value="3">Graduação</option>
                              <option value="4">Pós-graduação</option>
                              <option value="5">Mestrado</option>
                              <option value="7">Especialista</option>
                              <option value="6">Doutorado</option>
                           </select>
                           <span class="help-block"></span>
                        </div>
                     </div>
   

                   <div class="form-group">
                     <label class="control-label col-md-3">Curso</label>
                        <div class="col-md-9">
                          <select name="curso" id="curso" class="form-control">
            
                          </select>
                          <span class="help-block"></span>
                        </div>
                     </div>

                     
                     <div class="modal-footer">
                        <button type="button" id="btn_salvar" name="btn_salvar" onclick="salvar_formacao()"  class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
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
      </div>
      <!-- /.box-body -->    
   </div>
</div>
<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('assets/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.min.js')?>" type="text/javascript"></script>
<!--Ajax-->
<script src="<?php echo base_url('application/views/ajax/acoes_ajax.js')?>" type="text/javascript"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url('assets/metisMenu/dist/metisMenu.min.js')?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('lib/js/sb-admin-2.js')?>"></script>
<!-- JQuery Masck -->
<script src="<?php echo base_url('assets/jquery.inputmask/dist/jquery.inputmask.bundle.js')?>"></script>
   
