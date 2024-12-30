jQuery(document).ready(function ($) {
  if (localStorage.getItem("style-mode") == "dark") {
    $("div.site-logo a img").attr("src", darkLogo);
    $("#style-css").attr("href", darkStyle).addClass("dark-mode");
    localStorage.setItem("style-mode", "dark");
    $(".sw-mode").toggleClass("d-none d-block");
  } else {
    $("#style-css").attr("href", lightStyle).removeClass("dark-mode");
    localStorage.setItem("style-mode", "light");
  }

  jQuery(".listing-wrap").owlCarousel({
    responsive: {
      200: { items: 1 },
      300: { items: 1 },
      600: { items: 2 },
      768: { items: 2 },
      992: { items: 3 },
      1100: { items: 3 },
    },
    loop: true,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ],
    autoplay: false,
    autoplaySpeed: 1000,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    rtl: false,
    center: false,
    dots: false,
    // autoWidth: true,
    margin: 5,
  });

  $(".neighborhood").owlCarousel({
    responsive: {
      200: { items: 1 },
      300: { items: 1 },
      600: { items: 2 },
      768: { items: 2 },
      992: { items: 4 },
      1100: { items: 4 },
    },
    loop: true,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ],
    autoplay: true,
    autoplaySpeed: 2000,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    rtl: false,
    center: false,
    dots: false,
    // autoWidth: true,
    margin: 10,
  });

  $(".teams").owlCarousel({
    responsive: {
      200: { items: 1 },
      300: { items: 1 },
      600: { items: 2.5 },
      768: { items: 3.5 },
      1000: { items: 4 },
      1200: { items: 4 },
    },
    loop: true,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ],
    autoplay: true,
    autoplaySpeed: 2000,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
    rtl: false,
    center: false,
    dots: false,
    margin: 10,
    autoWidth: true,
  });

  $(".card-teams").on("click", function () {
    var url = $(this).data("href");
    if (url) {
      window.location.href = url;
    }
  });

  $(".postlist").owlCarousel({
    responsive: {
      200: { items: 1 },
      300: { items: 1 },
      500: { items: 1.4 },
      600: { items: 2 },
      768: { items: 2 },
      800: { items: 2.4 },
      1000: { items: 2.6 },
      1200: { items: 3 },
      1250: { items: 3.5 },
      1400: { items: 4 },
      1600: { items: 4.3 },
    },
    loop: true,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ],
    autoplay: true,
    autoplaySpeed: 5000,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
    rtl: false,
    center: false,
    dots: false,
    autoWidth: false,
    margin: 10,
  });

  $(".post-related").owlCarousel({
    responsive: {
      200: { items: 1 },
      300: { items: 1 },
      600: { items: 2 },
      768: { items: 2 },
      1000: { items: 3 },
      1200: { items: 3 },
    },
    loop: true,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ],
    autoplay: true,
    autoplaySpeed: 5000,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
    rtl: false,
    center: false,
    dots: false,
    autoWidth: false,
    margin: 10,
  });

  $(".testimonials").owlCarousel({
    items: 1,
    loop: true,
    nav: false,
    autoplay: true,
    dots: true,
    autoplayHoverPause: true,
    autoplaySpeed: 3000,
    autoplayTimeout: 8000,
    onInitialized: startProgressBar,
    onTranslate: resetProgressBar,
    onTranslated: startProgressBar,
  });

  // $(".buy-with-10-percent-down").owlCarousel({
  //     items: 1,
  //     loop: true,
  //     nav: false,
  //     autoplay: true,
  //     dots: true,
  //     autoplayHoverPause: true,
  //     autoplaySpeed: 3000,
  //     autoplayTimeout: 8000,
  //     margin: 10,
  //     onInitialized: startProgressBar,
  //     onTranslate: resetProgressBar,
  //     onTranslated: startProgressBar
  // });

  $(".testimonials .owl-dots").addClass("mystyle-owl-dots");
  $(".properties-category .owl-dots").addClass("mystyle-owl-dots");

  function startProgressBar() {
    $(".slide-progress").css({
      width: "100%",
      transition: "width 5000ms",
    });
  }

  function resetProgressBar() {
    $(".slide-progress").css({
      width: 0,
      transition: "width 0s",
    });
  }

  //menu drop down
  $(".nav-item").click(function (event) {
    if ($(this).find(".submenu").hasClass("setshow")) {
      $(this).find(".submenu").removeClass("setshow").slideUp(200);
    } else {
      $(".setshow").slideUp(200).removeClass("setshow");
      $(this).find(".submenu").addClass("setshow").slideDown(200);
    }
  });
  $(document).click(function (e) {
    var target = e.target;
    if (!$(target).is(".nav-item") && !$(target).parents().is(".nav-item")) {
      $(this).find(".submenu").slideUp(200).removeClass("setshow");
    }
  });
  var timeout;
  $(".sub-item").mouseover(function () {
    clearTimeout(timeout);
    $(this).find(".submenu2").removeClass("setshow2");
    $(".setshow2").slideUp(200).removeClass("setshow2");
    $(this).find(".submenu2").addClass("setshow2").slideDown(200);
  });
  $(".sub-item").mouseout(function () {
    timeout = setTimeout(() => {
      if (!$(this).find(".submenu2:hover").length > 0) {
        $(this).find(".submenu2").slideUp(200);
      }
    }, 500);
  });

  $(".sub-menu ul").hide();
  $(".sub-menu a").click(function () {
    $(this).parent(".sub-menu").children("ul").slideToggle("100");
    $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
  });

  $(".carousel").carousel({
    interval: 12000,
  });

  $(document).on("click", ".fa-share-alt", function () {
    $(this).parents(".card-listing").find(".card-share").addClass("opened");
  });

  $(document).on("click", ".share-close", function () {
    $(this).parent().removeClass("opened");
  });

  $(".fa-share-square-o").click(function () {
    $(this).parent().toggleClass("opened-share-float");
  });

  $(".hlr-tooltip").mouseover(function () {
    $(".hlr-tooltip-popup").remove();
    var item = this;
    var direction = $(item).data("hlr-tooltip-direction");
    if ($(item).find(".hlr-tooltip-popup").length > 0) {
    } else {
      $(item).append(
        '<span class="hlr-tooltip-popup d-none">' +
          $(item).data("hlr-tooltip-title") +
          "</span>",
      );
      switch (direction) {
        case "top":
          $(".hlr-tooltip-popup").addClass("toptooltip").removeClass("d-none");
          break;

        case "right":
          $(".hlr-tooltip-popup")
            .addClass("righttooltip")
            .removeClass("d-none");
          break;

        case "bottom":
          $(".hlr-tooltip-popup")
            .addClass("bottomttooltip")
            .removeClass("d-none");
          break;

        case "left":
          $(".hlr-tooltip-popup").addClass("lefttooltip").removeClass("d-none");
          break;

        default:
          $(".hlr-tooltip-popup").addClass("toptooltip").removeClass("d-none");
          break;
      }
    }
  });
  $(".hlr-tooltip").mouseout(function () {
    $(".hlr-tooltip-popup").remove();
  });

  $(".btn-register").click(function () {
    $(".login-form").addClass("d-none");
    $(".register-form").removeClass("d-none");
    $(".forgot-password-form").addClass("d-none");
  });

  $(".btn-login").click(function () {
    $(".login-form").removeClass("d-none");
    $(".register-form").addClass("d-none");
    $(".forgot-password-form").addClass("d-none");
  });

  $(".btn-forgot-password").click(function () {
    $(".forgot-password-form").removeClass("d-none");
    $(".login-form").addClass("d-none");
    $(".register-form").addClass("d-none");
  });

  $(".menu-account-name").click(function () {
    if (
      $(this).parent().children(".menu-account-body").hasClass("openAnimation")
    ) {
      $(".menu-account-body")
        .addClass("closeAnimation")
        .removeClass("openAnimation");
      setTimeout(() => {
        $(".menu-account-body").removeClass("d-block");
      }, 300);
    } else {
      $(".menu-account-body")
        .removeClass("closeAnimation")
        .addClass(["d-block", "openAnimation"]);
    }
  });

  $(document).click(function (e) {
    var target = e.target;
    if (!$(target).is(".menu-account-name")) {
      $(this)
        .find(".menu-account-body")
        .addClass("closeAnimation")
        .removeClass("openAnimation");
      setTimeout(() => {
        $(".menu-account-body").removeClass("d-block");
      }, 300);
    }
  });

  $(".close-hlr-navigation").click(function () {
    $(".close-hlr-navigation i").toggleClass("fa-arrow-left fa-arrow-right");
    $(".wrap-hlr-navigation").toggleClass("close-nav");
  });

  $(".hlr-navigation-item").on("click", function (event) {
    var target = $(this.getAttribute("href"));
    if (target.length) {
      event.preventDefault();
      $("html, body").stop().animate(
        {
          scrollTop: target.offset().top,
        },
        1000,
      );
    }
  });

  $(".hlr-navigation-item-fixed").on("click", function (event) {
    var target = $(this.getAttribute("href"));
    if (target.length) {
      event.preventDefault();
      $("html, body").stop().animate(
        {
          scrollTop: target.offset().top,
        },
        1000,
      );
    }
  });

  $(".switch-mode").click(function () {
    if ($("#style-css").hasClass("dark-mode")) {
      $("div.site-logo a img").attr("src", lightLogo);
      $("#style-css").attr("href", lightStyle).removeClass("dark-mode");
      $("#hlriLogo").attr("src", hlriLightLogo);
      localStorage.setItem("style-mode", "light");
    } else {
      $("div.site-logo a img").attr("src", darkLogo);
      $("#style-css").attr("href", darkStyle).addClass("dark-mode");
      $("#hlriLogo").attr("src", hlriLightLogo);
      localStorage.setItem("style-mode", "dark");
    }
    $(".sw-mode").toggleClass("d-none d-block");
  });

  var btn = document.getElementById("back-to-top");
  window.addEventListener("scroll", function () {
    if (window.pageYOffset > 100) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  });
  btn.addEventListener("click", function (e) {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  try {
    dataTable = $("#example").DataTable({});

    $(".filter-checkbox").on("change", function (e) {
      var searchTerms = [];
      $.each($(".filter-checkbox"), function (i, elem) {
        if ($(elem).prop("checked")) {
          searchTerms.push("^" + $(this).val() + "$");
        }
      });
      dataTable
        .column(1)
        .search(searchTerms.join("|"), true, false, true)
        .draw();
    });

    $(".status-dropdown").on("change", function (e) {
      var status = $(this).val();
      $(".status-dropdown").val(status);
      dataTable.column(0).search(status).draw();
    });
  } catch (error) {}

  if ($("#table-of-contents").length) {
    var collectionTagH2 = $(".content-original h2");
    var collectionTagH3 = $(".content-original h3");
    var i = 0;
    if (collectionTagH2.length > 0 || collectionTagH3.length > 0) {
      if (collectionTagH2.length > 0) {
        $.each(collectionTagH2, function (index, item) {
          i++;
          $(item).attr("id", "h2" + i);
          $("#tag-list").append(
            '<li><a href="#' +
              "h2" +
              i +
              '" class="item-list-tag" title="">' +
              $(item).text() +
              "</a></li>",
          );
        });
      }
      if (collectionTagH3.length > 0) {
        $.each(collectionTagH3, function (index, item) {
          i++;
          $(item).attr("id", "h3" + i);
          $("#tag-list").append(
            '<li><a href="#' +
              "h3" +
              i +
              '" class="item-list-tag" title="">' +
              $(item).text() +
              "</a></li>",
          );
        });
      }
    } else {
      $("#table-of-contents").remove();
    }
  }

  $(".toggle-list-btn").click(function () {
    $("#tag-list").slideToggle();
    $(".arrow-toggle").toggleClass("fa-arrow-down");
  });
});

function getPropertiesRestApi(className, totalProperty, termID, token) {
  jQuery("." + className)
    .owlCarousel(
      "add",
      '<div class="skeleton">' +
        '   <div class="w-100">' +
        '     <div class="square"></div>' +
        "   </div>" +
        '   <div class="w-100 mt-2">' +
        '     <div class="line mb-3 h25 w75 m10"></div>' +
        '     <div class="line mt-5"></div>' +
        '     <div class="line h8 w50"></div>' +
        '     <div class="line"></div>' +
        '     <div class="line h8 w50"></div>' +
        '     <div class="line  w75"></div>' +
        "   </div>" +
        "</div>",
    )
    .owlCarousel("update");
  jQuery.ajax({
    type: "GET",
    url: home_url + "api/v1/get-properties",
    dataType: "json",
    headers: {
      Authorization: token,
    },
    data: {
      term_id: termID,
      page: totalProperty,
    },
    success: function (json) {
      var list = json.list;

      var indexToRemove = 0;
      jQuery("." + className)
        .trigger("remove.owl.carousel", [indexToRemove])
        .trigger("refresh.owl.carousel")
        .owlCarousel("update");

      jQuery.each(list, function (index, item) {
        var post = item.data;

        var maxPriceSqft = post.metadata["opt-min-price-sqft"]
          ? '<div class="properties-card_price">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg> ' +
            "$" +
            post.metadata["opt-min-price-sqft"] +
            " to $" +
            post.metadata["opt-max-price-sqft"] +
            "</div>"
          : "";

        var incentives = post.metadata['incentives'];
        var incentivesI = incentives['opt_properties_incentives_items'];
        if(incentives['opt_properties_incentives_items']) {
          var incentivesHtml = incentivesI
              .map(function (incentive) {
                return (
                    '<div class="incentive-item">' +
                    '<i class="' +
                    'fas fa-caret-right' +
                    '"></i> ' +
                    incentive['opt-link-incentives'] +
                    "</div>"
                );
              })
              .join("");
        } else{
          incentivesHtml = '';
        }
        console.log(post.metadata["opt-price-min"] + 'empty');
        var minPrice = post.metadata["opt-price-min"]
            ? '<div class="properties-card_price">' +
            '<i class="fas fa-money-bill-wave-alt"></i>' +
            "$" + post.metadata["opt-price-min"] +
            " - $" +
            post.metadata["opt-price-max"] +
            "" +
            "</div>"
            : "";
        var minSize = post.metadata["opt-size-min"]
            ? '<div class="properties-card_size">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/></svg>' +
            post.metadata["opt-size-min"] +
            " - " +
            post.metadata["opt-size-max"] +
            " Sq Ft" +
            "</div>"
            : "";

        var address = post.metadata["opt-address"]
          ? '<div class="properties-card_addr">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>' +
            post.metadata["opt-address"] +
            "</div>"
          : "";

        var occupancy = post.metadata["opt-occupancy"]
          ? '<div class="properties-card_addr">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>' +
            "Built in" +
            post.metadata["opt-occupancy"] +
            "</div>"
          : "";

        var title =
          post.title.length > 18
            ? post.title.substring(0, 18) + "..."
            : post.title;

        var description =
          post.content.length > 44
            ? post.content.substring(0, 44) + "..."
            : post.content;

        var likeColor = getCookie(post.id) == "isset" ? "red" : "";

        var totalLike = post.metadata["total_like"]
          ? post.metadata["total_like"]
          : "Like";

        var dynamicCard =
          '<div class="px-2 mb-5">' +
          '    <div class="properties-card">' +
          '        <div class="properties-card_image">' +
          '            <a href="' +
          post.permalink +
          '" title="' +
          title +
          '">' +
          '<img src="' +
          post.thumbnail_url +
          '" alt="' +
          title +
          '" loading="lazy" />' +
          "</a>" +
          "</div>" +
          '        <div class="properties-card_detail">' +
          '            <div class="properties-card_title">' +
          '                 <a href="' +
          post.permalink +
          '" title="' +
          title +
          '">' +
          '                    <h6 class="text-black">' +
          title +
          "</h6>" +
          "                </a>" +
          "            </div>" +
          '            <div class="properties-card_desc">' +
          '                 <a href="' +
          post.permalink +
          '" title="' +
          title +
          '">' +
          description +
          "                </a>" +
          "<div class=\"incentive-item-group text-black\">" + incentivesHtml + "</div>" +
          "            </div>" +
          '            <div class="properties-card_opt">' +
          maxPriceSqft +
            minSize +
            minPrice +
          address +
          occupancy +
          "            </div>" +
          '            <div class="properties-card_actions">' +
          '                <div onclick="setLikeProperties(this, ' +
          post.id +
          ')" role="button" class="properties-card_actions_btn">' +
          '                    <i class="fa fa-heart"' +
          (likeColor ? ' style="color:' + likeColor + '"' : "") +
          "></i>" +
          '                    <span id="like-total">' +
          totalLike +
          "</span>" +
          "                </div>" +
          '  <div style="" class="properties-card_actions_btn" role="button" onclick="bookmark(this, ' +
            post.id +
            ')"> ' +
          `<i class="fa fa-bookmark"></i>` +
          "</div>" +
          "            </div>" +
          "        </div>" +
          "    </div>" +
          "</div>";

        jQuery("." + className)
          .owlCarousel("add", dynamicCard)
          .owlCarousel("update");
      });
      jQuery(".owl-carousel").trigger("refresh.owl.carousel");
    },
    error: function (xhr, status, errorThrown) {
      xhr.status;
      xhr.responseText;
    },
  });
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}


// disable copy
// function killCopy(e) {
//   return false;
// }
// function reEnable() {
//   return true;
// }
// document.onselectstart = new Function("return false");
// if (window.sidebar) {
//   document.onmousedown = killCopy;
//   document.onclick = reEnable;
// }
