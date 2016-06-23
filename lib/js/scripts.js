$(document).ready(function(){

  // Ao selecionar uma imagem, ela é exibida
  // sem a necessidade de envio para o servidor
  // através e um upload
  $("#seleciona-imagem").change(function(){
    if (this.files && this.files[0]) {
      var reader = new FileReader();

        // Define o que será executado após o carregamento da imagem
        reader.onload = function (e) {
            // Passa para os elementos no DOM as informações
            // sobre a imagem a ser exibida e os textos
            $('#visualizacao_img').attr('src', e.target.result);
            $('#visualizacao_img').removeClass('hidden');
            $('#recortar-imagem').removeClass('hidden');
            $('#texto-informativo').html('Arraste o cursor sobre a imagem para selecionar a área de corte.');
            $('#texto-informativo').removeClass('alert-info').addClass('alert-success');

            // Ativa o recurso de recorte
            $('#visualizacao_img').Jcrop({
              onSelect:    atualizaCoordenadas,
              bgColor:     'black',
              bgOpacity:   .4,
              setSelect: [ 100, 100, 500, 500 ],
              allowResize: false,//não permite o redimencionamento 
              allowSelect: false, 
              boxWidth: 500,//define a proporção que sera exibida a img
              boxHeight: 500,
              //var value = $('#imageslider').slider('option', 'value');
              //var width = orgwidth * (value / 100);
              //var height = orgheight * (value / 100)

              aspectRatio: 1 //define que sera um quadrado
            });

            // Calcula o tamanho da imagem
            defineTamanhoImagem(e.target.result,$('#visualizacao_img'));
          }

        // Carrega a imagem e chama o 'reader.onload'
        reader.readAsDataURL(this.files[0]);
      }
    });

  // Ao tentar clicar o botão recortar
  // verifica se foi definida alguma área de corte
  $('#recortar-imagem').click(function(){
    if (parseInt($('#wcrop').val())) return true;
    alert('Selecione a área de corte para continuar.');
    return false;
  });
})

// Faz a atualização das coordenadas em relação ao ponto de corte
// cada vez que esse é modificado
// É chamado nos eventos onSelect e onChange do jCrop
function atualizaCoordenadas(c)
{
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#wcrop').val(c.w);
  $('#hcrop').val(c.h);
};

// Faz a verificação e define o tamanho da imagem original
// e da imagem na área de visualização para o recorte
function defineTamanhoImagem(imgOriginal, imgVisualizacao) {
  var image = new Image();
  image.src = imgOriginal;

  image.onload = function() {
    $('#wvisualizacao').val(imgVisualizacao.width());
    $('#hvisualizacao').val(imgVisualizacao.height());
    $('#woriginal').val(this.width);
    $('#horiginal').val(this.height);
  };
}
