$(document).ready(function(){
    $('.btnrowAddDelete').click(function(){
          var txtTeamAddDelete = $('.txtTeamAddDelete').val();
          var txtCricketerAddDelete = $('.txtCricketerAddDelete').val();
          var txtScoreAddDelete = $('.txtScoreAddDelete').val();
          $('.TableAddDelete tbody').append("<tr><td>"+txtTeamAddDelete+"</td><td>"+txtCricketerAddDelete+"</td><td>"+txtScoreAddDelete+"</td><td><button type='button' class='btndeleterowadded btn'>x</button></td></tr>");
    });
      $(document).on('click', 'button.btndeleterowadded', function(){
         $(this).closest('tr').remove();
         return false;
     });
});