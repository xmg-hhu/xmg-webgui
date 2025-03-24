// scripts for the viewer page
// window.onload = function () {
function load_all(xml_input) {
    //$('body').layout({ applyDefaultStyles: true });
    var margin = {
        top: 20,
        right: 120,
        bottom: 20,
        left: 120,
	width: 1000,
        height: 800
    };
    function unescapeHTML(escapedHTML) {
	return escapedHTML.replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&').replace(/&#34;/g,'\"');
    }
    xml_input = unescapeHTML(xml_input);
    parser = new DOMParser();
    xml = parser.parseFromString(xml_input,"text/xml");
    var entries = xml.getElementsByTagName("entry");
    // $('#numentry').val(entries.length);
    var entrytags = "";
    for (i = 0; i < entries.length; i++) {
        entrytags = entrytags + '<span class="btn btn-primary btn-block" id=' + i + '>' + entries[i].attributes.name.value + '</span>';
    }
    
    // We use d3 to connect single models of the grammar file with the viewer
    d3.select('#entries').append('div').html(entrytags);
    // debug
    $('#numentry').text(entries.length);
    d3.selectAll("span")
        .on("click", function (d) {
            // active Button
            $(this).addClass('active').siblings().removeClass('active');
            var entry = entries[d3.select(this)[0][0].attributes.id.value];
	    
	    if (document.getElementById("semFrame") != null) {
		var semFrame = document.getElementById("semFrame");
		
		// remove all svg children
		while (semFrame.getElementsByTagName("svg")[0]){
		    semFrame.removeChild(semFrame.getElementsByTagName("svg")[0]);
		}
		
		// add a fresh svg root
		var svgRootSemFrame = document.createElementNS("http://www.w3.org/2000/svg","svg");
		semFrame.appendChild(svgRootSemFrame);
		
		// draw semanticsFrame
		makeFrame(svgRootSemFrame,entry); // makeTree is part of DrawTree.js
		svgRootSemFrame.setAttribute("width",svgRootSemFrame.getBBox().width+10); // TODO: this should be more dynamic
		svgRootSemFrame.setAttribute("height",svgRootSemFrame.getBBox().height+10);
		svgRootSemFrame.setAttribute("max-height","100%");
		svgRootSemFrame.setAttribute("max-width","100%");
		
		// if SVG element is empty, remove dimension
		if (document.getElementById("SemFrameSVG")!=null) 
		    if (document.getElementById("semFrameSVG").children.length < 1) {
			semFrame.remove();
		    }
	    }

	    // render syntax tree
	    if (document.getElementById("synTree") != null) {
		
		var synTree = document.getElementById("synTree");
		
		// remove all svg children
		while (synTree.getElementsByTagName("svg")[0]){
		    synTree.removeChild(synTree.getElementsByTagName("svg")[0]);
		}
		
		// add a fresh svg root
		var svgRoot = document.createElementNS("http://www.w3.org/2000/svg","svg");
		synTree.appendChild(svgRoot);
		
	    // display trace
	    if (document.getElementById("Trace") != null) {
		var Trace = document.getElementById("Trace");
		
		// remove all svg children
		while (Trace.getElementsByTagName("svg")[0]){
		    Trace.removeChild(Trace.getElementsByTagName("svg")[0]);
		}
		
		// add a fresh svg root
		var svgRootTrace = document.createElementNS("http://www.w3.org/2000/svg","svg");
		Trace.appendChild(svgRootTrace);
		
		// draw trace
		makeTrace(svgRootTrace,entry); // makeTrace is part of xmgview.js
		svgRootTrace.setAttribute("width",svgRootTrace.getBBox().width+10); // TODO: this should be more dynamic
		svgRootTrace.setAttribute("height",svgRootTrace.getBBox().height+10);
		svgRootTrace.setAttribute("max-height","100%");
		svgRootTrace.setAttribute("max-width","100%");
		
		// if SVG element is empty, remove dimension
		if (document.getElementById("TraceSVG")!=null) 
		    if (document.getElementById("TraceSVG").children.length < 1) {
			Trace.remove();
		    }
	    }
		
		
		// display interface
		if (document.getElementById("Interface") != null) {
		    var Interface = document.getElementById("Interface");
		    
		    // remove all svg children
		    while (Interface.getElementsByTagName("svg")[0]){
			Interface.removeChild(Interface.getElementsByTagName("svg")[0]);
		    }
		    
		    // add a fresh svg root
		    var svgRootInterface = document.createElementNS("http://www.w3.org/2000/svg","svg");
		    Interface.appendChild(svgRootInterface);
		    
		    // draw interface
		    makeInterface(svgRootInterface,entry); // makeInterface is part of xmgview.js
		    svgRootInterface.setAttribute("width",svgRootInterface.getBBox().width+10); // TODO: this should be more dynamic
		    svgRootInterface.setAttribute("height",svgRootInterface.getBBox().height+10);
		    svgRootInterface.setAttribute("max-height","100%");
		    svgRootInterface.setAttribute("max-width","100%");
		    
		    // if SVG element is empty, remove dimension
		    if (document.getElementById("InterfaceSVG")!=null) 
			if (document.getElementById("InterfaceSVG").children.length < 1) {
			    Interface.remove();
			}
		}
		
		
		// draw syntactic tree 
		makeTree(svgRoot,entry); // makeTree is part of xmgview.js
		svgRoot.setAttribute("width",svgRoot.getBBox().width+10); // TODO: this should be more dynamic
		svgRoot.setAttribute("height",svgRoot.getBBox().height+10);
		svgRoot.setAttribute("max-width","100%"); 
		svgRoot.setAttribute("max-height","100%");
		
		
		// if SVG element is empty, remove dimension
		if (document.getElementById("synTreeSVG").children.length < 1) {
		    synTree.remove();
		}
	    }
	    
	    // change bootstrap size, if one of the dimensions is empty
	    if (document.getElementById("synTree") != null && document.getElementById("semFrame") == null) {
		document.getElementById("synTree").setAttribute("class","col-sm-10");
	    }
	    if (document.getElementById("synTree") == null && document.getElementById("semFrame") != null) {
		document.getElementById("semFrame").setAttribute("class","col-sm-10");
	    }
	    
	    
        });

    // filter entries
    // FIXME: also hides the "Filter" label; update entry counter
    (function ($) {
        $('#filter').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');
            $('span').hide();
            $('svg').hide();
            $('span').filter(function () {
                return rex.test($(this).text());
            }).show();
        })
    }(jQuery));
    
}


/**
 * sends a request to the specified url from a form. this will change the window location.
 * @param {string} path the path to send the post request to
 * @param {object} params the parameters to add to the url
 * @param {string} [method=post] the method to use on the form
 */

function post(path, params, method='post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less verbose if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}


function saveAndCompile(filename){
    //console.log("Arrived in javascript");
    //console.log(document.getElementById("myEditorArea").value);
    debug_mode = document.getElementById("debug_").checked;
    type_hierarchy = document.getElementById("type_hierarchy_").checked;
    xmg_code = document.getElementById("myEditorArea").value;
    compiler = document.getElementById("items").value;
    post('/save_and_compile', {xmg_code: xmg_code, compiler : compiler, filename : filename, debug_mode : debug_mode, type_hierarchy : type_hierarchy });
    // const url = 'save_and_compile?xmg_code=' + encodeURIComponent(xmg_code)
    // 	  + '&compiler=' + encodeURIComponent(compiler)
    // 	  + '&filename=' + encodeURIComponent(filename)
    // 	  + '&debug_mode=' + encodeURIComponent(debug_mode)
    // 	  + '&type_hierarchy=' + encodeURIComponent(type_hierarchy)
    // document.location.href = url // FIXME should do this with POST, not GET
}


