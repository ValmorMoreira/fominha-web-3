
//Script para impedir cadastro com dados incorretos

$(document).ready(function(){
  
    $('#cadastro input').on('keyup', function(){
     var validator = $("#cadastro").validate();
    if (validator.form() && validateEmail($('#email').val())) {
      $('#submitButton').prop('disabled', false);
      $('#submitButton').removeClass('disabled');
    }
      else{
        $('#submitButton').prop('disabled', true);
        $('#submitButton').addClass('disabled');
        }
    }  );
  
    function validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email.toLowerCase());
  }
    /*
      Confirmation Window
    */
    $('body').on('click', '#submit', function() {
      let decision = confirm('Você tem certeza que deseja continuar? Revise seus dados por favor.');
      if (decision) {
        $.post('insert.php', $('#cadastro').serialize());
       window.location.href = 'login';
      }else{
        window.location.href = 'cadastro';
      }
    });
  }); 