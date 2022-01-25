const scrollElements = document.querySelectorAll(".js-scroll");
const scrollleft = document.querySelectorAll(".js-scroll-left");
const scrollright = document.querySelectorAll(".js-scroll-right");
const scrollbottom = document.querySelectorAll(".js-scroll-bottom");
const scrolltop = document.querySelectorAll(".js-scroll-top");
const scrollflow = document.querySelectorAll(".js-scroll-flow");
const elementInView = (el, dividend = 1) => {
  const elementTop = el.getBoundingClientRect().top;
  return (
    elementTop <=
    (window.innerHeight || document.documentElement.clientHeight) / dividend
  );
};
const elementOutofView = (el) => {
  const elementTop = el.getBoundingClientRect().top;
  return (
    elementTop > (window.innerHeight || document.documentElement.clientHeight)
  );
};
const displayScrollElement = (element, animation) => {
  element.classList.add(animation);
};
const hideScrollElement = (element, animation) => {
  element.classList.remove(animation);
};
const handleScrollAnimation = () => {
  scrollElements.forEach((el) => {
    if (elementInView(el, 1.25)) {
      displayScrollElement(el, "scrolled");
    } else if (elementOutofView(el)) {
      hideScrollElement(el, "scrolled");
    }
  });
  scrollleft.forEach((el2) => {
    if (elementInView(el2, 1)) {
      displayScrollElement(el2, "left-animation");
    } else if (elementOutofView(el2)) {
      hideScrollElement(el2, "left-animation");
    }
  });
  scrollright.forEach((el) => {
    if (elementInView(el, 1)) {
      displayScrollElement(el, "right-animation");
    } else if (elementOutofView(el)) {
      hideScrollElement(el, "right-animation");
    }
  });
  scrollbottom.forEach((el) => {
    if (elementInView(el, 1)) {
      displayScrollElement(el, "bottom-animation");
    } else if (elementOutofView(el)) {
      hideScrollElement(el, "bottom-animation");
    }
  });
  scrolltop.forEach((el) => {
    if (elementInView(el, 1)) {
      displayScrollElement(el, "top-animation");
    } else if (elementOutofView(el)) {
      hideScrollElement(el, "top-animation");
    }
  });
  scrollflow.forEach((el) => {
    if (elementInView(el, 1)) {
      displayScrollElement(el, "flow-animation");
    } else if (elementOutofView(el)) {
      hideScrollElement(el, "flow-animation");
    }
  });
};
window.addEventListener("scroll", () => {
  handleScrollAnimation();
});

if ($(window).width() < 720) {
  $(".integ").removeClass("col-6");
  $(".integ").css({
    "margin-bottom": "50px",
  });
}
