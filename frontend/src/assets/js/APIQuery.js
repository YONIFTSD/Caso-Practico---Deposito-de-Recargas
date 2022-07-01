
var SearchDni = (function() {
    return function SearchDni(document_number) {
        return fetch('https://apis.reyfact.com/dni/WiVRjaW02IXGC070tOEdjehzrbd0rYOAso1baByj/'+document_number)
        .then(response => response.json())
        .then(json => {
            return json;
        })
    };
})();

var SearchRuc = (function() {
    return function SearchDni(document_number) {
        return fetch('https://apis.reyfact.com/ruc/WiVRjaW02IXGC070tOEdjehzrbd0rYOAso1baByj/'+document_number)
        .then(response => response.json())
        .then(json => {
            return json;
        })
    };
})();

var ExchangeRate = (function() {
    return function ExchangeRate() {
        return fetch('https://apis.reyfact.com/tipo-cambio')
        .then(response => response.json())
        .then(json => {
            return json;
        })
    };
})();



export default {SearchDni,SearchRuc,ExchangeRate}
