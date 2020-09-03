
window.onload = function () {
		
		//$('body').layout({ applyDefaultStyles: true });
    var margin = {
        top: 20,
        right: 120,
        bottom: 20,
        left: 120
    },
				width = 1000,
        height = 800;
		
    //file Uploader
    uploaded_file = $('#file_display').val();
    $( '#ajaxLoadAni' ).fadeOut( 1000);

		var request = new XMLHttpRequest();
    request.open("GET", uploaded_file, false);
    request.send();
		var xml = request.responseXML;
    var entries = xml.getElementsByTagName("entry");
		// $('#numentry').val(entries.length);
    var entrytags = "";

		for (i = 0; i < entries.length; i++) {
        entrytags = entrytags + '<span class="btn btn-primary btn-block" id=' + i + '>' + entries[i].attributes.name.value + '</span>';
    }
    d3.select('#entries').append('div').html(entrytags);
    $('#numentry').text(entries.length);
    d3.selectAll("span")
        .on("click", function (d) {
            //Active Button
            $(this).addClass('active').siblings().removeClass('active');
            var entry = entries[d3.select(this)[0][0].attributes.id.value];
						console.log(entry);
						
						xmg2svg=create_xmg2svg_input(entry);
						// now, xmg2svg should contain the svg to be pushed in the #synTree part
						console.log(xmg2svg);

						var syntaxTree = doSyntaxTree(entry);
            var semanticsFrame = doSemanticsFrame(entry);
            if (semanticsFrame != null) {
								displayFrame(semanticsFrame);
						}                
						if (syntaxTree != null) {
                displayTree(syntaxTree);
            }
            ;
            update(syntaxTree);
            MathJax.Hub.Typeset();

        });


    function create_xmg2svg_input(entry){
				svg="<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" id=\"alphanx0Vnx1\" onload=\"init()\"> <script type=\"text/javascript\" xlink:href=\"draw_tree2.js\" /><entry>"+entry.innerHTML+"</entry></svg>";

				return svg;
    }


    function displayTree(syntaxTree) {

        var i = 0,
        duration = 500,
        rectW = 40,
        rectH = 20;
        var tree = d3.layout.tree().nodeSize([200, 100]);
        //var tree = d3.layout.tree();
        
        tree.nodeSize = function(x) {
						if (!arguments.length) return nodeSize ? size : null;
						nodeSize = (size = x) != null;
						return tree;
				};


        var diagonal = function line(d) {
            return "M" + d.source.x + "," + d.source.y + "L" + d.target.x + "," + d.target.y;
        };
        //   var diagonal = d3.svg.zigzag();
				//                var diagonal=  d3.svg.diagline()
        //    var diagonal = d3.svg.diagonal()
        //        .projection(function (d) {
        //       return [d.x , d.y];
        //      });

        d3.select("#synTree").select("svg").remove();
        var svg = d3.select("#synTree").append("svg").attr("width", 800).attr("height", 800)
            .call(zm = d3.behavior.zoom().scaleExtent([0.9, 2]).on("zoom", redraw))
            .append("g")
            .attr("transform", "translate(" + 150 + "," + 50 + ")");
        //necessary so that zoom knows where to zoom and unzoom from
        zm.translate([200, 5]);
        syntaxTree.x0 = 0;
        syntaxTree.y0 = height / 2;
        function collapse(d) {
            if (d.children) {
                d._children = d.children;
                d._children.forEach(collapse);
                d.children = null;
            }
        }
        //   syntaxTree.children.forEach(collapse);

        update(syntaxTree);
        MathJax.Hub.Typeset();
        d3.select("#synTree").style("height", "800px");
        function update(source) {
            // Compute the new tree layout.
            var nodes = tree.nodes(syntaxTree).reverse(),
            links = tree.links(nodes);
            // Normalize for fixed-depth.
            nodes.forEach(function (d) {
                d.y = d.depth * 110;
            });
            // Update the nodes…
            var node = svg.selectAll("g.node")
                .data(nodes, function (d) {
                    return d.id || (d.id = ++i);
                });
            // Enter any new nodes at the parent's previous position.
            var nodeEnter = node.enter().append("g")
                .attr("class", "node")
                .attr("transform", function (d) {
                    return "translate(" + source.x0 + "," + source.y0 + ")";
                })
                .on("click", click);
            nodeEnter.append("rect")
                .attr("width", rectW)
                .attr("height", rectH)
                .attr("x", -20)
                .attr("stroke", "#fff")
                .attr("stroke-width", 1)
                .style("fill", function (d) {
                    return d._children ? "#fff" : "#fff";
                });
            nodeEnter.append("foreignObject")
            //.attr("id", "FSDisplay")
                .attr("width", "40%")
                .attr("height", "40%")
                .attr("x", 20)
                .attr("y", -15)
            // .append("xhtml:svg")
                .append('xhtml:div')
            //.attr('class', 'pop-div')
                .style("font", "10px 'Helvetica Neue'")
            // .html('<a href="#" class="myid" rel="popover" >click me</a>');
                .html(function (d) {
                    return d.features;
                });
            nodeEnter.append("text")
            //        .attr("x", rectW / 2)
                .attr("y", rectH / 2)
                .attr("x", 0)
                .attr("dy", "1px")
                .attr("text-anchor", "middle")
                .attr("stroke", "blue")
                .style("font", "14px 'Helvetica Neue'")
                .text(function (d) {
                    return d.tagName;
                });

            // Transition nodes to their new position.
            var nodeUpdate = node.transition()
                .duration(duration)
                .attr("transform", function (d) {
                    return "translate(" + d.x + "," + d.y + ")";
                });

            nodeUpdate.select("rect")
                .attr("width", rectW)
                .attr("height", rectH)
                .attr("stroke", "#fff")
                .attr("stroke-width", 1)
                .style("fill", function (d) {
                    return d._children ? "#DDD" : "#fff";
                });

            nodeUpdate.select("text")
                .style("fill-opacity", 1);


            // Transition exiting nodes to the parent's new position.
            var nodeExit = node.exit().transition()
                .duration(duration)
                .attr("transform", function (d) {
                    return "translate(" + source.x + "," + source.y + ")";
                })
                .remove();

            nodeExit.select("rect")
                .attr("width", rectW)
                .attr("height", rectH)

                .attr("stroke", "black")
                .attr("stroke-width", 1);
            nodeExit.select("text");

            // Update the links…
            var link = svg.selectAll("path.link")
                .data(links, function (d) {
                    return d.target.id;
                });
            // Enter any new links at the parent's previous position.
            link.enter().insert("path", "g")
                .attr("class", "link")
                .attr("x", rectW / 2)
                .attr("y", rectH / 2)
                .attr("d", function (d) {
                    var o = {
                        x: source.x0,
                        y: source.y0
                    };
                    return diagonal({
                        source: o,
                        target: o
                    });
                });

            // Transition links to their new position.
            link.transition()
                .duration(duration)
                .attr("d", diagonal);


            // Transition exiting nodes to the parent's new position.
            link.exit().transition()
                .duration(duration)
                .attr("d", function (d) {
                    var o = {
                        x: source.x,
                        y: source.y
                    };
                    return diagonal({
                        source: o,
                        target: o
                    });
                })
                .remove();


            // Stash the old positions for transition.
            nodes.forEach(function (d) {
                d.x0 = d.x;
                d.y0 = d.y;
            });
        }

        // Toggle children on click.
        function click(d) {

            if (d.children) {
                d._children = d.children;
                d.children = null;
            } else {
                d.children = d._children;
                d._children = null;
            }
            update(d);
            MathJax.Hub.Typeset();
        }

        //Redraw for zoom
        function redraw() {
            //console.log("here", d3.event.translate, d3.event.scale);
            svg.attr("transform",
                     "translate(" + d3.event.translate + ")"
                     + " scale(" + d3.event.scale + ")");
        }

    }
    // end of DisplayTree

    function doSyntaxTree(xml) {
        if (xml.tagName === "entry") {
            xml = xml.getElementsByTagName("tree")[0];
						if (xml.attributes.id == null) {
                return null;
            }
            if (xml.attributes.id.value == 'none') {
                return null;
            }
        }

        // convert xml fs into MathML fs
        var xmlFS = xml.getElementsByTagName("fs")[0];


        // I think this function and the buildFS for frames should be unified (the only difference is the type)

        function buildFS(fsXML) {
            // get the feature structure
            // print the (mandatory?) label
						var label=null;
						if(fsXML.hasAttribute('coref')){
            		var label = fsXML.attributes.coref.value;
            }
						//console.log(label);
            var labelDisplay = '<menclose notation="box"><mi>' + label + '</mi></menclose>'
            var FSMath = '<mrow>' + labelDisplay + '<mfenced open="[" close="]"><mtable columnalign="left left">';
            for (var i = 0; i < fsXML.children.length; i++) {
                var currentFeat = fsXML.children[i];
                //console.log(currentFeat.children[0].tagName);
                // left part (attribute)
                var currentString = '<mtr><mtd><mrow><mi>' + currentFeat.attributes.name.value.toUpperCase() + '</mi></mrow></mtd>';
                // right part (value): three cases, value, feature structure or attribute
                var currentValue = '';
                //console.log(currentFeat);
                // attribute
                if (currentFeat.hasAttribute('varname')) {
                    currentValue = '<mtd><mrow><mi>' + currentFeat.attributes.varname.value + '</mi></mrow></mtd>';
                    //console.log(currentFeat.attributes.varname.value);	
                }
                else {
                    currentTag = currentFeat.children[0].tagName;
                    // value
                    if (currentTag === 'sym') {
                        currentValue = '<mtd><mrow><mi>' + currentFeat.children[0].attributes[0].value + '</mi></mrow></mtd>';
                    }
										else{
												if(currentTag === 'vAlt'){
														valtvalue="@{";
														for(var iv = 0; iv < currentFeat.children[0].children.length; iv++){
																valtvalue=valtvalue+currentFeat.children[0].children[iv].attributes[0].value;
																if(iv==currentFeat.children[0].children.length-1){valtvalue=valtvalue+ "}";}else{valtvalue=valtvalue+",";}
														}
														currentValue = '<mtd><mrow><mi>' + valtvalue +'</mi></mrow></mtd>';
												}
												// feature structure
												else { // currentTag=='fs'
														//console.log(currentFeat.children[0]);      
														currentValue = buildFS(currentFeat.children[0]);
														//console.log(currentValue);      
												}}
                }
                currentString = currentString + currentValue + '</mtr>';
                FSMath = FSMath + currentString;
            }
            if (FSMath == '<mrow>' + labelDisplay + '<mfenced open="[" close="]"><mtable columnalign="left left">') {
                return '<mrow>' + labelDisplay;
            }
            else {
                return FSMath + '</mtable></mfenced>';
            }
        }
        var MathFS = '<math xmlns="http://www.w3.org/1998/Math/MathML">' + buildFS(xmlFS) + '</math>';
        var o = {
            "tagName": xml.tagName,
            "features": MathFS
        };
        if (o.tagName === "tree" || o.tagName === null) {
            return doSyntaxTree(xml.children[0]);
        } else {
            if (o.tagName === "node") {
								if(xml.hasAttribute('name')){
                		o.tagName = xml.attributes.name.value;
								}
                var feats = xml.getElementsByTagName("f");
                var i = 0;
                var mark_symbol = "";
								if(xml.hasAttribute('type')){
                		var mark = xml.attributes.type.value;

										if (mark == "anchor") {
        								mark_symbol = "♦";
        						}
        						;
        						if (mark == "subst") {
        								mark_symbol = "↓";
        						}
        						;
        						if (mark == "foot") {
        								mark_symbol = "★";
        						}
        						;
        						if (mark == "nadj") {
        								mark_symbol = " nadj";
        						}
                }

                while (i < feats.length) {
                    if (feats[i].attributes.name.value === "cat") {
                        o.tagName = feats[i].children[0].attributes.value.value 
                            + mark_symbol;
                        break;
                    }
                    i++;
                }
            }
            if (xml.attributes) {
                o.attributes = [];
                Array.prototype.forEach.call(xml.attributes,
																						 function (a) {
																								 o.attributes[a.name] = a.value;
																						 }); //treat the attributes node list as an array
                //and add each attribute to the object
            }
            if (xml.textContent && xml.textContent.length) {
                o["textContent"] = xml.textContent.trim();
            }
            var nchildren = [];
            for (i = 0; i < xml.children.length; i++) {
                if (xml.children[i].tagName !== "narg") {
                    nchildren.push(xml.children[i]);
                }
            }
            if (nchildren.length) {
                o.children = Array.prototype.map.call(nchildren,
																											function (child) {
																													return doSyntaxTree(child);
																											});
                //replace each xml object in the child array
                //with its JSON-ified version
            }
            return o;
        }
    }

    function doSemanticsFrame(xml) {
        if (xml.tagName === "entry") {
            frame = xml.getElementsByTagName("frame")[0];
        }
				if(frame==null){
						return null;
				}
        var Frames = frame.children;
        function buildFS(fsXML) {
            // print the (mandatory?) label
            var label = fsXML.attributes.coref.value;
            //console.log(label);
            var labelDisplay = '<menclose notation="box"><mi>' 
                + label + '</mi></menclose>'
            var FSMath = '<mrow>' + labelDisplay + '<mfenced open="[" close="]">';
            //print the type
						// Old syntax (type as attribute)
            if(fsXML.hasAttribute('type')){
								FSMath = FSMath + '<mtable columnalign="left">\n\
              <mtr><mtd><mi mstyle mathvariant="sans-serif-italic">' +
                    fsXML.attributes.type.value.replace(/[\[\]"]+/g, "") +
                    '</mi></mtd></mtr><mtr><mtd><mtable columnalign="left left">';
						}
            // print the type
            // New syntax (type as child)
            if(fsXML.children.length>0){
								if(fsXML.children[0].tagName=='ctype'){
										var types=fsXML.children[0].children;
										FSMath = FSMath + '<mtable columnalign="left">\n\
                  <mtr><mtd><mi mstyle mathvariant="sans-serif-italic">';
										for (var i=0; i < types.length; i++ ){
												if(i==types.length -1){sep="";}else{sep="-";}
												FSMath= FSMath + types[i].attributes.val.value + sep;
										}
										FSMath = FSMath +  '</mi></mtd></mtr><mtr><mtd><mtable columnalign="left left">';

								}}
            for (var i = 0; i < fsXML.children.length; i++) {
                var currentFeat = fsXML.children[i];
                if (currentFeat.tagName=='ctype'){continue;}
                //console.log(currentFeat);
                var currentString = '<mtr><mtd><mi>' +
                    (currentFeat.attributes.name.value).toUpperCase() 
                    + '</mi></mtd>';
                var currentValue = '';
                if (currentFeat.hasAttribute('varname')) {
                    currentValue = '<mtd><mi>'
                        + currentFeat.attributes.varname.value + '</mi></mtd>';
                }
                else {
                    currentTag = currentFeat.children[0].tagName;
                    if (currentTag === 'sym') {
                        currentValue = '<mtd><mrow><mi>'
                            + currentFeat.children[0].attributes[0].value
                            + '</mi></mrow></mtd>';
                    }
                    else {
                        //console.log(currentFeat.children[0]);
                        currentValue = buildFS(currentFeat.children[0]);
                    }
                }
                currentString = currentString + currentValue + '</mtr>';
                FSMath = FSMath + currentString;
            }
            return FSMath 
                + '</mtable></mtd></mtr></mtable></mfenced></mrow>';
        }

				var NewFrames = '<math xmlns="http://www.w3.org/1998/Math/MathML">';        
				//console.log(Frames.length);


        for (j = 0; j < Frames.length; j++) {
						NewFrames = NewFrames + buildFS(Frames[j]) + "<mo linebreak='newline'></mo><mo linebreak='newline'></mo>";              
        }
				NewFrames = NewFrames + '</math>';

        return NewFrames;
    }
    function displayFrame(Frame) {
        //console.log(Frame);
        d3.select("#semFrame").selectAll("svg").remove();
        //for (i = 0; i < Frame.length; i++) {
        d3.select("#semFrame")
            .append("svgframe")
            .attr("width", 300)
            .attr("height", 300)
            .append("foreignObject")    
            .append("xhtml:svg")
        // .attr("class", "frame")
            .style("font", "10px 'Helvetica Neue'")
            .html(Frame + '</br></br>');
        // The next line is absolutely forbidden:	
        MathJax.Hub.Typeset();  	
        //}
    }

    d3.svg.zigzag = function () {

        var source = function (d) {
            return d.source;
        }
        var target = function (d) {
            return d.target;
        }
        var projection = function (d) {
            return [d.x, d.y];
        }

        function zigzag(d, i) {
            var p0 = source.call(this, d, i),
            p3 = target.call(this, d, i),
            m = p0.y + 15;
            p = [p0, {x: p0.x, y: m}, {x: p3.x, y: m}, p3];
            p = p.map(projection);
            return "M" + p[0] + "L" + p[1] + " L" + p[2] + " L" + p[3];
        }

        zigzag.source = function (x) {
            if (!arguments.length)
                return source;
            source = d3.functor(x);
            return diagline;
        };

        zigzag.target = function (x) {
            if (!arguments.length)
                return target;
            target = d3.functor(x);
            return diagline;
        };

        zigzag.projection = function (x) {
            if (!arguments.length)
                return projection;
            projection = x;
            return diagline;
        };

        return zigzag;
    };

    d3.svg.diagline = function () {
        var source = function (d) {
            return d.source;
        }
        var target = function (d) {
            return d.target;
        }
        var projection = function (d) {
            return [d.x, d.y];
        }

        function diagline(d, i) {
            var p0 = source.call(this, d, i),
            p3 = target.call(this, d, i),
            p = [p0, p0, p3, p3];
            p = p.map(projection);
            return "M" + p[0] + "C" + p[1] + " " + p[2] + " " + p[3];
        }

        diagline.source = function (x) {
            if (!arguments.length)
                return source;
            source = d3.functor(x);
            return diagline;
        };

        diagline.target = function (x) {
            if (!arguments.length)
                return target;
            target = d3.functor(x);
            return diagline;
        };

        diagline.projection = function (x) {
            if (!arguments.length)
                return projection;
            projection = x;
            return diagline;
        };

        return diagline;
    };
		// filter entries
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
		//////////////////////////////////////////////
    function activaTab(tab) {
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    }
    ;

    activaTab('aaa');




}

