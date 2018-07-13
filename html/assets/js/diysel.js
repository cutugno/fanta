function zoom(vb){
    z = 0.03;
    var b = vb.split(' ').map(function(n){return parseInt(n, 10);});
    z *= Math.max(b[2],b[3]);
    b[0] -= z;
    b[2] += z * 2;
    b[1] -= z;
    b[3] += z * 2;
    return b.map(function(n){return n.toString();}).join(' ');
}

d3.selection.prototype.size = function() {
    var n = 0;
    this.each(function() { ++n; });
    return n;
};

function initialize_selection(){
    var svg = d3.select("svg");
    svg.attr('viewBox',zoom(svg.attr('viewBox')));
    svg.on("mousemove", function() {
        var s = svg.select("rect.selection");
        if(!s.empty()) {
            var p = d3.mouse(this),
                d = {
                    x: parseInt(s.attr("x"),10),
                    y: parseInt(s.attr("y"),10),
                    width: parseInt(s.attr("width"),10),
                    height: parseInt(s.attr("height"),10)
                },
                c = {
                    x: parseInt(s.attr("mx"),10),
                    y: parseInt(s.attr("my"),10)
                };

            if(c.x < p[0]){
              d.x = c.x;
              d.width = p[0] - c.x;
            } else {
              d.x = p[0];
              d.width = c.x - p[0];
            }   
            if(c.y < p[1]){
              d.y = c.y;
              d.height = p[1] - c.y;
            } else {
              d.y = p[1];
              d.height = c.y - p[1];
            }   
            s.attr(d);
        }
    }).on("mousedown", function() {
        var p = d3.mouse(this);
        svg.append("rect").attr({
            rx: 6,
            ry: 6,
            class: "selection",
            x: p[0],
            y: p[1],
            width: 0,
            height: 0,
            mx: p[0],
            my: p[1]
        })
    });
    var body = d3.select("body");
    body.on("mouseup", function() {
        var s = svg.select("rect.selection");
		if (s!==null) { 
			var d = {
					x: parseInt(s.attr("x"),10),
					y: parseInt(s.attr("y"),10),
					mx: parseInt(s.attr("mx"),10),
					my: parseInt(s.attr("my"),10),
					width: parseInt(s.attr("width"),10),
					height: parseInt(s.attr("height"),10)
			};
			if(d.height > 20 && d.width > 20) {
				$('svg').find('g').each(function(i, elem){
					if ($(elem).attr("visibility")=="hidden") {return; }
					if(elem.id.indexOf('_') < 0){ return; }
					var r = elem.getBBox();
					if (d.x <= r.x && (d.x + d.width) >= (r.x + r.width) && 
						d.y <= r.y && (d.y + d.height) >= (r.y + r.height)){
						 seatclick($('#svgmap svg g[id="' + elem.id + '"]'));
					}
				})
			} else {
				$('svg').find('g').each(function(i, elem){
					if ($(elem).attr("visibility")=="hidden") {return; }
					if(elem.id.indexOf('_') < 0){ return; }
					var p = d3.mouse(this);
					var r = elem.getBBox();
					if (p[0] > r.x && p[0] < (r.x + r.width) &&
						p[1] > r.y && p[1] < (r.y + r.height)){
						seatclick($('#svgmap svg g[id="' + elem.id + '"]'));
						return false;
					}
				})
			}
		}
		s.remove();
	
    });
}
