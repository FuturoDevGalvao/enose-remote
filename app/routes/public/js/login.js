const getElemetsLoginForm = () => {
  return {
    loginForm: document.getElementById("log-in-form"),
    inputEmail: {
      element: document.getElementById("input-email"),
      errMsg: document.getElementById("email-error-message"),
    },
    inputPassword: {
      element: document.getElementById("input-password"),
      errMsg: document.getElementById("password-error-message"),
      btnShowPass: document.getElementById("btn-show-password"),
    },
  };
};

const toggleTypeInputPass = () => {
  const { inputPassword } = getElemetsLoginForm();

  switch (inputPassword.element.type) {
    case "password":
      inputPassword.btnShowPass.classList.remove("fa-eye");
      inputPassword.btnShowPass.classList.add("fa-eye-slash");
      inputPassword.element.setAttribute("type", "text");
      break;
    case "text":
      inputPassword.btnShowPass.classList.remove("fa-eye-slash");
      inputPassword.btnShowPass.classList.add("fa-eye");
      inputPassword.element.setAttribute("type", "password");
      break;
  }
};

const showErrorMessage = (input, empty = false) => {
  if (empty) {
    input.errMsg.classList.add("show-error-message");
  } else {
    input.errMsg.classList.remove("show-error-message");
  }
};

const validateInputs = ({ inputEmail, inputPassword }) => {
  let allValid = true;

  [inputEmail, inputPassword].forEach((i) => {
    const isEmpty = i.element.value.trim() === "";
    showErrorMessage(i, isEmpty);
    if (isEmpty) {
      allValid = false;
    }
  });

  return allValid;
};

const validateFormForSubmit = () => {
  const { loginForm } = getElemetsLoginForm();

  loginForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const allInputsValid = validateInputs(getElemetsLoginForm());

    if (allInputsValid) loginForm.submit();
  });
};

const getElemetsModal = () => {
  return {
    modal: document.querySelector(".modal-contain"),
    btnCloseModal: document.getElementById("btb-close-modal"),
  };
};

const closeModal = () => {
  const { modal } = getElemetsModal();
  modal.classList.add("close-modal-contain");
};

window.onload = () => {
  validateFormForSubmit();

  const { inputPassword, inputEmail } = getElemetsLoginForm();
  inputPassword.btnShowPass.addEventListener("click", toggleTypeInputPass);

  [inputEmail, inputPassword].forEach((i) =>
    i.element.addEventListener("input", () => {
      showErrorMessage(i);
    })
  );

  /*inputEmail.element.focus();*/

  const { btnCloseModal, modal } = getElemetsModal();
  [btnCloseModal, modal].forEach((e) => {
    if (e !== null) e.addEventListener("click", closeModal);
  });
};
