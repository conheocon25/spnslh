(function($) { 
	var map ;
    $.GoogleMapObjectDefaults = {        
        zoomLevel: 10,
		imagewidth: 50,
		imageheight: 50,
		center: 'Chua Giac Quang, 954, Phu Thuan A, Hong Ngu, Dong Thap, Vietnam',		
		start: '#start',		
        end: '#end',
		directions: 'directions',
        submit: '#getdirections',      	
		tooltip: 'Chùa Giác Quang, 954, Phú Thuận A, Hồng Ngự, Đồng Tháp, Việt Nam',
		image: 'false'
    };

    function GoogleMapObject(elementId, options) {        
        this._inited = false;
        this._map = null;
        this._geocoder = null;	
        
        this.ElementId = elementId;
        this.Settings = $.extend({}, $.GoogleMapObjectDefaults, options || '');
    }

    $.extend(GoogleMapObject.prototype, {
        init: function() {
            if (!this._inited) {
                if (GBrowserIsCompatible()) {
                    this._map = new GMap2(document.getElementById(this.ElementId));
                    this._map.addControl(new GSmallMapControl());
                    this._geocoder = new GClientGeocoder();
					//this._map.setMapType(G_SATELLITE_MAP);
					//this._map.setMapType(G_NORMAL_MAP);
					this._map.setMapType(G_HYBRID_MAP);										
					this._map.enableScrollWheelZoom();										
					this._map.setUIToDefault();											
                }		
                this._inited = true;
            }
        },
        load: function() {            
            this.init();	    
            if (this._geocoder) {                
                var zoom = this.Settings.zoomLevel;
                var center = this.Settings.center;
				var width = this.Settings.imagewidth;
				var height = this.Settings.imageheight;
                map = this._map;
		
				if (this.Settings.tooltip != 'false') {
					var customtooltip = true;
					var tooltipinfo = this.Settings.tooltip;
				}				
				if (this.Settings.image != 'false') {
					var customimage = true;
					var imageurl = this.Settings.image;
				}		
                this._geocoder.getLatLng(center, function(point) {
                    if (!point) { alert(center + " not found"); }
                    else {
                        //set center on the map
                        map.setCenter(point, zoom);
			
						if (customimage == true) {
							//add the marker
							var customiconsize = new GSize(width, height);
							var customicon = new GIcon(G_DEFAULT_ICON, imageurl);
							customicon.iconSize = customiconsize;
							var marker = new GMarker(point, { icon: customicon });
							map.addOverlay(marker);
						} else {
							var marker = new GMarker(point);
							map.addOverlay(marker);
						}
						
						if(customtooltip == true) {
							marker.openInfoWindowHtml(tooltipinfo);
						}
                    }
                });
				
            }
	                
            $.data($(this.Settings.submit)[0], 'inst', this);	
			
            $(this.Settings.submit).click(function(e) {
                e.preventDefault();
                var obj = $.data(this, 'inst');
				var outputto = obj.Settings.directions;
                var from = $(obj.Settings.start).val();
                var to = $(obj.Settings.end).val();
				map.clearOverlays();
				$('#' + outputto).html('');
				var gdir = new GDirections(map, document.getElementById(outputto));
				gdir.load("from: " + from + " to: " + to);		
            });	
			
			$('#cboTinhThanh').change(function(e) {
                e.preventDefault();
				var from; 
				$("select#cboTinhThanh option:selected").each(function () {
						from = $(this).text();
				});				
                var obj = $.data(this, 'inst');
                var to = $('#end').val();
				map.clearOverlays();
				$('#directions' ).html('');
				var gdir = new GDirections(map, document.getElementById('directions'));
				gdir.load("from: " + from + " to: " + to);		
            }).change();	
			
            return this;
        }
    });

    $.extend($.fn, {
        googleMap: function(options) {           
            var mapInst = $.data(this[0], 'googleMap');
            if (mapInst) {
                return mapInst;
            }           
            mapInst = new GoogleMapObject($(this).attr('id'), options);
            $.data(this[0], 'googleMap', mapInst);
            return mapInst;
        }
    });
	
})(jQuery);
