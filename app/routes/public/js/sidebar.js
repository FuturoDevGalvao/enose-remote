const getMenuSideBarElements = () => {
  return {
    menuSidebar: document.querySelector(".menu-sidebar"),
    btnAlterMenu: document.getElementById("btn-alter-menu"),
  };
};

const showMenuSidebar = () => {
  const { menuSidebar } = getMenuSideBarElements();
  menuSidebar.classList.add("minimize-menu-sidebar");
};

const hidenMenuSidebar = () => {
  const { menuSidebar } = getMenuSideBarElements();
  menuSidebar.classList.remove("minimize-menu-sidebar");
};

export const addEventListenerInBtnAlterMenu = () => {
  const { btnAlterMenu, menuSidebar } = getMenuSideBarElements();

  btnAlterMenu.addEventListener("click", () => {
    if (menuSidebar.classList.contains("minimize-menu-sidebar")) {
      btnAlterMenu.classList.add("fa-circle-chevron-left");
      btnAlterMenu.classList.remove("fa-circle-chevron-right");
      hidenMenuSidebar();
    } else {
      btnAlterMenu.classList.add("fa-circle-chevron-right");
      btnAlterMenu.classList.remove("fa-circle-chevron-left");
      showMenuSidebar();
    }
  });
};

/* window.onload = () => {
  addEventListenerInBtnAlterMenu();
};
 */
