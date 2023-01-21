// turn js on strict mode
"use strict";

export class ValidationUtils {
  /**
   * passwordChecker();
   * @param {String} passWordEntry -
   * - Rule: verifie si les  mots de passe respectent le format regex exigé au moins 8 caractères doit contenir au moins 1 lettre majuscule, 1 lettre minuscule et 1 chiffre Peut contenir des caractères spéciaux.
   * - Using: passwordCherker(passwordValue);
   */
  static passwordChecker(passWordEntry) {
    if (
      passWordEntry.match(
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/gm
      )
    )
      return true;
    else return false;
  }

  /**
   * passwordEqualityChecker();
   * @param {String} password1 - first password ;
   * @param {String} password2 - confirm password ;
   * - Rule: verifie si deux mots de passe sont identiques;
   * - Using: passwordEqualityCherker(password1Value,password2Value);
   */
  static passwordEqualityChecker(password1, password2) {
    if (password1 === password2) return true;
    else return false;
  }

  /**
   * emailChecker();
   * @param {String} emailEntry
   * - Rule: Vérifie si l'email entré est valide conformement aux normes FRC;
   * - Using: emailChecker(emailValue);
   */
  static emailChecker(emailEntry) {
    if (emailEntry.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+?(?:\.com|\.org|\.co\.uk|\.org\.uk)$/i)) {
      return true;
    } else {
      return false;

    }
  }
  /**
   * nameChecker();
   * @param {String} nameEntry
   * - Rule: verifie si le noms entré respecte le format regex exigé:
   * Longueur minimale (3).
   * Longueur maximale(40).
   * Ne peut contenir que des caractères alphabétique et les caractères spéciaux suivants :
   * trait de soulignement (_), (.) et tiret (-).
   * Les caractères spéciaux ne peuvent pas apparaître plus d'une fois consécutivement ou combinés.
   * - Using: nameChecker(name Or Surname);
   */
  static nameChecker(nameEntry) {
    if (
      nameEntry.match(
        /(?!.*[\-\_ ]{2,})(?!.*[\.]{2,})(?!.*( \.){1,})^[\w+àáâãäåçèéêëìíîïðòóôõöùúûüýÿ\-\_\.\d+ ]{3,40}$/gm
      )
    )
      return true;
    else return false;
  }

}
