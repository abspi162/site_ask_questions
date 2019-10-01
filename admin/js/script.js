function getAllUrlParams(url) {

    // извлекаем строку из URL или объекта window
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

    // объект для хранения параметров
    var obj = {};

    // если есть строка запроса
    if (queryString) {

        // данные после знака # будут опущены
        queryString = queryString.split('#')[0];

        // разделяем параметры
        var arr = queryString.split('&');

        for (var i=0; i<arr.length; i++) {
            // разделяем параметр на ключ => значение
            var a = arr[i].split('=');

            // обработка данных вида: list[]=thing1&list[]=thing2
            var paramNum = undefined;
            var paramName = a[0].replace(/\[\d*\]/, function(v) {
                paramNum = v.slice(1,-1);
                return '';
            });

            // передача значения параметра ('true' если значение не задано)
            var paramValue = typeof(a[1])==='undefined' ? true : a[1];

            // преобразование регистра
            paramName = paramName.toLowerCase();
            paramValue = paramValue.toLowerCase();

            // если ключ параметра уже задан
            if (obj[paramName]) {
                // преобразуем текущее значение в массив
                if (typeof obj[paramName] === 'string') {
                    obj[paramName] = [obj[paramName]];
                }
                // если не задан индекс...
                if (typeof paramNum === 'undefined') {
                    // помещаем значение в конец массива
                    obj[paramName].push(paramValue);
                }
                // если индекс задан...
                else {
                    // размещаем элемент по заданному индексу
                    obj[paramName][paramNum] = paramValue;
                }
            }
            // если параметр не задан, делаем это вручную
            else {
                obj[paramName] = paramValue;
            }
        }
    }

    return obj;
}


function viewd(id) {
    var el = document.getElementById(id);
    if (el.style.display == "block") {
        el.style.display = "none";
    } else {
        el.style.display = "block";
    }
}

function hider(ab,bc){

        if (document.getElementById(bc).hidden == false) {
            document.getElementById(bc).hidden = true;
        } else {
            document.getElementById(bc).hidden = false;
        }
}



if(getAllUrlParams().id == 1) {
    document.getElementById('user').hidden = false;
    document.getElementById('answer').hidden = true;
    document.getElementById('question').hidden = true;
}
if(getAllUrlParams().id == 2) {
    document.getElementById('user').hidden = true;
    document.getElementById('answer').hidden = true;
    document.getElementById('question').hidden = false;
}
if(getAllUrlParams().id == 3) {
    document.getElementById('user').hidden = true;
    document.getElementById('answer').hidden = false;
    document.getElementById('question').hidden = true;
}



