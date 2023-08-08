<?php
if (is_readable('C:\laragon\www\serambi-webgis\public\uploads\BANGUNAN RT 05 EKOR LUBUK_1.shp')) {
    echo "The file is readable.";
} else {
    echo "The file is not readable.";
}
if (is_file('C:\laragon\www\serambi-webgis\public\uploads\BANGUNAN RT 05 EKOR LUBUK_1.shp')) {
    echo "The file is exist.";
} else {
    echo "The file is not exist.";
}
if (is_writable('C:\laragon\www\serambi-webgis\public\uploads\BANGUNAN RT 05 EKOR LUBUK_1.shp')) {
    echo "The file is writeable.";
} else {
    echo "The file is not writeable.";
}
if (is_callable('C:\laragon\www\serambi-webgis\public\uploads\BANGUNAN RT 05 EKOR LUBUK_1.shp')) {
    echo "The file is callable.";
} else {
    echo "The file is not callable.";
}
?>
