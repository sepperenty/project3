// function getBaseUrl() {
//     return window.location.href.match(/^.*\//)[0];
// }
var root = "http://localhost/Web_project_vrijwilligerswerk/project3/project3/public/";
//var root = "http://localhost:8000/";
function getBaseUrl() {
    var re = new RegExp(/^.*\//);
    return re.exec(window.location.href);
}