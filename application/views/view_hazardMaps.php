<div id="hazMap_viewAbra" style="width: 100%; height: 100%;">
    <div id="map1" style="margin-top: 0%;margin-right: 25%;margin-left: 25%;width: 50%; height: 100%; position: absolute">
    <script>        
        var tilesLayer = new L.TileLayer('<?php echo base_url()?>' + 'hazardMaps/abra/{z}/{x}/{y}.png',
            { nowrap:'true', minZoom : 10, maxZoom : 11});
        map = new L.Map('map1');                
        map.addLayer(tilesLayer);
        map.setView(new L.LatLng (17.5962, 120.8194), 10);        
        map.setMaxBounds([[17.97612, 120.41256],[16.06111, 121.21721]]);
        map.on('click', function(e){
            alert(e.latlng)
        });
    </script>
    </div>
</div>
<div id="hazMap_viewApayao" style="width: 100%; height: 100%; visibility:hidden;">
    <div id="map2" style="margin-top: 0%;margin-right: 25%;margin-left: 25%;width: 50%; height: 100%; position: absolute">
    <script>        
        var tilesLayer = new L.TileLayer('<?php echo base_url()?>' + 'hazardMaps/apayao/{z}/{x}/{y}.png',
            { nowrap:'true', minZoom : 9, maxZoom : 11});
        map = new L.Map('map2');                
        map.addLayer(tilesLayer);
        map.setView(new L.LatLng (18.1054, 121.1902), 9);        
        map.setMaxBounds([[18.75031, 120.56534],[16.32966, 121.62552]]);
        map.on('click', function(e){
            alert(e.latlng);
        });
    </script>
    </div>
</div>
<div id="hazMap_viewBenguet" style="width: 100%; height: 100%;visibility:hidden; ">
    <div id="map3" style="margin-top: 0%;margin-left: 0%;width: 100%; height: 100%; position: absolute">
    <script>        
        var tilesLayer = new L.TileLayer('<?php echo base_url()?>' + 'hazardMaps/benguet/{z}/{x}/{y}.png',
            { nowrap:'true', minZoom : 9, maxZoom : 10});
        map = new L.Map('map3');                
        map.addLayer(tilesLayer);
        map.setView(new L.LatLng (16.5217, 120.6958), 9);        
//        map.setMaxBounds([[17.3179,121.5753],[15.6984,120.1135]]);
    </script>
    </div>
</div>
<div id="hazMap_viewIfugao" style="width: 100%; height: 100%;visibility:hidden;">    
    <div id="map4" style="margin-top: 0%;margin-left: 0%;width: 100%; height: 100%; position: absolute">
    <script>        
        var tilesLayer = new L.TileLayer('<?php echo base_url()?>' + 'hazardMaps/ifugao/{z}/{x}/{y}.png',
            { nowrap:'true', minZoom : 10, maxZoom : 11});
        map = new L.Map('map4');                
        map.addLayer(tilesLayer);
        map.setView(new L.LatLng (16.8591, 121.2506), 10);        
//        map.setMaxBounds([[17.3011,121.812],[16.4809,120.7617]]);
    </script>
    </div>
</div>
<div id="hazMap_viewKalinga" style="width: 100%; height: 100%;visibility:hidden;">    
    <div id="map5" style="margin-top: 0%;margin-left: 0%;width: 100%; height: 100%; position: absolute">
    <script>        
        var tilesLayer = new L.TileLayer('<?php echo base_url()?>' + 'hazardMaps/kalinga/{z}/{x}/{y}.png',
            { nowrap:'true' ,minZoom : 10, maxZoom : 11});
        map = new L.Map('map5');                
        map.addLayer(tilesLayer);
        map.setView(new L.LatLng (17.4378, 121.3055), 10);        
//        map.setMaxBounds([[17.7036,121.8319],[16.9674,120.8]])
    </script>
    </div>
</div>
<div id="hazMap_viewMountainProvince" style="width: 100%; height: 100%;visibility:hidden;">    
    <div id="map6" style="margin-top: 0%;margin-left: 0%;width: 100%; height: 100%; position: absolute">
    <script>        
        var tilesLayer = new L.TileLayer('<?php echo base_url()?>' + 'hazardMaps/mt/{z}/{x}/{y}.png',
            { nowrap:'true', minZoom : 9, maxZoom : 10});
        map = new L.Map('map6');                
        map.addLayer(tilesLayer);
        map.setView(new L.LatLng (17.1316, 121.2204), 9);        
//        map.setMaxBounds([[17.8223,122.2911],[16.2559,120.2862]]);

    </script>
    </div>
</div>
