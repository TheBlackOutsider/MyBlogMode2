//turn javascript on strict mode
"use strict";

//import neccessary modules
import { ValidationUtils } from "./Modules/Utils/ValidationUtils.js";
import { InputErrorUtils } from "./Modules/Utils/InputErrorUtils.js";
import { Ajax } from "./Modules/Utils/Ajax.js";

//wait dom loading and call function run
document.addEventListener("DOMContentLoaded", function () {
  //MAKE STICKY HEADER
  (function () {
    document
      .querySelector("header")
      .classList.toggle("sticky", window.scrollY > 10);
    window.addEventListener("scroll", function () {
      document
        .querySelector("header")
        .classList.toggle("sticky", window.scrollY > 10);
    });
  })();
  //MAKE THE SPECIAL HEADER
  (function () {
    let homePage = document.querySelector("main.homePage");
    if (!homePage) {
      document.querySelector("header").classList.add("specialHeader");
    }
  })();
  //MAKE CURRENT PAGE LINK ACTIVE
  (function () {
    let homePage = document.querySelector("main.homePage");
    let feedbackPage = document.querySelector("main.feedbackPage");
    let builderPage = document.querySelector("main.builderPage");
    if (homePage)
      document.querySelector("#homePageLink").classList.add("active");
    if (feedbackPage)
      document.querySelector("#feedbackPageLink").classList.add("active");
    if (builderPage)
      document.querySelector("#builderPageLink").classList.add("active");
  })();
  //SHOW HEADER ACCOUNT MODAL
  (function () {
    if (document.querySelector("#showAccountBtn")) {
      document
        .querySelector("#showAccountBtn")
        .addEventListener("click", function (ev) {
          ev.preventDefault();
          document.querySelector("#accountModal").classList.toggle("showModal");
          document.querySelector("#accountModal").classList.remove("hideModal");
        });
    }
  })();
  //CLOSE HEADER ACCOUNT MODAL
  (function () {
    if (document.querySelector("#closeShowAccount")) {
      document
        .querySelector("#closeShowAccount")
        .addEventListener("click", function (ev) {
          ev.preventDefault();
          document.querySelector("#accountModal").classList.toggle("hideModal");
          document.querySelector("#accountModal").classList.remove("showModal");
        });
    }
  })();
  //REGISTRATION FORM VALIDATION
  (function () {
    if (document.querySelector("#registrationPage")) {
      //REALTIME VALIDATION
      let em, pwd, cpwd;
      document.querySelectorAll("input").forEach((el) => {
        el.addEventListener("keyup", function (ev) {
          //check input type text not username
          if (this.type === "text") {

            if (ValidationUtils.nameChecker(this.value)) {

              if (this.classList.contains("not-valid")) {
                this.classList.remove("not-valid");
                InputErrorUtils.removeErrorBox(this.parentElement);
              }
              InputErrorUtils.addValidBox('', this);
            } else {

              InputErrorUtils.removeErrorBox(this.parentElement);
              this.classList.add("not-valid");
              //define error
              let err = `Ne peut contenir que des lettres, des chiffres et les caractères spéciaux: '_', '-', '.' Au moins 3 et au plus 40 caractères.`;
              //show error
              if (!this.nextElementSibling)
                InputErrorUtils.showErrorBox(err, this);

            }

          }

          //check input type email
          if (this.type === "email") {

            if (ValidationUtils.emailChecker(this.value)) {//true/false

              ///attempt ajax value
              Ajax.http('/getUserEmail', 'post', 'application/json', 'application/json', JSON.stringify({ "payload": `${this.value}` })).then(data => validate(data));
              //function that will be executed by ajax response
              function validate(response) {

                //on verifie si l'input contient la classe "not valid" ou si la donnée renvoyé par la requete ajax est vide
                if (el.classList.contains("not-valid") && response.code != 200) {
                  //si oui on retire la classe "not valid"
                  el.classList.remove("not-valid");
                  //ensuite on retire l'icone "?"
                  InputErrorUtils.removeErrorBox(el.parentElement);
                  //puis on ajoute l'icone valide "✔"
                  InputErrorUtils.addValidBox('', el);

                } else if (!el.classList.contains("not-valid") && response.code != 200) {

                }
                else {
                  //sinon  on retire l'icone de validation "? ou v"
                  InputErrorUtils.removeErrorBox(el.parentElement);
                  //puis on rajoute la classe "not valid" 
                  el.classList.add("not-valid");
                  //define error
                  let err = `Doit contenir @ et une extension (.com ...); eg: johndoe@email.com ou 123tjohn@test.com`;
                  //show error
                  if (!el.nextElementSibling) InputErrorUtils.showErrorBox(err, el);
                }
              }
            } else {
              //sinon  on retire l'icone de validation "? ou v"
              InputErrorUtils.removeErrorBox(this.parentElement);
              //puis on rajoute la classe "not valid" 
              this.classList.add("not-valid");
              //define error
              let err = `Doit contenir @ et une extension (.com ...); eg: johndoe@email.com ou 123tjohn@test.com`;
              //show error
              if (!this.nextElementSibling) InputErrorUtils.showErrorBox(err, this);

            }
          }

          //check input type password confirmation
          if (this.type === "password" && this.id === "confPwd") {
            if (ValidationUtils.passwordChecker(this.value) && ValidationUtils.passwordEqualityChecker(document.querySelector("#pwd").value, this.value)) {
              if (this.classList.contains("not-valid")) {
                this.classList.remove("not-valid");
                InputErrorUtils.removeErrorBox(this.parentElement);
                InputErrorUtils.addValidBox('', this);

                //active submit button
                document.querySelectorAll('input:not([type="submit"])').forEach(el => {
                  if (!el.classList.contains('not-valid') && el.value) {
                    document.querySelector('input[type="submit"]').style.opacity = 1;
                    document.querySelector('input[type="submit"]').removeAttribute("disabled");
                  }
                });
              }
            } else {
              InputErrorUtils.removeErrorBox(this.parentElement);
              this.classList.add("not-valid");
              //define error
              let err = `Doivent être identiques; Doit contenir au moins 1 majuscule, 1 minuscule, 1 chiffre et un caratère spécial, longueur minimal : 8`;
              //show error
              if (!this.nextElementSibling)
                InputErrorUtils.showErrorBox(err, this);
            }
          }

          //check input type password
          if (this.type === "password" && this.id === "pwd") {
            if (ValidationUtils.passwordChecker(this.value)) {
              if (this.classList.contains("not-valid")) {
                this.classList.remove("not-valid");
                InputErrorUtils.removeErrorBox(this.parentElement);
                InputErrorUtils.addValidBox('', this);

              }
            } else {
              InputErrorUtils.removeErrorBox(this.parentElement);
              this.classList.add("not-valid");

              //define error
              let err = `Doit contenir au moins 1 majuscule, 1 minuscule, 1 chiffre et un caratère spécial, longueur minimal : 8`;
              //show error
              if (!this.nextElementSibling)
                InputErrorUtils.showErrorBox(err, this);
            }
          }
        });
      });



      //SUBMITING
      document
        .querySelector("#registrationPage form")
        .addEventListener("submit", function (ev) {
          ev.preventDefault();
          let userDatas = [];
          document.querySelectorAll('input:not([type="submit"])').forEach(el => userDatas.push(el.name + "=" + el.value));
          userDatas = userDatas.join('&');
          ///attempt ajax value
          Ajax.http('/register', 'post', 'application/x-www-form-urlencoded', 'application/json', userDatas)
            .then(response => {
              if (response.code === 200) {
                location.assign('/sign-in');
              }
              if (response.code === 500) {
                console.log(response.msg);
                alert("Oups...Quelque chose s\'est mal passée...");
              }
              if (response.code === 422) {
                alert("Champs invalides...");
              }

            });

        });
    }
  })();
  //SET COPYRIGHT YEAR
  (function () {
    let date = new Date();
    document.querySelector(".copyright-year").textContent = date.getFullYear();
  })();
  //BUILDER PAGE
  (function () {
    let builderPage = document.querySelector("main.builderPage");
    if (builderPage) {
      //SOME ACTION
      //printing
      document
        .querySelector("#printBtn")
        .addEventListener("click", function (ev) {
          PrintUtils.printPage("builder", "cv");
        });
      //saving

      //preview
      document
        .querySelector("#previewBtn")
        .addEventListener("click", function (ev) {
          //remove component box border drawing
          document.querySelectorAll(".component-bx").forEach((el) => {
            if (el.classList.contains("drop-bx-active"))
              el.classList.remove("drop-bx-active");
          });
          //remove component  border drawing
          document.querySelectorAll(".component").forEach((el) => {
            if (el.classList.contains("component-dragged-active"))
              el.classList.remove("component-dragged-active");
          });
        });

      // TEMPLATE EDIT
      //addProfil
      if (profil) TemplateEngine.addProfil("#profil-box>input", "#profil-box");
      //drag and drop + text edit
      TemplateEngine.dragEndDrop(
        ".component-bx",
        "component-dragged-active",
        "drop-bx-active",
        ["profil-box"]
      );

      //TOOLBOX
      //title
      ToolboxUtils.fontFamilyToolEvent("#titleFont", ".component h2");
      ToolboxUtils.colorToolEvent("#titleColor1", ".zone1 .component h2");
      ToolboxUtils.colorToolEvent("#titleColor2", ".zone2 .component h2");
      ToolboxUtils.fontSizeToolEvent("#titleFz", ".component h2");
      ToolboxUtils.marginToolEvent("#titleMg", ".component h2");
      //text
      ToolboxUtils.fontFamilyToolEvent(
        "#textFont",
        ".component :not(h2, label)"
      );
      ToolboxUtils.colorToolEvent(
        "#textColor1",
        ".zone1 .component :not(h2, label)"
      );
      ToolboxUtils.colorToolEvent(
        "#textColor2",
        ".zone2 .component :not(h2, label)"
      );
      ToolboxUtils.fontSizeToolEvent("#textFz", ".component :not(h2, label)");
      ToolboxUtils.marginToolEvent("#textMg", ".component :not(h2, label)");
    }
  })();
});
