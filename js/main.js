(function ($) {
    "use strict";
    
    // Smooth scrolling on the navbar links
    $(".navbar-nav a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            
            $('html, body').animate({
                scrollTop: $(this.hash).offset().top - 30
            }, 100, 'easeInOutExpo');
            
            if ($(this).parents('.navbar-nav').length) {
                $('.navbar-nav .active').removeClass('active');
                $(this).closest('a').addClass('active');
            }
        }
    });
    

    // Typed Initiate
    if ($('.header h4').length == 1) {
        var typed_strings = $('.header .typed-text').text();
        var typed = new Typed('.header h4', {
            strings: typed_strings.split(', '),
            typeSpeed: 40,
            backSpeed: 20,
            smartBackspace: false,
            loop: true
        });
    }
    
    
    // Skills
    $('.skills').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});
    
    
    // Porfolio isotope and filter
    var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });

    $('#portfolio-flters li').on('click', function () {
        $("#portfolio-flters li").removeClass('filter-active');
        $(this).addClass('filter-active');

        portfolioIsotope.isotope({filter: $(this).data('filter')});
    });
    
    
    // Review slider
    $('.review-slider').slick({
        autoplay: true,
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
})(jQuery);

//splash screen 

const splash = document.querySelector('.splash');

document.addEventListener('DOMContentLoaded', (e)=>{
   setTimeout(()=>{
       splash.classList.add('display-none');
   }, 3000);
})

//contact form 

$(document).ready(function () {
    $(".contactForm").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();
       var formData = {
         contact_name: $("#form-name").val(),
         email: $("#form-email").val(),
         subject: $("#form-subject").val(),
         contactmessage: $("#form-message").val(),
       };
      $.ajax({
        type: "POST",
        url: "process.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
      console.log(data.contact_name);
      console.log(email);
      console.log(subject);
      console.log(contactmessage);
        if (!data.success) {
            if (data.errors.name) {
              $("#form-name").addClass("has-error");
              $("#form-name").append(
                '<div class="help-block">' + data.errors.name + "</div>"
              );
            }
    
            if (data.errors.email) {
              $("#form-email").addClass("has-error");
              $("#form-email").append(
                '<div class="help-block">' + data.errors.email + "</div>"
              );
            }
    
            if (data.errors.subject) {
              $("#form-subject").addClass("has-error");
              $("#form-subject").append(
                '<div class="help-block">' + data.errors.subject + "</div>"
              );
            }
    
            if (data.errors.contactmessage) {
                $("#form-message").addClass("has-error");
                $("#form-message").append(
                  '<div class="help-block">' + data.errors.contactmessage + "</div>"
              );
            }
          }else {
            $("form").html(
              '<div class="alert alert-success">' + data.message + "</div>"
            );
          }
      }).fail(function (data) {
        $("form").html(
          '<div class="alert alert-danger">Fouttttt, je bericht is niet gestuurd. Probeer het later opnieuw.</div>'
        );
        console.log(data);
      });
      event.preventDefault();
    });
  });

  //Recaptcha check

  window.addEventListener('load', () => {
    const $recaptcha = document.querySelector('#g-recaptcha-response');
    if ($recaptcha) {
      $recaptcha.setAttribute('required', 'required');
    }
  })


  // read more 

  function readMore() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "lees meer";
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "lees minder";
      moreText.style.display = "inline";
    }
  }

  function readMore1() {
    var dots1 = document.getElementById("dots1");
    var moreText1 = document.getElementById("more1");
    var btnText1 = document.getElementById("myBtn1");
  
    if (dots1.style.display === "none") {
      dots1.style.display = "inline";
      btnText1.innerHTML = "lees meer";
      moreText1.style.display = "none";
    } else {
      dots1.style.display = "none";
      btnText1.innerHTML = "lees minder";
      moreText1.style.display = "inline";
    }
  }

  function readMore2() {
    var dots2 = document.getElementById("dots2");
    var moreText2 = document.getElementById("more2");
    var btnText2 = document.getElementById("myBtn2");
  
    if (dots2.style.display === "none") {
      dots2.style.display = "inline";
      btnText2.innerHTML = "lees meer";
      moreText2.style.display = "none";
    } else {
      dots2.style.display = "none";
      btnText2.innerHTML = "lees minder";
      moreText2.style.display = "inline";
    }
  }

  function readMore3() {
    var dots3 = document.getElementById("dots3");
    var moreText3 = document.getElementById("more3");
    var btnText3 = document.getElementById("myBtn3");
  
    if (dots3.style.display === "none") {
      dots3.style.display = "inline";
      btnText3.innerHTML = "lees meer";
      moreText3.style.display = "none";
    } else {
      dots3.style.display = "none";
      btnText3.innerHTML = "lees minder";
      moreText3.style.display = "inline";
    }
  }

  function readMore4() {
    var dots4 = document.getElementById("dots4");
    var moreText4 = document.getElementById("more4");
    var btnText4 = document.getElementById("myBtn4");
  
    if (dots4.style.display === "none") {
      dots4.style.display = "inline";
      btnText4.innerHTML = "lees meer";
      moreText4.style.display = "none";
    } else {
      dots4.style.display = "none";
      btnText4.innerHTML = "lees minder";
      moreText4.style.display = "inline";
    }
  }

  function readMore5() {
    var dots5 = document.getElementById("dots5");
    var moreText5 = document.getElementById("more5");
    var btnText5 = document.getElementById("myBtn5");
  
    if (dots5.style.display === "none") {
      dots5.style.display = "inline";
      btnText5.innerHTML = "lees meer";
      moreText5.style.display = "none";
    } else {
      dots5.style.display = "none";
      btnText5.innerHTML = "lees minder";
      moreText5.style.display = "inline";
    }
  }