var all_applies;
var i = 0;

function fire_yes(uid, eid)
{
  var http = new XMLHttpRequest();
  var url = "helpers/decision.php";
  var params = "user_id="+uid+"&event_id="+eid+"&dec=yes";
  http.open("POST", url, true);

  //Send the proper header information along with the request
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  http.send(params);
}

function fire_no(uid, eid)
{
  var http = new XMLHttpRequest();
  var url = "helpers/decision.php";
  var params = "user_id="+uid+"&event_id="+eid+"&dec=no";
  http.open("POST", url, true);

  //Send the proper header information along with the request
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  http.send(params);
}

function fire_points(eid)
{
  var http = new XMLHttpRequest();
  var url = "helpers/decision.php";
  var params = "eid="+eid;
  http.open("POST", url, true);

  //Send the proper header information along with the request
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  http.send(params);
}

$(document).ready(function(){
    var $all_applies = $(".zgloszenie");
    $(".btnNo").click(function(){
        $($all_applies[i]).animate({ marginLeft: "-100%"} , 450);
        $($all_applies[i]).fadeOut(300);
        i++;  
    });

    $(".btnYes").click(function(){
        $($all_applies[i]).animate({ marginLeft: "100%"} , 450);
        $($all_applies[i]).fadeOut(300);
        i++;  
    });
});

