function get(url,callBack){
    fetch(url)
    .then(response => response.json())
    .then(data => callBack(data));
}