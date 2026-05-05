@extends('layouts.app')
@section('title', 'Eco Monitor — EcoHub KZ')
@section('content')
<link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>

<div class="monitor-root">
    <div class="monitor-header">
        <div class="monitor-header-left">
            <div class="eye-icon-wrap"><i class="fas fa-eye"></i><span class="eye-ring"></span><span class="eye-ring r2"></span></div>
            <div>
                <h1 class="monitor-title">ECO MONITOR<span class="blink">_</span></h1>
                <div class="monitor-subtitle">GLOBAL_SURVEILLANCE // NURALEM_V3 <span class="status-online">● LIVE</span></div>
            </div>
        </div>
        <div style="display:flex;gap:10px;align-items:center;">
            <div class="hdr-stat"><span class="hdr-stat-val" id="hdr-flows">0000</span><span class="hdr-stat-lbl">FLOWS/s</span></div>
            <div class="hdr-stat"><span class="hdr-stat-val" style="color:#ff4444;">15</span><span class="hdr-stat-lbl">THREATS</span></div>
            <a href="{{ route('dashboard') }}" class="monitor-back-btn"><i class="fas fa-arrow-left"></i> Dashboard</a>
        </div>
    </div>
    <div class="scanline"></div>
    <div id="eco-map"></div>

    <!-- TERMINAL -->
    <div class="terminal-box" id="terminal-box">
        <div class="term-hdr">
            <span class="term-dot" style="background:#ff5f56;"></span>
            <span class="term-dot" style="background:#ffbd2e;"></span>
            <span class="term-dot" style="background:#27c93f;"></span>
            <span class="term-title">eco-monitor@nuralem:~</span>
        </div>
        <div class="term-body" id="term-body"></div>
    </div>

    <!-- LEGEND -->
    <div class="hud-bottom-left">
        <div class="hud-legend">
            <div class="hud-legend-title">THREAT_CLASS</div>
            <div class="legend-item"><span class="ldot" style="background:#ff4444;"></span>WILDFIRE</div>
            <div class="legend-item"><span class="ldot" style="background:#4488ff;"></span>FLOOD</div>
            <div class="legend-item"><span class="ldot" style="background:#ff8800;"></span>INDUSTRIAL</div>
            <div class="legend-item"><span class="ldot" style="background:#ffcc00;"></span>DROUGHT</div>
            <div class="legend-item"><span class="ldot" style="background:#cc44ff;"></span>AIR_POLLUTION</div>
        </div>
    </div>
</div>

<style>
.main-wrapper{padding:0!important;border-radius:0!important;}
.monitor-root{position:relative;background:#000;overflow:hidden;}
.scanline{position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:90;
    background:repeating-linear-gradient(0deg,rgba(0,255,100,.025) 0px,rgba(0,255,100,.025) 1px,transparent 1px,transparent 3px);}
.monitor-header{display:flex;justify-content:space-between;align-items:center;padding:12px 20px;background:rgba(0,0,0,.92);border-bottom:1px solid rgba(16,185,129,.3);position:relative;z-index:50;height:65px;}
.monitor-header-left{display:flex;align-items:center;gap:14px;}
.eye-icon-wrap{position:relative;width:42px;height:42px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#10b981;}
.eye-ring{position:absolute;width:100%;height:100%;border:2px solid rgba(16,185,129,.5);border-radius:50%;animation:eye-rotate 4s linear infinite;}
.eye-ring.r2{border-color:rgba(16,185,129,.2);animation-duration:6s;animation-direction:reverse;width:130%;height:130%;top:-15%;left:-15%;}
@keyframes eye-rotate{to{transform:rotate(360deg)}}
.monitor-title{font-family:'JetBrains Mono',monospace;font-size:1.1rem;color:#10b981;letter-spacing:4px;font-weight:900;margin:0;}
.blink{animation:blink-cursor 1s infinite;}
@keyframes blink-cursor{0%,50%{opacity:1}51%,100%{opacity:0}}
.monitor-subtitle{font-family:'JetBrains Mono',monospace;font-size:.58rem;color:rgba(16,185,129,.6);letter-spacing:2px;margin-top:2px;}
.status-online{color:#10b981;animation:pulse-status 2s infinite;}
@keyframes pulse-status{0%,100%{opacity:1}50%{opacity:.3}}
.hdr-stat{display:flex;flex-direction:column;align-items:center;padding:6px 14px;border:1px solid rgba(16,185,129,.2);border-radius:8px;background:rgba(0,10,5,.7);}
.hdr-stat-val{font-family:'JetBrains Mono',monospace;font-size:1rem;font-weight:900;color:#10b981;}
.hdr-stat-lbl{font-family:'JetBrains Mono',monospace;font-size:.48rem;color:rgba(16,185,129,.5);letter-spacing:2px;}
.monitor-back-btn{display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.6);text-decoration:none;font-size:.82rem;padding:9px 16px;border:1px solid rgba(255,255,255,.15);border-radius:10px;transition:.3s;}
.monitor-back-btn:hover{color:#10b981;border-color:#10b981;background:rgba(16,185,129,.1);}
#eco-map{width:100%;height:calc(100vh - 65px);}

/* TERMINAL */
.terminal-box{position:fixed;bottom:20px;right:20px;width:380px;height:260px;background:rgba(0,8,4,.93);border:1px solid rgba(16,185,129,.35);border-radius:14px;overflow:hidden;z-index:200;box-shadow:0 0 30px rgba(16,185,129,.15),0 0 60px rgba(0,0,0,.8);display:flex;flex-direction:column;}
.term-hdr{display:flex;align-items:center;gap:7px;padding:10px 14px;background:rgba(16,185,129,.08);border-bottom:1px solid rgba(16,185,129,.2);}
.term-dot{width:12px;height:12px;border-radius:50%;display:inline-block;}
.term-title{font-family:'JetBrains Mono',monospace;font-size:.65rem;color:rgba(16,185,129,.7);margin-left:8px;letter-spacing:2px;}
.term-body{flex:1;overflow:hidden;padding:10px 14px;font-family:'JetBrains Mono',monospace;font-size:.68rem;line-height:1.7;color:#10b981;display:flex;flex-direction:column;gap:0;}
.term-line{animation:fadeInLine .3s ease;}
@keyframes fadeInLine{from{opacity:0;transform:translateX(-8px)}to{opacity:1;transform:translateX(0)}}
.term-kw{color:#ffcc00;}
.term-ip{color:#4af;}
.term-red{color:#ff6666;}
.term-dim{color:rgba(16,185,129,.4);}

/* Plaques */
.eco-plaque{font-family:'JetBrains Mono',monospace;background:rgba(0,8,4,.88);border:1px solid currentColor;border-radius:6px;padding:7px 10px;min-width:170px;cursor:pointer;box-shadow:0 0 12px rgba(0,0,0,.6);backdrop-filter:blur(8px);transition:transform .2s;}
.eco-plaque:hover{transform:scale(1.05);}
.plaque-top{display:flex;align-items:center;gap:6px;margin-bottom:4px;}
.plaque-sq{width:8px;height:8px;border-radius:1px;flex-shrink:0;}
.plaque-name{font-size:.65rem;font-weight:900;letter-spacing:1px;color:white;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px;}
.plaque-row{display:flex;justify-content:space-between;font-size:.55rem;letter-spacing:1px;margin-top:2px;}
.plaque-type{color:rgba(255,255,255,.45);}
.plaque-sev{font-weight:900;}
.plaque-bar-wrap{height:3px;background:rgba(255,255,255,.1);border-radius:2px;margin-top:5px;overflow:hidden;}
.plaque-bar{height:100%;border-radius:2px;transition:width .5s;}

/* Dynamic Scaling */
.eco-plaque {
    transform: scale(var(--map-zoom-scale, 1));
    transition: transform 0.1s ease-out;
    transform-origin: center;
}

/* Hide details when too small */
.eco-plaque.mini .plaque-name, 
.eco-plaque.mini .plaque-row, 
.eco-plaque.mini .plaque-bar-wrap { 
    display: none; 
}
.eco-plaque.mini {
    min-width: 15px;
    padding: 3px;
}

/* Legend */
.hud-bottom-left{position:fixed;bottom:20px;left:15px;z-index:50;}
.hud-legend{background:rgba(0,10,5,.85);backdrop-filter:blur(15px);border:1px solid rgba(16,185,129,.25);border-radius:12px;padding:14px 16px;}
.hud-legend-title{font-family:'JetBrains Mono',monospace;font-size:.52rem;color:#10b981;letter-spacing:3px;margin-bottom:10px;font-weight:800;}
.legend-item{display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.8);font-family:'JetBrains Mono',monospace;font-size:.65rem;margin-bottom:5px;letter-spacing:1px;}
.ldot{width:8px;height:8px;border-radius:1px;display:inline-block;flex-shrink:0;}

/* Hide Mapbox attribution */
.mapboxgl-ctrl-bottom-left, .mapboxgl-ctrl-bottom-right { display: none !important; }

/* Mapbox popup */
.mapboxgl-popup-content{background:rgba(0,10,5,.95)!important;padding:0!important;border-radius:10px!important;border:1px solid rgba(16,185,129,.4)!important;box-shadow:0 0 25px rgba(16,185,129,.2)!important;}
.mapboxgl-popup-tip{border-top-color:rgba(0,10,5,.95)!important;}
.mapboxgl-popup-close-button{color:#10b981!important;}
.mapboxgl-ctrl-group{background:rgba(0,10,5,.9)!important;border:1px solid rgba(16,185,129,.3)!important;border-radius:10px!important;}
.mapboxgl-ctrl-group button{color:#10b981!important;}
@media(max-width:768px){.terminal-box{width:90%;right:5%;}.hud-bottom-left{display:none;}}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Mapbox token is now pulled from environment variables for security
    mapboxgl.accessToken = '{{ env('MAPBOX_ACCESS_TOKEN') }}';

    const map = new mapboxgl.Map({
        container: 'eco-map',
        style: 'mapbox://styles/mapbox/dark-v11',
        center: [66.9, 48.0], zoom: 3.0, pitch: 48, bearing: -15,
        antialias: true, projection: 'globe'
    });
    map.addControl(new mapboxgl.NavigationControl({ visualizePitch: true }), 'top-left');

    const threats = [
        { lng:76.95,  lat:49.95, type:'WILDFIRE',   name:'Abai Forest Fire',     desc:'East KZ — 5,000 ha',        sev:8,  color:'#ff4444', img:'https://images.unsplash.com/photo-1542332213-9b5a5a3fab35?q=80&w=600' },
        { lng:90.0,   lat:56.0,  type:'WILDFIRE',   name:'Siberia Fire',         desc:'Russia — massive wildfire', sev:9,  color:'#ff4444', img:'https://images.unsplash.com/photo-1580974511812-4b719855a83e?q=80&w=600' },
        { lng:-119.4, lat:36.7,  type:'WILDFIRE',   name:'California Fire',      desc:'USA West — seasonal',       sev:7,  color:'#ff4444', img:'https://images.unsplash.com/photo-1444464666168-49d633b867ad?q=80&w=600' },
        { lng:-55.0,  lat:-5.0,  type:'WILDFIRE',   name:'Amazon Fire',          desc:'Brazil — tropical forest',  sev:10, color:'#ff4444', img:'https://images.unsplash.com/photo-1599381443690-eef39275144d?q=80&w=600' },
        { lng:145.0,  lat:-37.0, type:'WILDFIRE',   name:'Victoria Fires',       desc:'Australia — bushfires',     sev:8,  color:'#ff4444', img:'https://images.unsplash.com/photo-1541675154750-0444c7d51e8e?q=80&w=600' },
        { lng:51.88,  lat:47.10, type:'FLOOD',      name:'Atyrau Flood',         desc:'Zhaik River — 12K evac.',   sev:9,  color:'#4488ff', img:'https://images.unsplash.com/photo-1547683905-f686c993aae5?q=80&w=600' },
        { lng:63.58,  lat:53.21, type:'FLOOD',      name:'Kostanay Flood',       desc:'Tobol River overflow',      sev:7,  color:'#4488ff', img:'https://images.unsplash.com/photo-1621244301540-8451f28682a8?q=80&w=600' },
        { lng:69.3,   lat:30.3,  type:'FLOOD',      name:'Pakistan Flood',       desc:'Monsoon flooding',          sev:10, color:'#4488ff', img:'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?q=80&w=600' },
        { lng:-90.0,  lat:30.0,  type:'FLOOD',      name:'Louisiana Surge',      desc:'USA — coastal flooding',    sev:8,  color:'#4488ff', img:'https://images.unsplash.com/photo-1444412667101-49033327d425?q=80&w=600' },
        { lng:120.0,  lat:30.0,  type:'FLOOD',      name:'Yangtze Basin',        desc:'China — heavy rains',       sev:9,  color:'#4488ff', img:'https://images.unsplash.com/photo-1508802913134-406bc4247a61?q=80&w=600' },
        { lng:72.95,  lat:50.10, type:'INDUSTRIAL', name:'Temirtau Plants',      desc:'ArcelorMittal — air poll.', sev:8,  color:'#ff8800', img:'https://images.unsplash.com/photo-1521510895919-46920266ddb3?q=80&w=600' },
        { lng:59.6,   lat:45.0,  type:'INDUSTRIAL', name:'Aral Sea Crisis',      desc:'Sea fully dried — desert',  sev:10, color:'#ff8800', img:'https://images.unsplash.com/photo-1552562725-b40b8a1e3609?q=80&w=600' },
        { lng:88.2,   lat:69.3,  type:'INDUSTRIAL', name:'Norilsk Pollution',    desc:'Russia — heavy metals',     sev:9,  color:'#ff8800', img:'https://images.unsplash.com/photo-1534447677768-be436bb09401?q=80&w=600' },
        { lng:31.0,   lat:30.0,  type:'INDUSTRIAL', name:'Nile Delta Delta',     desc:'Egypt — industrial waste',  sev:7,  color:'#ff8800', img:'https://images.unsplash.com/photo-1510003051410-06f157778b0e?q=80&w=600' },
        { lng:68.25,  lat:43.30, type:'DROUGHT',    name:'Turkistan Drought',    desc:'South KZ — crops lost',     sev:7,  color:'#ffcc00', img:'https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?q=80&w=600' },
        { lng:45.0,   lat:5.0,   type:'DROUGHT',    name:'Horn of Africa',       desc:'Somalia/Ethiopia — severe', sev:10, color:'#ffcc00', img:'https://images.unsplash.com/photo-1504100321441-28687f872c0d?q=80&w=600' },
        { lng:-100.0, lat:40.0,  type:'DROUGHT',    name:'Midwest Dry',          desc:'USA — agriculture risk',    sev:6,  color:'#ffcc00', img:'https://images.unsplash.com/photo-1544233726-9f1d2b27bd8b?q=80&w=600' },
        { lng:76.95,  lat:43.24, type:'AIR_POLL',   name:'Almaty Air Crisis',    desc:'PM2.5 — 5x over norm',      sev:9,  color:'#cc44ff', img:'https://images.unsplash.com/photo-1527482797697-8795b05a13fe?q=80&w=600' },
        { lng:77.1,   lat:28.6,  type:'AIR_POLL',   name:'Delhi Smog',           desc:'India — most polluted',     sev:10, color:'#cc44ff', img:'https://images.unsplash.com/photo-1585747355038-04f509e083c6?q=80&w=600' },
        { lng:116.4,  lat:39.9,  type:'AIR_POLL',   name:'Beijing Smog',         desc:'China — industrial haze',   sev:8,  color:'#cc44ff', img:'https://images.unsplash.com/photo-1503112833075-84223f669a71?q=80&w=600' },
        { lng:12.5,   lat:41.9,  type:'AIR_POLL',   name:'Rome Emissions',       desc:'Italy — traffic smog',      sev:7,  color:'#cc44ff', img:'https://images.unsplash.com/photo-1552832230-c0197dd311b5?q=80&w=600' },
        { lng:37.6,   lat:55.7,  type:'AIR_POLL',   name:'Moscow Industrial',    desc:'Russia — urban haze',       sev:8,  color:'#cc44ff', img:'https://images.unsplash.com/photo-1513326738677-b964603b136d?q=80&w=600' },
    ];

    const flows = [
        { from:[76.95,43.24], to:[71.43,51.12] }, { from:[72.95,50.10], to:[76.95,43.24] },
        { from:[51.88,47.10], to:[71.43,51.12] }, { from:[116.4,39.9],  to:[77.1,28.6]   },
        { from:[90.0,56.0],   to:[76.95,49.95] }, { from:[59.6,45.0],   to:[51.88,47.10] },
        { from:[45.0,5.0],    to:[77.1,28.6]   }, { from:[-55.0,-5.0],  to:[-119.4,36.7] },
        { from:[68.25,43.30], to:[59.6,45.0]   }, { from:[88.2,69.3],   to:[76.95,49.95] },
        { from:[145.0,-37.0], to:[116.4,39.9]  }, { from:[37.6,55.7],   to:[71.43,51.12] },
        { from:[12.5,41.9],   to:[37.6,55.7]   }, { from:[-90.0,30.0],  to:[-100.0,40.0] },
        { from:[31.0,30.0],   to:[12.5,41.9]   }, { from:[120.0,30.0],  to:[116.4,39.9]  },
        { from:[71.43,51.12], to:[116.4,39.9]  }, { from:[77.1,28.6],   to:[71.43,51.12] },
        { from:[-119.4,36.7], to:[-90.0,30.0]  }, { from:[76.95,49.95], to:[37.6,55.7]   },
        { from:[-43.0,-22.0], to:[-55.0,-5.0]  }, { from:[139.0,35.0],  to:[116.4,39.9]  },
        { from:[103.0,1.0],   to:[77.1,28.6]   }, { from:[18.0,-33.0],  to:[31.0,30.0]   },
        { from:[-74.0,4.0],   to:[-55.0,-5.0]  }, { from:[2.0,48.0],    to:[12.5,41.9]   },
        { from:[100.0,13.0],  to:[120.0,30.0]  }, { from:[55.0,25.0],   to:[77.1,28.6]   },
        { from:[-99.0,19.0],  to:[-119.4,36.7] }, { from:[151.0,-33.0], to:[145.0,-37.0] },
    ];

    const markers = [];

    map.on('zoom', () => {
        const zoom = map.getZoom();
        const scale = Math.min(1.2, Math.max(0.4, (zoom / 4)));
        document.documentElement.style.setProperty('--map-zoom-scale', scale);
        markers.forEach(m => {
            const el = m.getElement();
            if (zoom < 3.5) el.classList.add('mini');
            else el.classList.remove('mini');
        });
    });

    map.on('style.load', () => {
        map.setFog({ color:'rgb(2,8,4)', 'high-color':'rgb(5,15,10)', 'horizon-blend':0.08, 'space-color':'rgb(0,2,1)', 'star-intensity':1.0 });
        map.addLayer({
            'id': '3d-buildings',
            'source': 'composite', 'source-layer': 'building',
            'filter': ['==', 'extrude', 'true'], 'type': 'fill-extrusion', 'minzoom': 13,
            'paint': {
                'fill-extrusion-color': '#10b981',
                'fill-extrusion-height': ['interpolate', ['linear'], ['zoom'], 13, 0, 13.05, ['get', 'height']],
                'fill-extrusion-base': ['interpolate', ['linear'], ['zoom'], 13, 0, 13.05, ['get', 'min_height']],
                'fill-extrusion-opacity': 0.6
            }
        });
    });

    function arcPoints(from, to, steps=60) {
        const pts = [];
        for (let i=0; i<=steps; i++) {
            const t = i/steps;
            pts.push([from[0]+(to[0]-from[0])*t, from[1]+(to[1]-from[1])*t + Math.sin(Math.PI*t)*12]);
        }
        return pts;
    }
    const arcPaths = flows.map(f => arcPoints(f.from, f.to));

    map.on('load', () => {
        map.addSource('mapbox-dem', { type:'raster-dem', url:'mapbox://mapbox.mapbox-terrain-dem-v1', tileSize:512 });
        map.setTerrain({ source:'mapbox-dem', exaggeration:1.2 });

        map.addSource('arcs', { type:'geojson', data:{ type:'FeatureCollection', features:arcPaths.map((pts,i) => ({
            type:'Feature', properties:{id:i}, geometry:{type:'LineString',coordinates:pts}
        }))}});
        map.addLayer({ id:'arc-lines', type:'line', source:'arcs', paint:{
            'line-color':'#10b981','line-width':1,'line-opacity':0.15,'line-dasharray':[4,4]
        }});

        const dotData = { type:'FeatureCollection', features: arcPaths.map((_,i) => ({
            type:'Feature', properties:{id:i, opacity:0}, geometry:{type:'Point',coordinates:arcPaths[i][0]}
        }))};
        map.addSource('dots', { type:'geojson', data:dotData });
        map.addLayer({ id:'data-dots', type:'circle', source:'dots', paint:{
            'circle-radius':1.8, 'circle-color':'#10b981', 'circle-opacity':['get', 'opacity'], 'circle-blur': 0.1
        }});

        const prg = new Array(flows.length).fill(0);
        const spd = flows.map(() => .01 + Math.random()*.02);
        function animDots() {
            prg.forEach((p,i) => {
                prg[i] = (p+spd[i])%1;
                const progress = prg[i];
                const path = arcPaths[i];
                const idx = Math.floor(progress*(path.length-1));
                dotData.features[i].geometry.coordinates = path[idx];
                let opacity = 1;
                if (progress < 0.1) opacity = progress / 0.1;
                else if (progress > 0.9) opacity = (1 - progress) / 0.1;
                dotData.features[i].properties.opacity = opacity;
            });
            map.getSource('dots').setData(dotData);
            requestAnimationFrame(animDots);
        }
        animDots();

        threats.forEach(t => {
            const el = document.createElement('div');
            el.className = 'eco-plaque';
            el.style.borderColor = t.color;
            el.innerHTML = `
                <div class="plaque-top">
                    <div class="plaque-sq" style="background:${t.color};"></div>
                    <div class="plaque-name" style="color:${t.color};">${t.name}</div>
                </div>
                <div class="plaque-bar-wrap"><div class="plaque-bar" style="width:${t.sev*10}%;background:${t.color};"></div></div>
            `;
            el.addEventListener('click', () => {
                new mapboxgl.Popup({ maxWidth:'320px', offset:15 })
                    .setLngLat([t.lng, t.lat])
                    .setHTML(`
                        <div style="background:rgba(0,10,5,0.95); border-radius:10px; overflow:hidden;">
                            <img src="${t.img}" style="width:100%; height:120px; object-fit:cover; border-bottom:1px solid ${t.color}">
                            <div style="padding:15px; color:white; font-family:'JetBrains Mono',monospace;">
                                <div style="color:${t.color}; font-size:0.9rem; font-weight:900; margin-bottom:8px;">${t.name}</div>
                                <p style="color:rgba(255,255,255,0.7); font-size:0.75rem; line-height:1.6; margin-bottom:10px;">${t.desc}</p>
                                <div style="display:flex; justify-content:space-between; font-size:0.6rem; letter-spacing:1px; color:${t.color}">
                                    <span>TYPE: ${t.type}</span>
                                    <span>SEV: ${t.sev}/10</span>
                                </div>
                            </div>
                        </div>
                    `)
                    .addTo(map);
            });
            const m = new mapboxgl.Marker({ element:el }).setLngLat([t.lng, t.lat]).addTo(map);
            markers.push(m);
        });

        let rotating = true;
        function rotateCam(ts) { if(rotating) map.rotateTo((ts/500)%360,{duration:0}); requestAnimationFrame(rotateCam); }
        setTimeout(() => requestAnimationFrame(rotateCam), 2000);
        map.on('mousedown', () => rotating=false);
        let rt;
        map.on('mouseup', () => { clearTimeout(rt); rt=setTimeout(()=>rotating=true,12000); });
    });

    const termBody = document.getElementById('term-body');
    const randIP = () => `${(Math.random()*200+10|0)}.${(Math.random()*254|0)}.${(Math.random()*254|0)}.${(Math.random()*254|0)}`;
    const randPort = () => [80,443,8080,22,3306,5432,9200,27017][Math.random()*8|0];
    const randBytes = () => (Math.random()*9999|0).toString().padStart(4,'0');
    const locs = ['KZ-ALM','KZ-NUR','RU-MOW','CN-BEJ','IN-DEL','US-LAX','BR-SAO','DE-BER','JP-TYO','GB-LON'];
    const protocols = ['TCP','UDP','HTTPS','WS','MQTT'];
    const msgs = [
        () => `<span class="term-kw">RECV</span> ${randIP()}<span class="term-dim">:${randPort()}</span> <span class="term-ip">${locs[Math.random()*locs.length|0]}</span> ${randBytes()}B`,
        () => `<span class="term-kw">SEND</span> ${randIP()}<span class="term-dim">:${randPort()}</span> <span class="term-ip">${protocols[Math.random()*protocols.length|0]}</span> <span class="term-dim">${randBytes()}ms</span>`,
        () => `<span class="term-red">ALERT</span> AIR_QUALITY threshold exceeded @ ${randIP()}`,
        () => `<span class="term-kw">SYNC</span> eco-node-${(Math.random()*99|0).toString().padStart(2,'0')} → ${locs[Math.random()*locs.length|0]}`,
        () => `<span class="term-dim">PING</span> ${randIP()} <span class="term-ip">${(Math.random()*200|0)}ms</span> TTL:${(Math.random()*64|0)+1}`,
        () => `<span class="term-kw">DATA</span> PKT#${(Math.random()*99999|0).toString().padStart(5,'0')} <span class="term-ip">${protocols[Math.random()*protocols.length|0]}</span> OK`,
        () => `<span class="term-red">WARN</span> POLLUTION_SPIKE detected src:${randIP()}`,
        () => `<span class="term-dim">STAT</span> bw_in:<span class="term-ip">${randBytes()}kbs</span> bw_out:<span class="term-ip">${randBytes()}kbs</span>`,
    ];
    function addTermLine() {
        const line = document.createElement('div'); line.className = 'term-line';
        line.innerHTML = `<span class="term-dim">$ </span>${msgs[Math.random()*msgs.length|0]()}`;
        termBody.appendChild(line);
        while (termBody.children.length > 9) termBody.removeChild(termBody.firstChild);
        termBody.scrollTop = termBody.scrollHeight;
    }
    for(let i=0;i<9;i++) addTermLine();
    setInterval(addTermLine, 700);
});
</script>
@endsection
