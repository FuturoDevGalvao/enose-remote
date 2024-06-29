const getModalElements = () => {
  return {
    modal: document.querySelector(".modal-contain"),
    buttons: {
      btnConfirmEdition: document.getElementById("btn-confirm-edition"),
      btnToDenyEdition: document.getElementById("btn-cancel-edition"),
    },
  };
};

const getFormElements = () => {
  return {
    form: document.querySelector("form"),
    inputs: {
      inputProfileImage: document.getElementById("inputProfileImage"),
      inputName: document.getElementById("inputName"),
      inputEmail: document.getElementById("inputEmail"),
      inputPassword: document.getElementById("inputPassword"),
    },
    buttons: {
      btnEdit: document.getElementById("btn-edit-user-settings"),
      btnsActionsContain: {
        actionContain: document.querySelector(".contain-btns-action"),
        btnSaveEdition: document.getElementById("btn-save-edit-user-settings"),
        btnCalcelEdition: document.getElementById("btn-calcel-edit-user-settings"),
      },
    },
  };
};

const toggleVisibilityModalConfirmEditions = () => {
  const { modal } = getModalElements();

  modal.classList.toggle("show-modal-contain");
};

const toggleModeInput = (input) => {
  input.readOnly = !input.readOnly;
  input.classList.toggle("edition-mode");
};

const toggleVisibilityActionBtnsContain = () => {};

const activeEditionMode = () => {
  const { inputName, inputEmail, inputPassword } = getFormElements().inputs;
  const { btnEdit, btnsActionsContain } = getFormElements().buttons;
  const { actionContain } = btnsActionsContain;

  [inputName, inputEmail, inputPassword].forEach((input) => {
    toggleModeInput(input);
  });

  btnEdit.classList.toggle("hide-btn-edit-user-settings");
  actionContain.classList.toggle("show-action-btns-contain");
};

export const addListenerInBntsEditionUserSettings = () => {
  const { btnEdit, btnsActionsContain } = getFormElements().buttons;
  const { btnSaveEdition, btnCalcelEdition, actionContain } = btnsActionsContain;
  const { btnConfirmEdition, btnToDenyEdition } = getModalElements().buttons;

  btnEdit.addEventListener("click", activeEditionMode);

  btnSaveEdition.addEventListener("click", () => {
    toggleVisibilityModalConfirmEditions();
  });

  btnCalcelEdition.addEventListener("click", activeEditionMode);

  btnToDenyEdition.addEventListener("click", toggleVisibilityModalConfirmEditions);
};
