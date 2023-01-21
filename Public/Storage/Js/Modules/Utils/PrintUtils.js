//turn javascript to strict mode
"use strict";

export class PrintUtils {

  closePrint() {
    document.body.removeChild(this.__container__);
  }

  /**
   * open a given url in new iframe and print page
   * @param {String} sURL - valid webpage route
   * @param {String} el - valid HtmlElement selector : part of page where you want print
  */
 static printPage(sURL,el) {
    const hideFrame = document.createElement("iframe");

    hideFrame.addEventListener('load',function(e){
      this.contentWindow.__container__ = this;
      this.contentWindow.document.all.cv.innerHTML= document.getElementById(el).innerHTML;
      this.contentWindow.onbeforeunload = this.closePrint;
      this.contentWindow.onafterprint = this.closePrint;
      this.contentWindow.focus(); // Required for IE
      this.contentWindow.print();
    }) 
    
    hideFrame.style.position = "fixed";
    hideFrame.style.right = "0";
    hideFrame.style.bottom = "0";
    hideFrame.style.width = "0";
    hideFrame.style.height = "0";
    hideFrame.style.border = "0";
    hideFrame.src = sURL;
    document.body.appendChild(hideFrame);
  }
}
