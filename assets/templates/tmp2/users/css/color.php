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


.navbar-menu-wrapper[class*="bg"] {

background: -webkit-linear-gradient(177deg,  <?php echo $color ?> 0%, <?php echo $color2 ?> 80%);
}
.page-header {

background: -webkit-linear-gradient(177deg,  <?php echo $color ?> 0%, <?php echo $color2 ?> 80%);
}

.main-sidebar[class*="bg"] .nav-item > .nav-link:hover, .main-sidebar[class*="bg"] .nav-item.active > .nav-link, .main-sidebar[class*="bg"] .nav-item.open > .nav-link {
border-radius: 0;
background: -webkit-linear-gradient(177deg,  <?php echo $color ?> 0%, <?php echo $color2 ?> 80%);
-webkit-transition: all ease 0.3s;
-moz-transition: all ease 0.3s;
transition: all ease 0.3s;


border-left: 4px solid <?php echo $color ?>;
}

.btn-primary {
background: -webkit-linear-gradient(177deg, <?php echo $color ?> 0%, <?php echo $color2 ?> 88%);

-webkit-transition: all ease 0.3s;
-moz-transition: all ease 0.3s;
transition: all ease 0.3s;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;

}

.btn-primary:hover {
background: -webkit-linear-gradient(177deg,  <?php echo $color2 ?> 0%,  <?php echo $color ?> 88%);

-webkit-transition: all ease 0.3s;
-moz-transition: all ease 0.3s;
transition: all ease 0.3s;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;

}

.page-item.active .page-link {
z-index: 1;
color: #fff;
border-color: #0499dd;
background: -webkit-linear-gradient(177deg,  <?php echo $color2 ?> 0%,  <?php echo $color ?> 88%);
}

.sec-color {
background: -webkit-linear-gradient(177deg, <?php echo $color ?> 0%,  <?php echo $color2 ?> 80%);
padding: 4px 10px;
border-radius: 7px;
color:#fff;
}




.price-body ul li {

color: rgba(0, 0, 0, 0.75);
}

.price-body ul li {
padding: 15px 20px;
}

.price-body ul {
margin: 0 0 30px;
}

.pricingTable {
background-color: #fff;
font-family: 'Lato', sans-serif;
text-align: center;
padding: 0 0 30px;
margin: 25px 15px 0;
border: 1px solid #fff;
border-radius: 20px 20px 0 0;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
position: relative;
transition: all 0.3s;
margin-bottom: 45px;
}

.pricingTable:after {
content: "";
background: linear-gradient(to left, <?php echo $color ?>, <?php echo $color2 ?>);
height: 20px;
margin: 0 auto;
border-radius: 0 0 15px 15px;
position: absolute;
right: 0;
bottom: -20px;
left: 0;
}

.pricingTable .pricingTable-header {
margin: 0 0 25px;
position: relative;
z-index: 1;
}

.pricingTable .pricingTable-header:before,
.pricingTable .pricingTable-header:after {
content: "";
background: #fff;
width: 47%;
height: 29px;
border-radius: 0 20px 20px 0;
position: absolute;
bottom: -29px;
left: 0;
}

.pricingTable .pricingTable-header:after {
border-radius: 20px 0 0 20px;
left: auto;
right: 0;
}

.pricingTable .title {
color: #fff;
background: linear-gradient(to left, <?php echo $color ?>, <?php echo $color2 ?>);
font-size: 30px;
font-weight: 800;
letter-spacing: 1px;
text-transform: uppercase;
width: 80%;
padding: 16px 12px;
margin: -25px auto 0;
border-radius: 50px;
position: relative;
}

.pricingTable .title:before {
content: "";
background: linear-gradient(to left, <?php echo $color ?>, <?php echo $color2 ?>);
width: 55px;
height: 38px;
transform: translateX(-50%);
position: absolute;
bottom: -28px;
left: 50%;
z-index: -1;
}

.pricingTable .price-value {
color: #222;

line-height: 123px;

height: 130px;
margin: 0 auto 20px;
border-radius: 50%;
position: relative;
z-index: 1;
}

.pricingTable .price-value:before {
content: "";
background: #fff;
width: 105px;
height: 105px;
border-radius: 50px;
position: absolute;
top: 13px;
left: 13px;
z-index: -1;
}

.pricingTable .currency {
font-size: 40px;
vertical-align: top;
margin: -10px 0 0;
display: inline-block;
}

.pricingTable .amount {
font-size: 50px;
font-weight: 800;
display: inline-block;
}

.pricingTable .pricing-content {
padding: 0 15px;
margin: 0 0 30px;
list-style: none;
}

.pricingTable .pricing-content li {
color: #333;
font-size: 17px;
text-align: left;
line-height: 40px;
text-transform: uppercase;
padding: 0 0 0 35px;
margin-bottom: 10px;
position: relative;
}

.pricingTable .pricing-content li:last-child {
margin: 0;
}

.pricingTable .pricing-content li:before,
.pricingTable .pricing-content li:after {
content: "";
background: linear-gradient(to left, <?php echo $color ?>, <?php echo $color2 ?>);
width: 25px;
height: 12px;
border-radius: 20px;
position: absolute;
top: 15px;
left: 0;
}

.pricingTable .pricing-content li:after {
background: #fff;
width: 7px;
height: 7px;
top: 17px;
left: 4px;
}

.pricingTable .pricingTable-signup a {
color: #fff;
background: linear-gradient(to left, <?php echo $color ?>, <?php echo $color2 ?>);
font-size: 25px;
font-weight: 600;
text-transform: uppercase;
padding: 12px 25px;
border-radius: 50px;
transition: all 0.3s ease 0s;
}

.pricingTable .pricingTable-signup a:hover {
background: linear-gradient(to left, <?php echo $color2 ?>, <?php echo $color ?>);
box-shadow: 0 0 5px rgba(0, 0, 0, 0.8);
}
