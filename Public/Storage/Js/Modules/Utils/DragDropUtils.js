export class dragEndDrop {

    /**
     * Make some element draggable and editable
     * @param {String} elContainer element where you want drag container - valid html Selector;
     * @param {Array} notEditable element where you wouldn't make editable 
     */
    static drag(elContainer, notEditable) {
        document.querySelectorAll(elContainer).forEach(el => {
        el.children[0].draggable = "true";
        notEditable.forEach(e => {
            if (!el.children[0].classList.contains(e)) el.children[0].contentEditable = "true";
        });
      });
    }
    
    /**
     * Set data where to be moved
     * @param {String} elContainer element where you want drag container - valid html Selector;
     * @param {String} isdragged className where contain css that will be applyed to dragged element - valid className;
     */
    static dragstart(elContainer, isdragged){
        document.querySelectorAll(elContainer).forEach((el) => {
            el.addEventListener("dragstart", function (ev) {
              this.children[0].id = "dragged";
              this.children[0].classList.add(isdragged);
              ev.dataTransfer.setData("text", this.children[0].id);
            });
          });
    } 

    /**
     * Prevent default drop effect
     * @param {String} elContainer element where you want drop container - valid html Selector;
     */
    static  dragOver(elContainer){
        document.querySelectorAll(elContainer).forEach( el => el.addEventListener("dragover", ev => ev.preventDefault()));
    } 

    /**
     * Allow to drop element
     * @param {String} elContainer element where you want drag container - valid html Selector;
     * @param {String} isdropped className where contain css that will be applyed to dropped element container - valid className;
     */
    static drop(elContainer, isdropped){
        document.querySelectorAll(elContainer).forEach(el => {
            el.addEventListener("drop", function (ev) {
              ev.preventDefault();
              this.classList.add(isdropped);
              this.append(document.getElementById(ev.dataTransfer.getData("text")));
              this.lastChild.id = "";
            });
          });
    } 
}