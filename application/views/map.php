<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang = "en" lang = "en">
    <head>
        <title>Maps</title>
        <meta http-equiv = "Content-Type" content = "text/html;charset=utf-8"/>
        <meta name = "apple-mobile-web-app-capable" content = "yes"/>
        <meta name = "apple-mobile-web-app-status-bar-style" content = "black"/>


        <meta name = "viewport" content = "width=device-width; initial-scale=0.5; maximum-scale=1.0; user-scalable=0;"/>
        <style type = "text/css">
            img {border-width: 0}
            * {font-family:'Lucida Grande', sans-serif;
            }
        </style>
    </head>
    <body>

        <div style = "background: url('<?= img_url().'map-eng.png'?>') no-repeat; width: 960px; height: 540px;"></div>
        <div name = "man" style = "position: absolute; top: <?php echo $man_dep_lat ?>px; left: <?php echo $man_dep_long ?>px"><img src = "<?= img_url().'Man2.png'?>"></div>
        <div name = "flag" style = "position: absolute; top: <?php echo $flag_dep_lat ?>px; left: <?php echo $flag_dep_long ?>px"><img src = "<?= img_url().'Flag.png'?>"></div>

    </body>
</html>