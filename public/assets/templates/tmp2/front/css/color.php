<?php
header("Content-Type:text/css");
$color = "";
$color2 = "";
$color3 = "";
function checkhexcolor($c)
{
    return preg_match('/^[a-f0-9]{6}$/i', $c);
}

if (isset($_GET['color']) && !empty($_GET['color']) && checkhexcolor($_GET['color'])) {
    $color = '#' . $_GET['color'];
}
if (!$color) {
    $color = "#ec4e20";
}
if (isset($_GET['color2']) && !empty($_GET['color2']) && checkhexcolor($_GET['color2'])) {
    $color2 = '#' . $_GET['color2'];
}
if (!$color2) {
    $color2 = "#faa603";
}



function hex2rgba($color, $opacity)
{

    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    if (strlen($color) == 6) {
        list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    $rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';

    return $rgb;
}

function hex2rgba2($color2, $opacity2)
{

    if ($color2[0] == '#') {
        $color2 = substr($color2, 1);
    }
    if (strlen($color2) == 6) {
        list($r, $g, $b) = array($color2[0] . $color2[1], $color2[2] . $color2[3], $color2[4] . $color2[5]);
    } elseif (strlen($color2) == 3) {
        list($r, $g, $b) = array($color2[0] . $color2[0], $color2[1] . $color2[1], $color2[2] . $color2[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    $rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity2 . ')';

    return $rgb;
}


?>


.custom-button::after, .custom-button::before {
background: <?php echo $color ?>;;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: -2;
-webkit-transition: all ease 0.3s;
-moz-transition: all ease 0.3s;
transition: all ease 0.3s;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
}




.gradient-bg-two::after, .gradient-bg::after {
background: <?php echo $color2 ?>;

opacity: 1;
top: 0;
left: 0;
right: 0;
bottom: 0;
}

.service-item:hover p, .service-item:hover .title a {
color: #ffffff;
z-index: 1;
}

.service-item:hover .service-content .title{
color: #ffffff;
}

.contact-info::after {
top: 0;
left: 0;
bottom: 0;
right: 0;
background: linear-gradient(to right top, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
background: -webkit-linear-gradient(to right top, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
opacity: .92;
}

.post-item:hover .post-content .blog-header .title a {
color: <?php echo $color ?>;
}

.post-item .post-content .meta-post a:hover {
color: <?php echo $color ?>;
}

.item-info .icon i {
color: <?php echo $color ?>;
}



.bg-theme .video-button i {
color: <?php echo $color ?> !important;
}


.contact-form-dynamic .form-group input[type="submit"] {
height: 54px;
color: white;
font-weight: 600;
font-family: Poppins, sans-serif;
text-transform: capitalize;
width: auto;
background: -webkit-linear-gradient(177deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
}


.widget.widget-post ul li .content .meta a:hover {
color: <?php echo $color ?>;
}
.service-item::before {

background: <?php echo $color ?> ;

}

.service-item .service-thumb i {
background:  <?php echo $color ?>;
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
}

.ticket-item-three .ticket-header, .ticket-item-two .ticket-header, .ticket-item .ticket-header {
background: <?php echo $color2 ?> ;
}

.custom-button::after {
background: -webkit-linear-gradient(37deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
opacity: 0;
z-index: -1;
}
.custom-button::after, .custom-button::before {
background: -webkit-linear-gradient(177deg <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
}

.client-item .client-quote i {


background: -webkit-linear-gradient(177deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);

line-height: 1;

-webkit-background-clip: text;
-webkit-text-fill-color: transparent;

}

.bg-theme-hover:hover, .bg-theme {
background: <?php echo $color2 ?>;

}

.scrollToTop{


background: <?php echo $color ?>;

}

.scrollToTop:hover {
color: #ffffff;
background: -webkit-linear-gradient(177deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);

}


.post-item .post-content::before, .post-item .post-content::after {
height: 6px;
width: 100%;
background-image: -moz-linear-gradient(177deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
background-image: -webkit-linear-gradient(177deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
background-image: -ms-linear-gradient(177deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
opacity: 0.11;
bottom: 0;
left: 0;
}

h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
color:<?php echo $color2 ?>;
}





.section-header.style-two .right-side::after {
top: 0;
left: 0;
width: 4px;
height: 100%;
-webkit-transform: translate(0);
-ms-transform: translate(0);
transform: translate(0);
background: -webkit-linear-gradient(37deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
}

.header-section.active {
background: <?php echo $color2 ?>;
}

.section-header .right-side::after {
background:<?php echo $color ?>;
}



.sec-color {
border: 1px solid <?php echo $color ?>;
padding: 4px 10px;
border-radius: 7px;
color: <?php echo $color ?>;
}

.level-com {
padding: 8px !important;
}

.custom-button.transparent {
color: <?php echo $color ?>;
}

.client-item .client .thumb a img{

height:60px;
}

a.header-button.custom-button.white {
padding: 8px 30px !important;
margin-top: 8px;
}
.post-item.post-details .post-content .tag-options .share a:hover {
color: <?php echo $color ?>;
}


.client-item .client .content .sub-title a {
color:<?php echo $color2 ?>;
}

.client-item .client .content .sub-title a:hover {
color:<?php echo $color ?>;
}

.preloader-icon span {
position: absolute;
display: inline-block;
width: 72px;
height: 72px;
border-radius: 100%;
background: -webkit-linear-gradient(177deg, <?php echo $color ?> 0%, <?php echo $color2 ?> 54%, <?php echo $color ?> 96%);
-webkit-animation: preloader-fx 1.6s linear infinite;
animation: preloader-fx 1.6s linear infinite;
}

.choto{
    font-size: 16px;
}
