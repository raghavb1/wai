<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  </head>
  <body>
<script type=
    "text/javascript" src="jquery-1.2.6.min.js">
</script><script type="text/javascript" src="jquery.starRating.js">
</script><script type="text/javascript" language="JavaScript">
//<![CDATA[
    <!--


    //functions for non plugin based star rating
    function bgpos(left,top) {
        $("#starBlue").css("background-position",(left + "px " + top + "px"));
    }

    function bgpos2(val,which) {
        if($(which).attr("src") == "smileys/star.gif") {
                $(which).attr("src","smileys/star_blue.gif");
                $(which).prevAll().attr("src","smileys/star_blue.gif");
        }
        else { 
                $(which).attr("src","smileys/star.gif");
                $(which).nextAll().attr("src","smileys/star.gif");
        }
    }
    //-->
    //]]>
    </script>
    <div id="star_rating">
    <?php 
	for($i=1;$i<=10;$i++)
	{
    echo '<img src="star.gif" onmouseover="bgpos2('.$i.',this);"/>';
	}
?>
    </div>
  </body>
</html>