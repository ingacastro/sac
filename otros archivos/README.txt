This is the README file for PHPlot
Last updated for PHPlot-5.0.4 on 2007-10-20
The project home page is http://sourceforge.net/projects/phplot/
-----------------------------------------------------------------------------

OVERVIEW:

PHPlot is a PHP class for creating scientific and business charts.

The release documentation contains only summary information. For more
complete information, download the PHPlot Reference Manual from the
Sourceforge project web site. For important changes in this release,
see the NEWS.txt file.


CONTENTS:

   ChangeLog  . . . . . . . . . . . Lists changes to the sources
   LICENSE.GPL  . . . . . . . . . . License file
   LICENSE.PHP_3_0  . . . . . . . . License file
   NEWS.txt . . . . . . . . . . . . Highlights changes in releases
   README.txt   . . . . . . . . . . This file
   phplot.php   . . . . . . . . . . The main PHPlot source file
   phplot_data.php  . . . . . . . . Auxiliary and extended functions
   rgb.inc.php  . . . . . . . . . . Optional extended color table


REQUIREMENTS:

You need a recent version of PHP. You must use PHP-4.3.0 or higher, but you
are advised to use the latest stable release of PHP5.  The PHP group has
announced end-of-life for PHP4 as of 2007-12-31, so if you are still using
PHP4 you should upgrade. Future releases of PHPlot may only work with PHP5.

This release of PHPlot has been tested with PHP-5.2.4 and PHP-4.4.7.

You need the GD extension to PHP either built in to PHP or loaded as a
module. Refer to the PHP documentation for more information - see the
Image Functions chapter in the PHP Manual. We test PHPlot only with the
PHP-supported, bundled GD library.

If you want to display PHPlot charts on a web site, you need a PHP-enabled
web server. You can also use the PHP CLI interface without a web server.

PHPlot supports TrueType fonts, but does not include any TrueType font
files.  If you want to use TrueType fonts on your charts, you need to have
TrueType support in GD, and some TrueType font files.  By default, PHPlot
uses a simple font built-in to the GD library.


INSTALLATION:

Unpack the distribution. (If you are reading this file, you have probably
already done that.)

Installation of PHPlot simply involves copying three script files somewhere
your PHP application scripts will be able to find them. The scripts are:
     phplot.php
     phplot_data.php
     rgb.inc.php
(Only phplot.php is necessary for most graphs.)
Make sure the protections on these files allow the web server to read them.

The ideal place is a directory outside your web server document area,
and on your PHP include path. You can add to the include path in the PHP
configuration file; consult the PHP manual for details.


PROBLEMAS:




KNOWN ISSUES:

Here are some of the problems we know about in PHPlot. See the bug tracker
on the PHPlot project web site for more information.

#1795969 The automatic range calculation for Y values needs to be rewritten.  
  This is especially a problem with small offset ranges (e.g. Y=[999:1001]).
  You can use SetPlotAreaWorld to set a specific range instead.

#1605558 Wide/Custom dashed lines don't work well
  This is partially a GD issue, partially PHPlot's fault.

#1795972 and #1795971: Default data colors and default point shapes need to
  be improved.

#945439 Inaccurate label length calculations lead to margin miscalculation

Additional text problems: These occur mostly with TrueType text. The
symptoms include over-sized or under-sized margins, text overlapping
other elements, or text extended outside the image. This is generally worse
with rotated (non-horizontal) text, and multi-line titles.

Tick interval calculations should try for intervals of 1, 2, or 5 times a
power of 10.



TESTING:

You can test your installation by creating the following two files somewhere
in your web document area. 

First, the HTML file:

------------ simpleplot.html ----------------------------


<html>
<head>
<title>Hello, PHPlot!</title>
</head>
<body>
<h1>PHPlot Test</h1>
<img src="simpleplot.php">
</body>
</html>



---------------------------------------------------------



Second, in the same directory, the image file producing PHP script file.
Depending on where you installed phplot.php, you may need to specify a path
in the 'require' line below.

------------ simpleplot.php -----------------------------
<?php
require 'phplot.php';
$plot = new PHPlot();
$data = array(array('', 0, 0), array('', 1, 9));
$plot->SetDataValues($data);
$plot->SetDataType('data-data');
$plot->DrawGraph();
---------------------------------------------------------

Access the URL to 'simpleplot.html' in your web browser. If you see a
simple graph, you have successfully installed PHPlot. If you see no
graph, check your web server error log for more information.





COPYRIGHT and LICENSE:

PHPlot is Copyright (C) 1998-2007 Afan Ottenheimer

This is distributed with NO WARRANTY and under the terms of the GNU GPL
and PHP licenses. If you use it - a cookie or some credit would be nice.

You can get a copy of the GNU GPL at http://www.gnu.org/copyleft/gpl.html
You can get a copy of the PHP License at http://www.php.net/license.html

See http://sourceforge.net/projects/phplot/ for the latest information.

