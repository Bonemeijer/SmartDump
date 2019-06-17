//<![CDATA[
if (typeof clickEventListener === 'undefined') {
    var clickEventListener = function(){
        var node = this;
        var nextNode = node.nextSibling;

        if (nextNode.classList.contains('open')) {
            nextNode.classList.remove('open');
        } else {
            nextNode.classList.add('open');
        }
    };
}

var initialState = Number(document.querySelector('[data-foldout-namespace="FOLDOUT_NAMESPACE"]').dataset.foldoutState) === 1;
var nodeList = document.querySelectorAll('[data-foldout-namespace="FOLDOUT_NAMESPACE"] .aggregate-node .aggregate-node .aggregate-node-name');

for (var i = 0, length = nodeList.length; i < length; i++) {
    nodeList[i].parentNode.classList.add('aggregate-node-foldout');
    nodeList[i].removeEventListener('click', clickEventListener, true);
    nodeList[i].addEventListener('click', clickEventListener, true);

    if (initialState) {
        nodeList[i].click();
    }
}
//]]>
