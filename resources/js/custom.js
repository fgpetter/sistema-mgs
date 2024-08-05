/**
 * Init Tooltip
 */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


/**
 * iMasK input
 */

if(document.querySelector("#telefone")){
  IMask(document.querySelector("#telefone"), {
    mask: '(00) 0 0000-0000'
  })
}

if(document.querySelector("#telefone2")){
  IMask(document.querySelector("#telefone2"), {
  mask: '(00) 0 0000-0000'
})
}

document.querySelectorAll('.table-cpf-cnpj').forEach(el => {
  IMask(el, {
    mask: [
      {mask: '000.000.000-00'},
      {mask: '00.000.000/0000-00'}
    ]
  })
});

document.querySelectorAll('.telefone').forEach(el => {
  IMask(el, {
    mask: [
      {mask: '(00) 0000-0000'},
      {mask: '(00) 0 0000-0000'}
    ]
  })
});

document.querySelectorAll('.input-cep').forEach(el => {
  IMask(el, {
    mask: '00000-000'
  })
});

window.onload = function(){
  $('#input-cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('#input-cpf').mask('000.000.000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});
  $('.cep').mask('00000-000');
};

/**
 * Form de busca em tabelas
 */
function search(e, url, tipo){
  if(e.keyCode === 13){
    e.preventDefault();
    url = url.split('?')[0] // remove parametros
    if(e.target.value != undefined){
      window.location.href = url+'?'+tipo+'='+e.target.value
    }
  }
}