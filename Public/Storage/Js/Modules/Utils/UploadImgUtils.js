// turn js on strict mode
"use strict";

/**
 * change template profil
 * @param {String} profil valid selector - profil input field;
 * @param {String} profilBx valid selector - profil input field container ;
 */
export function newProfil(profil, profilBx) {
  document.querySelector(profil).addEventListener("change", function (files) {
    files = this.files;

    for (let i = 0; i < files.length; i++) {
      let file = files[i];
      let imageType = /^image\//;

      if (!imageType.test(file.type)) {
        continue;
      }

      let img = document.createElement("img");
      img.classList.add("profil");
      img.file = file;

      if (document.querySelectorAll(profil)) {
        let prev = document.querySelectorAll(profil);
        prev.forEach((el) => document.querySelector(profilBx).removeChild(el));
      }
      document.querySelector(profilBx).appendChild(img); // En admettant que "preview" est l'élément div qui contiendra le contenu affiché.

      let reader = new FileReader();
      reader.onload = (function (aImg) {
        return function (e) {
          aImg.src = e.target.result;
        };
      })(img);
      reader.readAsDataURL(file);
    }
  });
}
