//turn js on strict mode
"use strict";

//modules imports
import { newProfil } from "./Modules/Utils/UploadImgUtils.js";
import { dragEndDrop } from "./Modules/Utils/DragDropUtils.js";

export class TemplateEngine {
  /**
   * add picture to template profil field
   * @param {String} profil valid selector - profil input field;
   * @param {String} profilBx valid selector - profil input field container ;
   */
  static addProfil(profil, profilBx) {
    newProfil(profil, profilBx);
  }

  /**
   * Make drag and drop and set content editable
   * @param {String} elContainer element whereyou want drag and drop container - valid html selector;
   * @param {String} isdragged className where contain css that will be applyed to dragged element - valid className;
   * @param {String} isdropped className where contain css that will be applyed to dropped element container - valid className;
   * @param {Array} notEditable element where you wouldn't make editable 
   */
  static dragEndDrop(elContainer, isdragged, isdropped, notEditable) {
    dragEndDrop.drag(elContainer, notEditable);
    dragEndDrop.dragstart(elContainer, isdragged);
    dragEndDrop.dragOver(elContainer);
    dragEndDrop.drop(elContainer, isdropped);
  }
}
