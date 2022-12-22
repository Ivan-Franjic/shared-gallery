/*const sidebarToggle = document.querySelector(".sidebar-toggle");
const sidebarActive = document.querySelector(".sidebar");
const toggle = document.querySelector(".sidebar-toggle i");


sidebarActive.addEventListener("click", function(){
    sidebarActive.classList.toggle("active");
   // console.log(toggle);
    
    
    if (toggle.classList.contains ('bxs-chevron-left')){
      toggle.classList.remove("bxs-chevron-left");
      toggle.classList.add("bx-chevrons-right");
    }
    else{
        toggle.classList.add("bxs-chevron-left");
      toggle.classList.remove("bx-chevrons-right");
    }
});*/

$(document).on('click','#btnimagenbr',function(e){
  $.ajax({    
    type: "GET",
    url: "/shared-gallery/test",             
    dataType: "html",                  
    success: function(response){     
        $("#table-container").html(response); 
    }
});
});