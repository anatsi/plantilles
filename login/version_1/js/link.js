function loadURL(url) {
    if(url.substring(0,4)!="http"){
        url = "http://" + document.location.host + url;
    }
    window.location = url;
}