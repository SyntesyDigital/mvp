$('.menu-dropdown').on('click', function(e){
  $('.menu-dropdown').parent().find('.dropdown-content').hide();
  $(this).parent().find('.dropdown-content').show();
});

function collapseMenu(){
    document.getElementById("menu-button").setAttribute("aria-expanded", "false");
    $("#menu-button").addClass("collapsed");
    document.getElementById("navbar-header-sections").setAttribute("aria-expanded", "false");
    $("#navbar-header-sections").removeClass("in");
    document.getElementById("navbar-header-sections").style.height = "0px";
}
function collapseLogin(){
    document.getElementById("user-nav-btn").setAttribute("aria-expanded", "false");
    $("#user-nav-btn").addClass("collapsed");
    document.getElementById("navbar-login-sections").setAttribute("aria-expanded", "false");
    $("#navbar-login-sections").removeClass("in");
    document.getElementById("navbar-login-sections").style.height = "0px";
}
$('#menu-button').on('click', function(e){
    collapseLogin();
});

$('#user-nav-btn').on('click', function(e){
    collapseMenu();
});

$('.submit-btn-container').on('click', function(e){
    $('#search-form').submit();
});

$('#filter-nav-btn').on('click', function(e){
    if($('#navbar-filter-sections').is(":visible")){
      $('#navbar-filter-sections').hide();
      $('.search-results').removeClass('margin-top-auto');
    }else{
      $('#navbar-filter-sections').show();
      $('.search-results').addClass('margin-top-auto');;
    }
    return false;
});
var expanded = false;
function showCheckboxes(num_select) {
  var checkboxes = document.getElementById("checkboxes_"+num_select);
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
