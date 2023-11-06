
function getParameters() {

    var params = new Array();
    var paramsRet = new Array();
    var url = window.location.href;
    var paramsStart = url.indexOf("?");
  
    if (paramsStart != -1) {
      var paramString = url.substring(paramsStart + 1);
      paramString = decodeURIComponent(paramString); 
      var params = paramString.split("&");
      for (var i = 0; i < params.length; i++) {
        var pairArray = params[i].split("="); 
        if (pairArray.length == 2) {
          paramsRet[pairArray[0]] = pairArray[1];
        }
  
      }
      return paramsRet;
    }
    return null;
}
