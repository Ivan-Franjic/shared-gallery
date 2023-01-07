/*Get number of images on button click*/
$(document).on("click", "#btnimagenbr", function (e) {
  $.ajax({
    type: "GET",
    url: "/shared-gallery/test",
    dataType: "html",
    success: function (response) {
      $("#table-container").html(response);
    },
  });
});

/* Sidebar active */
$(function () {
  $(".sidebar-items li a")
    .filter(function () {
      return this.href == location.href;
    })
    .parent()
    .addClass("active")
    .siblings()
    .removeClass("active");
  $(".sidebar-items li a").click(function () {
    $(this).parent().addClass("active").siblings().removeClass("active");
  });
});

/* Sidebar toggle */
const sidebar = document.querySelector(".sidebar");
const sidebarToggler = document.querySelector(".sidebar-toggler");

sidebarToggler.addEventListener("click", () => {
  sidebar.classList.toggle("show");
});
