
window.onload = function () {
    var margin = {
        top: 220,
        right: 20,
        bottom: 20,
        left: 20
    },
				width = 1000,
        height = 1000;

    //file Uploader
    //$( '#ajaxLoadAni' ).fadeOut( 500);

		var request = new XMLHttpRequest();
    request.open("GET","/xtag/grammar/grammar.xml", false);
    request.send();
    var xml = request.responseXML;
    var entries = xml.getElementsByTagName("entry");
		// $('#numentry').val(entries.length);
		var entrytags = "";

		for (i = 0; i < entries.length; i++) {
        entrytags = entrytags + '<span class="btn btn-primary btn-block" id=' + i + '>' + entries[i].attributes.name.value + '</span>';
    }

		// We use d3 to connect single models of the grammar file with the viewer
		d3.select('#entries').append('div').html(entrytags);
    $('#numentry').text(entries.length);
    d3.selectAll("span")
        .on("click", function (d) {
            //Active Button
            $(this).addClass('active').siblings().removeClass('active');
            var entry = entries[d3.select(this)[0][0].attributes.id.value];
						console.log(entry);
						
						var synTree = document.getElementById("synTree");
						$('svg').remove();

						if (document.getElementById("grammarDescription")){
								document.getElementById("grammarDescription").remove();
						}
						
						var svgRoot = document.createElementNS("http://www.w3.org/2000/svg","svg");
						svgRoot.setAttribute("width","2000");
						svgRoot.setAttribute("height","2000");
						synTree.appendChild(svgRoot);

						// draw syntactic tree 
						makeTree(svgRoot,entry); // makeTree is part of xmgview.js
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

