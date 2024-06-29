import { addEventListenerInBtnAlterMenu } from "./sidebar.js";
import { addEventListenerInBtnAlterMenuMobile } from "./header.js";
import { addListenerInBntsEditionUserSettings } from "./user-settings.js";

window.onload = () => {
  addEventListenerInBtnAlterMenu();
  addEventListenerInBtnAlterMenuMobile();
  addListenerInBntsEditionUserSettings();
};
