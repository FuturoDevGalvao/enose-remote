export const addEventListenerInBtnAlterMenuMobile = () => {
  const btnMenuMobile = document.getElementById("btn-menu-mobile");
  const menuMobile = document.querySelector(".menu-mobile");

  btnMenuMobile.addEventListener("click", () => {
    menuMobile.classList.toggle("show-menu-mobile");

    if (btnMenuMobile.classList.contains("fa-bars")) {
      btnMenuMobile.classList.remove("fa-bars");
      btnMenuMobile.classList.add("fa-xmark");
    } else {
      btnMenuMobile.classList.remove("fa-xmark");
      btnMenuMobile.classList.add("fa-bars");
    }
  });
};
