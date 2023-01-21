"use strict";

export class InputErrorUtils {
  /**
   * Display error on modal
   * @param {String} message - displaying text ;
   * @param {HTMLElement} target - a valid html element ;
   */
  static showErrorBox(message, target) {
    let span = document.createElement("span");
    span.className = "msgBx";
    span.innerHTML = `❓<span id="msgBxError" class="msgBxError">${message}</span>`;
    target.parentElement.append(span);
  }

  /**
   * Display  modal when valid
   * @param {String} message - displaying text ;
   * @param {HTMLElement} target - a valid html element ;
   */
  static addValidBox(message, target) {
    let span = document.createElement("span");
    span.className = "msgBx";
    span.classList.add("msgBxValid");
    span.innerHTML = `✔<span id="msgBxValid" class="msgBxValid">${message}</span>`;
    target.parentElement.append(span);
  }

  /**
   * Remove error  modal
   * @param {HTMLElement} target - a valid html element
   */
  static removeErrorBox(target) {
    target.childNodes.forEach((el) => {
      if (el.className && el.classList.contains("msgBx")) el.remove();
    });
  }
}
