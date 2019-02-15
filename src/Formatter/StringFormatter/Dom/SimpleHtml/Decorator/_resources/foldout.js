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

var nodeList = document.querySelectorAll('.aggregate-node .aggregate-node .aggregate-node-name');
for (var i = 0, length = nodeList.length; i < length; i++) {
    nodeList[i].parentNode.classList.add('aggregate-node-foldout');
    nodeList[i].removeEventListener('click', clickEventListener, true);
    nodeList[i].addEventListener('click', clickEventListener, true);
}
//]]>
