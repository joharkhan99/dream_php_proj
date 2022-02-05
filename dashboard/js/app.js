const hideAlert = () => {
  const el = document.querySelector('.cust_alert');
  if (el)
    el.parentElement.removeChild(el);
};

const showAlert = (msg, time = 4) => {
  hideAlert();
  const markup = `<div class="cust_alert">${msg}</div>`;
  document.querySelector('body').insertAdjacentHTML('afterbegin', markup);
  window.setTimeout(hideAlert, time * 1000);
};

$(document).ready(function () {
  $('#summernote').summernote({
    height: 300,
    callbacks: {
      onImageUpload: function (files, editor, welEditable) {
        sendFile(files[0], editor, welEditable);
      },
      onMediaDelete: function (target) {
        deleteFile(target[0].src);
      }
    }
  });


  function deleteFile(src) {
    $.ajax({
      data: {
        src: src
      },
      type: "POST",
      url: "../ajax/d_img.php",
      cache: false,
      success: function (resp) { }
    });
  }

  function sendFile(file, editor, welEditable) {
    var data = new FormData();
    data.append("file", file);
    $.ajax({
      url: "../ajax/u_img.php",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function (url) {
        if (url.includes('0_e_0')) {
          showAlert(url.replace('0_e_0', ''));
        } else {
          var image = $('<img>').attr({
            'src': url,
          });
          $('#summernote').summernote("insertNode", image[0]);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus + " " + errorThrown);
      }
    });
  }

});

function A_B() {
  var formData = new FormData();
  formData.append('article-title', $("#article-title").val());
  formData.append('article-file', document.getElementById('article_file').files[0]);
  const tags = Array.from(document.querySelector('#article-tags').children, ({ textContent }) => textContent.trim()).filter(Boolean).join(',');
  formData.append('article-tags', tags);
  formData.append('article-category-select', document.getElementById("article-category-select").value);
  formData.append('article-category-input', document.getElementById("article-category-input").value);
  formData.append('body', $(".note-editable").html());

  $.ajax({
    type: "post",
    url: "../ajax/ab.php",
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $('form[id="add_form"] button[type="submit"]').addClass("spinner");
      $('form[id="add_form"] button.draftbtn').addClass('disabled');
    },
    success: function (response) {
      if (response.includes('0_e_0')) {
        showAlert(response.replace('0_e_0', ''));
        $('form[id="add_form"] button[type="submit"]').removeClass("spinner");
        $('form[id="add_form"] button.draftbtn').removeClass('disabled');
      } else {
        showAlert(response);
        $('form[id="add_form"] button[type="submit"]').removeClass("spinner");
        $('form[id="add_form"] button.draftbtn').removeClass('disabled');
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      }
    }
  });

};

function S_D() {
  var formData = new FormData();
  formData.append('article-title', $("#article-title").val());
  formData.append('article-file', document.getElementById('article_file').files[0]);
  const tags = Array.from(document.querySelector('#article-tags').children, ({ textContent }) => textContent.trim()).filter(Boolean).join(',');
  formData.append('article-tags', tags);
  formData.append('article-category-select', document.getElementById("article-category-select").value);
  formData.append('article-category-input', document.getElementById("article-category-input").value);
  formData.append('body', $(".note-editable").html());

  $.ajax({
    type: "post",
    url: "../ajax/draft.php",
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $('form[id="add_form"] button[type="submit"]').addClass("disabled");
      $('form[id="add_form"] button.draftbtn').addClass('spinner2');
    },
    success: function (response) {
      if (response.includes('0_e_0')) {
        showAlert(response.replace('0_e_0', ''));
        $('form[id="add_form"] button[type="submit"]').removeClass("disabled");
        $('form[id="add_form"] button.draftbtn').removeClass('spinner2');
      } else {
        showAlert(response);
        $('form[id="add_form"] button[type="submit"]').removeClass("disabled");
        $('form[id="add_form"] button.draftbtn').removeClass('spinner2');
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      }
    }
  });
};

function U_B() {
  var formData = new FormData();
  formData.append('body', $(".note-editable").html());;
  formData.append('blog_title', $("#blog_title").val());
  formData.append('blog_id', $("#blog_id").val());
  formData.append('blog_feature_image', document.getElementById('blog_feature_image').files[0]);

  $.ajax({
    type: "post",
    url: "../ajax/updateblog.php",
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $(".spin_overlay").css("display", "flex");
    },
    success: function (response) {
      if (response.includes('0_e_0')) {
        showAlert(response.replace('0_e_0', ''));
        $(".spin_overlay").css("display", "none");
      } else {
        showAlert(response);
        $(".spin_overlay").css("display", "none");
        setTimeout(() => {
          window.location.href = 'published.php';
        }, 3000);
      }
    }
  });
};

// article tags
$('#article-tags input').on('keyup', function (e) {
  var key = e.which;
  if (key == 188) {
    $('<button class="mb-1"/>').text($(this).val().slice(0, -1)).insertBefore($(this));
    $(this).val('').focus();
  };
});

$('#article-tags').on('click', 'button', function (e) {
  e.preventDefault();
  $(this).remove();
  return false;
});

function U_P() {
  var formData = new FormData();
  formData.append('profile_name', $("#profile_name").val());
  formData.append('profile_bio', $("#profile_bio").val());
  formData.append('profile_image', document.getElementById('updated_profile_pic').files[0]);

  $.ajax({
    type: "post",
    url: "../ajax/up.php",
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $('form[id="update_profile_form"] button[type="submit"]').addClass("spinner");
    },
    success: function (response) {
      if (response.includes('0_e_0')) {
        showAlert(response.replace('0_e_0', ''));
        $('form[id="update_profile_form"] button[type="submit"]').removeClass("spinner");
      } else {
        showAlert(response);
        $('form[id="update_profile_form"] button[type="submit"]').removeClass("spinner");
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      }
    }
  });
};

function C_P() {
  var formData = new FormData();
  formData.append('pass', $("#change_pass_form #pass").val());
  formData.append('cnfm_pass', $("#change_pass_form #cnfm_pass").val());

  $.ajax({
    type: "post",
    url: "../ajax/cp.php",
    data: formData,
    processData: false,
    contentType: false,
    beforeSend: function () {
      $('form[id="change_pass_form"] button[type="submit"]').addClass("spinner");
    },
    success: function (response) {
      if (response.includes('0_e_0')) {
        showAlert(response.replace('0_e_0', ''));
        $('form[id="change_pass_form"] button[type="submit"]').removeClass("spinner");
      } else {
        showAlert(response);
        $('form[id="change_pass_form"] button[type="submit"]').removeClass("spinner");
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      }
    }
  });
};