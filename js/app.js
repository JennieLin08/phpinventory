





// $(document).ready(function() {

    //menu js
   

$("a[name='home_menu']").on("click", function(){
    sessionStorage.setItem("btnActive", "home_menu");
 });

 $("a[name='category_menu']").on("click", function(){
    sessionStorage.setItem("btnActive", "category_menu");
 });

 $("a[name='employee_menu']").on("click", function(){
    sessionStorage.setItem("btnActive", "employee_menu");
 });

 $("a[name='supplier_menu']").on("click", function(){
    sessionStorage.setItem("btnActive", "supplier_menu");
 });
 
 $("a[name='item_menu']").on("click", function(){
    sessionStorage.setItem("btnActive", "item_menu");
 });
 
 $("a[name='trans_menu_add']").on("click", function(){
    sessionStorage.setItem("btnActive", "trans_menu");
 });

 $("a[name='trans_menu_rls']").on("click", function(){
    sessionStorage.setItem("btnActive", "trans_menu");
 });

 $("a[name='trans_menu_rls']").on("click", function(){
  sessionStorage.setItem("btnActive", "trans_menu");
  });

  // $("a[name='backtohome']").on("click", function(){
  //   sessionStorage.setItem("btnActive", "home_menu");
  //   console.log('test');
  // });

  // $("a[name='touser']").on("click", function(){
  //   sessionStorage.setItem("btnActive", "home_menu");
  //   console.log('test');
  // });

let sessionState = sessionStorage.getItem("btnActive");

if( sessionState !== null ) {
    $("#home_menu").removeClass('active');
    $("#category_menu").removeClass('active');
    $("#employee_menu").removeClass('active');
    $("#supplier_menu").removeClass('active');
    $("#item_menu").removeClass('active');
    $("#trans_menu").removeClass('active');

    switch (sessionState) {
        case "home_menu":
            $("#home_menu").addClass('active');
          break;
        case "category_menu":
            $("#category_menu").addClass('active');
          break;
        case "employee_menu":
            $("#employee_menu").addClass('active');
          break;
        case "supplier_menu":
            $("#supplier_menu").addClass('active');
          break;
        case "item_menu":
            $("#item_menu").addClass('active');
          break;
        case "trans_menu":
            $("#trans_menu").addClass('active');
        //     break;
        // default:
        //     $("#home_menu").addClass('active');

      }
}else{
    $("#home_menu").removeClass('active');
    $("#category_menu").removeClass('active');
    $("#employee_menu").removeClass('active');
    $("#supplier_menu").removeClass('active');
    $("#item_menu").removeClass('active');
    sessionStorage.setItem("btnActive", "");
}


//end menu js

// });