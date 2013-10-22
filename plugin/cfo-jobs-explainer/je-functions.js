/**
 * Generates a table of contents for your document based on the headings
 *  present. Anchors are injected into the document and the
 *  entries in the table of contents are linked to them. The table of
 *  contents will be generated inside of the first element with the id `toc`.
 * @param {HTMLDOMDocument} documentRef Optional A reference to the document
 *  object. Defaults to `document`.
 * @author Matthew Christopher Kastor-Inare III
 * @version 20130726
 * @example
 * // call this after the page has loaded
 * htmlTableOfContents();
 */
function htmlTableOfContents (documentRef) {
    var documentRef = documentRef || document;
    var toc = documentRef.getElementById('je-naver');
    /** H6 is only asides **/
    var headings = [].slice.call(documentRef.body.querySelectorAll('h1.toptitle, .je-container h2, .je-container h4, .je-container h5'));
    headings.forEach(function (heading, index) {
        var anchor = documentRef.createElement('a');
        anchor.setAttribute('name', 'toc' + index);
        anchor.setAttribute('id', 'toc' + index);

        var link = documentRef.createElement('a');
        link.setAttribute('href', '#toc' + index);
        link.textContent = heading.textContent;

        var div = documentRef.createElement('div');
        div.setAttribute('class', heading.tagName.toLowerCase());

        div.appendChild(link);
        toc.appendChild(div);
        heading.parentNode.insertBefore(anchor, heading);
    });
}

try {
     module.exports = htmlTableOfContents;
} catch (e) {
    // module.exports is not defined
}

function dvLinkHandler(){
     jQuery('.je-container').on('click', '.dv-link', function(e){
         e.preventDefault();
         var obj = jQuery(this);
         var target = obj.attr('href');
         var targetObj = jQuery(target);
         console.log(target);
         jQuery(target).reveal({
                 animation: 'fadeAndPop',                   //fade, fadeAndPop, none
                 animationspeed: 300,                       //how fast animtions are
                 closeonbackgroundclick: true,              //if you click background will modal close?
                 dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
            });
         
     });
}

jQuery(window).bind("load", function() {
htmlTableOfContents(); 
dvLinkHandler();
    
});