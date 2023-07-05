app.service('SfDraw', ['$http', function($http) {
    this.id = "";

    this.clear = function(w, h) {
        var canv = document.getElementById(this.id);
        var ctx = canv.getContext('2d');
        ctx.clearRect(0, 0, canv.width, canv.height);
    }
    this.draw = function(tipe, fill_type, x, y, w, h,t, color, label,font_family,img_url,pattern_url) {;
        if (t == undefined || t == null) {
            t = 20;
        }
        var canv = document.getElementById(this.id);
        var ctx = canv.getContext('2d');
        ctx.beginPath();
        if (fill_type == 'fill') {
            ctx.fillStyle = color;
        } else {
            ctx.strokeStyle = color;
        }
        ctx.lineWidth = t;

        switch (tipe) {
            case 'square':
                if (fill_type == 'fill') {
                    ctx.fillRect(x, y, w, h);
                } else {
                    ctx.strokeRect(x, y, w, h);
                }
                break;
            case 'circle':
                ctx.beginPath();
                ctx.arc(x, y, w, 0, 2 * Math.PI);
                if (fill_type == 'fill') {
                    ctx.fill();
                } else {
                    ctx.stroke();
                }
                break;
            case 'line':
                ctx.moveTo(x, y);
                ctx.lineTo(w, h);
                if (fill_type == 'fill') {
                    ctx.fill();
                } else {
                    ctx.stroke();
                }
                break;
            case 'text':
            	ctx.fillStyle = color;
                ctx.font = w + "px Verdana";
                ctx.fillText(label, x, y);
                break;
            case 'icon':
                ctx.font = w + "px FontAwesome";
                ctx.fillText(label, x, y);
                break;
            case 'image':
            	var img = new Image;
				img.onload = function(){
				  ctx.drawImage(img,x,y,w,h); // Or at whatever offset you like
				};
				img.src = img_url;
                break;
        }

        ctx.closePath();

    }

    this.grid = function(w, h,cell) {
        if(cell==undefined){
            cell=100;
        }
        thick=cell / 15;
        var canv = document.getElementById(this.id);
        var ctx = canv.getContext('2d');
        ctx.beginPath();
        ctx.lineWidth = thick;
        for (var x = 0.5; x < w; x += cell) {
            ctx.moveTo(x, 0);
            ctx.lineTo(x, h);
        }

        for (var y = 0.5; y < h; y += cell) {
            ctx.moveTo(0, y);
            ctx.lineTo(w, y);
        }
        ctx.strokeStyle = "rgb(226, 231, 235)";
        ctx.closePath();
        ctx.stroke();
    }
}]);