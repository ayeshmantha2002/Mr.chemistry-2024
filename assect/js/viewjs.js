// bottom nav animation
const bottomList = document.querySelectorAll(".bottomList");
function activeLink() {
  bottomList.forEach((item) => item.classList.remove("active"));
  this.classList.add("active");
}
bottomList.forEach((item) => item.addEventListener("click", activeLink));

function loadingEffect() {
  document.getElementById("loader").style.display = "block";
}

// side nav animation
var sideNav = false;
$("#navClick").click(function () {
  if (sideNav == true) {
    $(".sideNav").css("width", "0");
    $(".blur").css("display", "none");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(-400px)");
    sideNav = false;
  } else {
    $(".sideNav").css("width", "300px");
    $(".blur").css("display", "block");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(0)");
    sideNav = true;
  }
});

var sideNav = false;
$(".infoNav").click(function () {
  if (sideNav == true) {
    $(".sideNav").css("width", "0");
    $(".blur").css("display", "none");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(-400px)");
    sideNav = false;
  } else {
    $(".sideNav").css("width", "300px");
    $(".blur").css("display", "block");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(0)");
    sideNav = true;
  }
});

$(".blur").click(function () {
  if (sideNav == true) {
    $(".sideNav").css("width", "0");
    $(".blur").css("display", "none");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(-400px)");
    sideNav = false;
  } else {
    $(".sideNav").css("width", "300px");
    $(".blur").css("display", "block");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(0)");
    sideNav = true;
  }
});

$(".eventNav").click(function () {
  if (sideNav == true) {
    $(".sideNav").css("width", "0");
    $(".blur").css("display", "none");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(-400px)");
    sideNav = false;
  } else {
    $(".sideNav").css("width", "300px");
    $(".blur").css("display", "block");
    $(".content").css("width", "100%");
    $(".sideNavAling").css("transform", "translateX(0)");
    sideNav = true;
  }
});

$(document).ready(function () {
  // load pages

  $(".homeNav").click(function () {
    $(".content").load("home.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".profilNav").click(function () {
    $(".content").load("profile.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".dashNav").click(function () {
    $(".content").load("dash.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".notificationNav").click(function () {
    $(".content").load("notification.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".notesNav").click(function () {
    $(".content").load("todo.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".settingNav").click(function () {
    $(".content").load("setting.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".eventNav").click(function () {
    $(".content").load("event.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".mapNav").click(function () {
    $(".content").load("map.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".infoNav").click(function () {
    $(".content").load("info.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  $(".contactNav").click(function () {
    $(".content").load("contact.php");
    $(".content").html(
      '<div class="loading"><img src="assect/img/icon/New-file.gif" alt=""></div>'
    );
  });
  // load page end
});
