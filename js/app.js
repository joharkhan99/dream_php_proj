// scroll nav
// $(window).scroll(function () {
//   var scroll = $(window).scrollTop();

//   if (scroll >= 100) {
//     $("header").addClass("scrolling");
//   } else {
//     $("header").removeClass("scrolling");
//   }
// });

// mob nav
function hasClass(ele, cls) {
  return !!ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}

function addClass(ele, cls) {
  if (!hasClass(ele, cls)) ele.className += " " + cls;
}

function removeClass(ele, cls) {
  if (hasClass(ele, cls)) {
    var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
    ele.className = ele.className.replace(reg, ' ');
  }
}

function toggleMenu() {
  var ele = document.getElementsByTagName('body')[0];
  if (!hasClass(ele, "open-mob-menu")) {
    addClass(ele, "open-mob-menu");
  } else {
    removeClass(ele, "open-mob-menu");
  }
}

function ToggleForm(param) {
  var parent = $(param).parent().parent();
  // var childs = $(parent);

  if ($(parent).find(".comment_form").length > 0) {
    $(".comment_form").hide();
    $($(".before")).append($(".comment_form"));
    $(param).html('<i class="fa fa-reply-all" aria-hidden="true"></i> Reply');
    $("#reply_form").attr({
      "id": "comm_form",
      "name": "comm_form",
      "onsubmit": "Su_Cm(event)"
    });
    $(".comment_form h3").text("LEAVE A COMMENT");
    $("#c_scrt_p_j").attr("name", "comm");
    $(".comment_form button[type='submit']").text("Post Comment");
    $("#c_i_u-d").val("");

  } else {
    $(parent).append($(".comment_form"));
    $(".comment_form").show();
    $(param).html('<i class="fas fa-times" style="color: tomato;" aria-hidden="true"></i> <span style="color: tomato;">Cancel</span>');
    $("#comm_form").attr({
      "id": "reply_form",
      "name": "reply_form",
      "onsubmit": "Rp_Cm(event)"
    });
    var name = $(parent).children(".commenter-name").children(".username").text();
    $(".comment_form h3").text("REPLY TO " + name.toUpperCase());
    $("#c_scrt_p_j").attr("name", "reply");
    $(".comment_form button[type='submit']").text("Post Reply");
    $("#c_i_u-d").val($(parent).children("#c_id").val());
  }

  $(".comment_form").show();
};


// alerts
const hideAlert = () => {
  const el = document.querySelector('.cust_alert');
  if (el)
    el.parentElement.removeChild(el);
};
const showAlert = (msg, time = 3) => {
  hideAlert();
  const markup = `<div class="cust_alert">${msg}</div>`;
  document.querySelector('body').insertAdjacentHTML('afterbegin', markup);
  window.setTimeout(hideAlert, time * 1000);
};

function Login() {
  var formData = new FormData($('form[id="login_form"]')[0]);

  $.ajax({
    type: "post",
    url: "ajax/login.php",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      if (response.includes('0')) {
        showAlert(response.replace('0', ''));
      } else {
        window.location.href = 'dashboard/';
      }
    }
  });
};

function A_C() {
  var f = new FormData($('#a_c')[0]);

  $.ajax({
    type: "post",
    url: "../ajax/ac.php",
    data: f,
    processData: false,
    contentType: false,
    success: function (response) {
      if (response.includes('0')) {
        showAlert(response.replace('0', ''));
      } else {
        showAlert(response);
        $('#a_c').trigger('reset');
      }
    }
  });
};


function LikePost(id) {
  $.ajax({
    method: "POST",
    url: "ajax/l_d.php",
    data: { like: 1, id: id },
    success: function (response) {
      showAlert("Thank you for your Feedback");
    }
  });
}

function DislikePost(id) {
  $.ajax({
    method: "POST",
    url: "ajax/l_d.php",
    data: { dislike: 1, id: id },
    success: function (response) {
      showAlert("Thank you for your Feedback");
    }
  });
};

function CheckPass(password) {
  var password_strength = document.getElementById("password-text");

  // Reset if password length is zero
  if (password.length === 0) {
    password_strength.innerHTML = "";
    password_strength.value = "0";
    return;
  }

  // Check progress
  var prog = [/[$@$!%*#?&]/, /[A-Z]/, /[0-9]/, /[a-z]/]
    .reduce((memo, test) => memo + test.test(password), 0);

  // Length must be at least 8 chars
  if (prog > 2 && password.length > 7) {
    prog++;
  }

  // Display it
  var progress = "";
  var strength = "";
  switch (prog) {
    case 0:
    case 1:
    case 2:
      strength = "25%";
      progress = "25";
      break;
    case 3:
      strength = "50%";
      progress = "50";
      break;
    case 4:
      strength = "75%";
      progress = "75";
      break;
    case 5:
      strength = "100% - Password strength is good";
      progress = "100";
      break;
  }
  password_strength.innerHTML = strength;
  // document.getElementById("progress").value = progress;

  // if (password.length == 0) {
  //   password_strength.innerHTML = "";
  //   return;
  // }
  // var regex = new Array();
  // regex.push("[A-Z]"); //Uppercase
  // regex.push("[a-z]"); //Lowercase
  // regex.push("[0-9]"); //numbers
  // regex.push("[$@$!%*#?&]"); //Characters
  // // regex.push("[a-zA-Z0-9\b]{8}$"); //length
  // var passed = 0;
  // //Validate
  // for (var i = 0; i < regex.length; i++) {
  //   if (new RegExp(regex[i]).test(password)) {
  //     passed++;
  //   }
  // }
  // if (passed > 2 && password.length > 8) {
  //   passed++;
  // }

  // //Display status.
  // var strength = "";
  // switch (passed) {
  //   case 0:
  //   case 1:
  //   case 2:
  //     strength = "<small class='progress-bar bg-danger' style='width: 30%'></small>";
  //     break;
  //   case 3:
  //     strength = "<small class='progress-bar bg-warning' style='width: 50%'></small>";
  //     break;
  //   case 4:
  //     strength = "<small class='progress-bar bg-warning' style='width: 70%'></small>";
  //     break;
  //   case 5:
  //     strength = "<small class='progress-bar bg-success' style='width: 100%'></small>";
  //     break;

  // }
  // password_strength.innerHTML = strength;

}