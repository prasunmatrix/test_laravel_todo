$.validator.addMethod("valid_email", function (value, element) {
  if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
    return true;
  } else {
    return false;
  }
}, "Please enter a valid email");
$.validator.addMethod("valid_number", function(value, element) {
  if (/^[0-9]\d*(\.\d+)?$/.test(value)) {
      return true;
  } else {
      return false;
  }
});

$(document).ready(function () {
  //add user  
  $("#userAdd").validate({
    rules: {
      full_name: {
        required: true,
        minlength: 2,
        maxlength: 255
      },
      email: {
        required: true,
        valid_email: function () {
          if ($("#email").val() != '') {
            return true;
          }
        }
      },
      password: {
        required: true,
      },
      confirm_password: {
        required: true,
        equalTo: "#password"
      }
    },
    messages: {
      full_name: {
        required: "Please enter full name",
        minlength: "Full name should be atleast 2 characters",
        maxlength: "Full name must not be more than 255 characters"
      },
      email: {
        required: "Please enter email",
      },
      password: {
        required: "Please enter new password",
      },
      confirm_password: {
        required: "Please enter confirm password",
        equalTo: "Password should be same as new password"
      }
    }
  });

  //edit user 
  $("#userEdit").validate({
    rules: {
      full_name: {
        required: true,
        minlength: 2,
        maxlength: 255
      },
      email: {
        required: true,
        valid_email: function () {
          if ($("#email").val() != '') {
            return true;
          }
        }
      }
    },
    messages: {
      full_name: {
        required: "Please enter full name",
        minlength: "Full name should be atleast 2 characters",
        maxlength: "Full name must not be more than 255 characters"
      },
      email: {
        required: "Please enter email",
      }
    }
  });
  /* Admin Password Update */
  $("#updateAdminPassword").validate({
    rules: {
      current_password: {
        required: true,
      },
      new_password: {
        required: true,
      },
      confirm_password: {
        required: true,
        equalTo: "#new_password"
      }
    },
    messages: {
      current_password: {
        required: "Please enter current password",
      },
      new_password: {
        required: "Please enter new password",
      },
      confirm_password: {
        required: "Please enter confirm password",
        equalTo: "Password should be same as new password",
      }
    },
    submitHandler: function (form) {
      form.submit();
    }
  });
  /* news validation */
  $("#newsAdd").validate({
    rules: {
      news_date: {
        required: true,
      },
      slot: {
        required: true,
      }
    },
    messages: {
      news_date: {
        required: "Please enter news date",
      },
      slot: {
        required: "Please select a slot",
      }
    },
    submitHandler: function (form) {
      form.submit();
    }
  });
  $("#pageAdd").validate({
    rules: {
      page_number: {
        required: true,
        valid_number: true
      },
      page_preview:{
        required: true
      },
      template: {
        required: true,
      }
    },
    messages: {
      page_number: {
        required: "Please enter page number",
      },
      page_preview: {
        required: "Please select a jpeg,jpg,png file",
      },
      template: {
        required: "Please create template",
      }
    },
    submitHandler: function (form) {
      form.submit();
    }
  });
  $("#pageEdit").validate({
    rules: {
      page_number: {
        required: true,
        valid_number: true
      },
      // page_preview:{
      //   required: true
      // },
      template: {
        required: true,
      }
    },
    messages: {
      page_number: {
        required: "Please enter page number",
      },
      // page_preview: {
      //   required: "Please select a jpeg,jpg,png file",
      // },
      template: {
        required: "Please create template",
      }
    },
    submitHandler: function (form) {
      form.submit();
    }
  });
  $("#todoAdd").validate({
    rules: {
      task_name: {
        required: true,
        minlength: 2,
        maxlength: 255
      },
      task_description: {
        required: true,
        minlength: 2,
        maxlength: 255
      }
    },
    messages: {
      task_name: {
        required: "Please enter task name",
        minlength: "Task name should be atleast 2 characters",
        maxlength: "Task name must not be more than 255 characters"
      },
      task_description: {
        required: "Please enter task description",
        minlength: "Task description should be atleast 2 characters",
        maxlength: "Task description must not be more than 255 characters"
      }
    }
  });
});