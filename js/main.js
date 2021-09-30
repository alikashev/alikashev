(function ($) {
    "use strict";
    
    // Smooth scrolling on the navbar links
    $(".navbar-nav a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            
            $('html, body').animate({
                scrollTop: $(this.hash).offset().top - 30
            }, 1500, 'easeInOutExpo');
            
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
            typeSpeed: 100,
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

// splash screen 

const splash = document.querySelector('.splash');

document.addEventListener('DOMContentLoaded', (e)=>{
    setTimeout(()=>{
        splash.classList.add('display-none');
    }, 3000);
})

// contact form 

$(document).ready(function () {
    $(".form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();
       var formData = {
         name: $("#form-name").val(),
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
          '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
        );
      });
      event.preventDefault();
    });
  });
