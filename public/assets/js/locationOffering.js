const locationOffering = document.querySelector('.location-offering > div');
const locationOfferingList = document.querySelectorAll('.location-offering-element');
if (!map) {
  const map = document.querySelector('.map');
}

// Спрятать/показать список предложений
locationOffering.addEventListener("click", (e) => {
  locationOfferingList.forEach( element => {
    element.style.display = element.style.display === '' ? 'none' : '';
  });
});

// Отобразить элемент на карте
locationOfferingList.forEach(function (element) {
  element.addEventListener("click", function (e) {
    let x = parseFloat(element.getAttribute('data-x'));
    let y = parseFloat(element.getAttribute('data-y'));
    x = x * map.offsetWidth / 100 - 2.5;// Узнаём координату x в пикселях
    y = y * map.offsetHeight / 100 - 2.5;// Узнаём координату y в пикселях
    mapPointer.style.left = x;
    mapPointer.style.top = y;
  });
});

// При одобрении предложения
locationOfferingList.forEach(function (element) {
  let agreeButtons = element.querySelectorAll('.agree');
  agreeButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      // Ищем нужного родителя и берем данные о метке
      let parent = button.closest('.location-offering-element');
      let pointerId = parseInt(parent.getAttribute('data-pointer-id'));
      let x = +parseFloat(parent.getAttribute('data-x')).toFixed(2);
      let y = +parseFloat(parent.getAttribute('data-y')).toFixed(2);
      let questID = parseInt(parent.getAttribute('data-quest-id'));

      //Создаем запрос
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "/admin/", true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.send(JSON.stringify({
        action: 'agree',
        pointer_id: pointerId,
        x: x,
        y: y,
        quest_id: questID,
      }));
      xhr.onreadystatechange = function () {
        if (xhr.readyState != 4) return;
        if (xhr.status != 200) {
          alert(xhr.status + ': ' + xhr.statusText);
        } else {
          let response = JSON.parse(xhr.responseText);
          if (response.status) {
            parent.remove();
            console.log(response.text);
          } else {

          }
        }
      }
    });
  });
});

// При отклонении предложения
locationOfferingList.forEach(function (element) {
  let agreeButtons = element.querySelectorAll('.degree');
  agreeButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      // Ищем нужного родителя и берем данные о метке
      let parent = button.closest('.location-offering-element');
      let pointerId = parseInt(parent.getAttribute('data-pointer-id'));
      //Создаем запрос
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "/admin/", true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.send(JSON.stringify({
        action: 'degree',
        pointer_id: pointerId
      }));
      xhr.onreadystatechange = function () {
        if (xhr.readyState != 4) return;

        if (xhr.status != 200) {
          alert(xhr.status + ': ' + xhr.statusText);
        } else {
          let response = JSON.parse(xhr.responseText);
          if (response.status) {
            parent.remove();
            console.log(response.text);
          } else {

          }
        }
      }
    });
  });
});




