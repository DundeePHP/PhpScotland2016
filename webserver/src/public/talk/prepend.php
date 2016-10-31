<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=1024, user-scalable=no">

    <title>Presentation</title>
  
    <script src="/js/deck.js/jquery.min.js"></script>
    <script src="/js/deck.js/core/deck.core.js"></script>
    <script src="/js/deck.js/extensions/menu/deck.menu.js"></script>
    <script src="/js/deck.js/extensions/goto/deck.goto.js"></script>
    <script src="/js/deck.js/extensions/status/deck.status.js"></script>
    <script src="/js/deck.js/extensions/navigation/deck.navigation.js"></script>
    <script src="/js/deck.js/extensions/scale/deck.scale.js"></script>
    <script src="/js/autobahn.min.jgz"></script>
    <script>AUTOBAHN_DEBUG = true;</script>

    <link rel="stylesheet" media="screen" href="/js/deck.js/core/deck.core.css">
    <link rel="stylesheet" media="screen" href="/js/deck.js/extensions/goto/deck.goto.css">
    <link rel="stylesheet" media="screen" href="/js/deck.js/extensions/menu/deck.menu.css">
    <link rel="stylesheet" media="screen" href="/js/deck.js/extensions/navigation/deck.navigation.css">
    <link rel="stylesheet" media="screen" href="/js/deck.js/extensions/status/deck.status.css">
    <link rel="stylesheet" media="screen" href="/js/deck.js/extensions/scale/deck.scale.css">

    <!-- Style theme. More available in /themes/style/ or create your own. -->
    <link rel="stylesheet" media="screen" href="/js/deck.js/themes/style/swiss.css">

    <!-- Transition theme. More available in /themes/transition/ or create your own. -->
    <link rel="stylesheet" media="screen" href="/js/deck.js/themes/transition/horizontal-slide.css">

    <!-- Basic black and white print styles -->
    <link rel="stylesheet" media="print" href="/js/deck.js/core/print.css">

    <script src="/js/deck.js/modernizr.custom.js"></script>
    <script src="/js/zodiac-demo.js"></script>
    <script>
        (function($, deck, undefined) {
            $(document).bind('deck.change', function(e, from, to) {
               var $prev = $[deck]('getSlide', to-1),
               $next = $[deck]('getSlide', to+1),
               $oldprev = $[deck]('getSlide', from-1),
               $oldnext = $[deck]('getSlide', from+1);

               var direction = "forward";
               if(from > to){
                 direction = "reverse";
               }

               $[deck]('getSlide', to).trigger('deck.becameCurrent', direction);
               $[deck]('getSlide', from).trigger('deck.lostCurrent', direction);

               $prev && $prev.trigger('deck.becamePrevious', direction);
               $next && $next.trigger('deck.becameNext', direction);

               $oldprev && $oldprev.trigger('deck.lostPrevious', direction);
               $oldnext && $oldnext.trigger('deck.lostNext', direction);
            });
         })(jQuery, 'deck');
    </script>
    <style>
        html {
            margin: 0px auto;
            max-width: 1000px;
        }
        .white-background {
            background-color: #FFF;
        }
        #footer-00100 {
            position: absolute;
            width: 100%;
            padding-left: 30px;
            padding-bottom: 20px;
            padding-top: 20px;
            bottom: 0;
            left: 0;
            height: 80px;
            background-color: #ffab62;
            border-top: 1px solid #ff4b02;
            color: #333;
            text-shadow: 1px 1px 0 rgba(255,255,255,0.6);
        }
        #footer-10500 {
            position: absolute;
            width: 100%;
            padding-left: 30px;
            padding-bottom: 20px;
            padding-top: 20px;
            bottom: 0;
            left: 0;
            height: 80px;
            background-color: #ffab62;
            border-top: 1px solid #ff4b02;
            color: #333;
            text-shadow: 1px 1px 0 rgba(255,255,255,0.6);
        }
        #notify {
            position: absolute;
            width: 100%;
            padding-left: 30px;
            padding-bottom: 20px;
            padding-top: 20px;
            bottom: 0;
            left: 0;
            height: 80px;
            background-color: #ffab62;
            border-top: 1px solid #ff4b02;
            color: #333; 
            font-size: 0.5em;
        }
        .endofseq {
            background-color: #FFF;
            color: #0;
            padding: 15px;
            text-decoration: blink;
        }
        .deck-status {
            right: 100px;
            bottom: 200px;
            padding: 15px;
        }
        
        .Constellation {
            width: 106px;
            height: 120px;
            background-image: url(/img/cartoon_constellation.jpg);
            background-repeat: no-repeat;
        }
        .Constellation0 { background-position: 0px 0px; }
        .Constellation1 { background-position: -106px 0px; }
        .Constellation2 { background-position: -212px 0px; }
        .Constellation3 { background-position: -318px 0px; }
        .Constellation4 { background-position: 0px -120px; }
        .Constellation5 { background-position: -106px -120px; }
        .Constellation6 { background-position: -212px -120px; }
        .Constellation7 { background-position: -318px -120px; }
        .Constellation8 { background-position: 0px -255px; }
        .Constellation9 { background-position: -106px -255px; }
        .Constellation10 { background-position: -212px -255px; }
        .Constellation11 { background-position: -318px -255px; }
        
        .statustitle { font-size: 0.65em; }
        .statusfont { font-size: 0.5em; margin-left: 3px;}
        .maintable { width: 100%; }
        .cellheight { height: 120px; }
        .table-cells { width: 120px; }
        
        a.showbtn, a.showbtn:link, a.showbtn:visited {
            font-family: Verdana, Geneva, Tahoma, Arial, Helvetica, sans-serif;
            display: inline-block;
            color: #FFFFFF;
            background-color: #8AC007;
            font-size: 15px;
            text-align: center;
            padding: 5px 16px;
            text-decoration: none;
            margin-left: 5px;
            margin-right: 5px;
            margin-top: 0px;
            margin-bottom: 5px;
            border: 1px solid #8AC007;
            white-space: nowrap;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }
        
        #S02500-wrapper {
            margin-right: 200px;
        }
        #S02500-left {
            float: left;
            width: 50%;
        }
        #S02500-right {
            float: right;
            width: 50%;
            margin-right: -200px;            
        }
        #S02500-cleared {
            clear: both;
        }
    
    </style>
</head>
<body bgcolor="#0">
