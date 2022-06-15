//---------------------Navbar---------------------------------------------------//

$(document).ready($(".dropdown-trigger").dropdown(
  {
    hover: true, // Activate on hover// Spacing from edge
    belowOrigin: false, // Displays dropdown below the button
    alignment: 'left' // Displays dropdown with edge aligned to the left of button
  }
));

//Tabs on Food Recipes page
// $(document).ready(function () {
//   $('.tabs').tabs();
// });

//Select trigger on Food recipes page
$(document).ready(function () {
  $('select').formSelect();
});

//Activation sidenav for mobile links
$(document).ready(function () {
  $('.sidenav').sidenav();
});

//-------------------------------------------------------------------//

//image animation
$(document).ready(function () {
  $('.materialboxed').materialbox();
});

$(document).ready(function () {
  $('.collapsible').collapsible();
});


//-----------------------------Modal---------------------------------------------//

//Modal open
$(document).ready(function () {
  $('.modal').modal(
    {
      dismissible: true,
      opacity: .5,
      inDuration: 500,
      outDuration: 200,
      startingTop: '10%',
      endingTop: '10%',
      ready: function (modal, trigger) {
        alert("Ready Callback");
        console.log(modal, trigger);
      },
      complete: function () { alert('Closed triggered'); }
    }
  );
})

//Modal close
$(document).ready(function () {
  $('.btn-large').instance.destroy();
})

//------------------------------Validação de formulários-------------------------------
$(document).ready(function() {
  $('select').material_select();

  // for HTML5 "required" attribute
  $("select[required]").css({
    display: "inline",
    height: 0,
    padding: 0,
    width: 0
  });
});

//--------------------------------------------------------------------------------------//

