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
    $($(".c_row_form")).append($(".comment_form"));
    $(param).html('<i class="fa fa-reply-all" aria-hidden="true"></i> Reply');
    $("#reply_form").attr({
      "id": "comm_form",
      "name": "comm_form",
      "onsubmit": "Su_Cm(event)"
    });
    $(".comment_form h3").text("LEAVE A COMMENT");
    $("#c_scrt_p_j").attr("name", "comm");

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