export class ToolboxUtils {

    /**
     * change element color after "onchange" event capturing 
     * @param {String} tool - html input element selector;
     * @param {HTMLCollection} elements - element on which the property is applied ;
     */
    static colorToolEvent (tool, elements){
        document.querySelector(tool).addEventListener('change', ev => {
            document.querySelectorAll(elements).forEach(e => e.style.color = ev.target.value);
          });
    }

    /**
     * change element size after "onchange" event capturing 
     * @param {String} tool - html input element selector;
     * @param {HTMLCollection} elements - element on which the property is applied ;
     */
    static fontSizeToolEvent (tool, elements){
        document.querySelector(tool).addEventListener('change', ev => {
            document.querySelectorAll(elements).forEach(e => e.style.fontSize = ev.target.value+"rem");
          });
    }

    /**
     * change element margin after "onchange" event capturing 
     * @param {String} tool - html input element selector;
     * @param {HTMLCollection} elements - element on which the property is applied ;
     */
    static marginToolEvent (tool, elements){
        document.querySelector(tool).addEventListener('change', ev => {
            document.querySelectorAll(elements).forEach(e => e.style.marginBlock = ev.target.value +"px");
          });
    }

    /**
     * change element fontFamily after "onchange" event capturing 
     * @param {String} tool - html input element selector;
     * @param {HTMLCollection} elements - element on which the property is applied ;
     */
    static fontFamilyToolEvent (tool, elements){
        document.querySelector(tool).addEventListener('change', ev => {
            document.querySelectorAll(elements).forEach(e => e.style.fontFamily = ev.target.value);
          });
    }

}