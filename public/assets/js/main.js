"use strict";
class FortniteMap {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }
}
const questList = document.querySelectorAll('.quest-list');
const questListItems = document.querySelectorAll('.quest-list-item');
const mapPointer = document.querySelector(".map-pointer");
const pointers = document.querySelector(".pointers");
const pointersList = pointers.children;
const map = document.querySelector(".map");
// map.style.backgroundColor = "red";
// map.style.width  = "200px";
// map.style.height = "200px";
const garbageArea = document.querySelector(".xhr-response");

const pointersData = [
  {x: 34, y: 50},
  {x: 14, y: 10},
  {x: 80, y: 30},
  {x: 90, y: 50}
];
// Добавляем элементы массива в questList
pointersData.forEach(function (pointerData, index) {
  let pointer = document.createElement("div");
  pointer.classList.add("pointer");
  pointer.setAttribute('data-x', pointerData.x);
  pointer.setAttribute('data-y', pointerData.y);
  pointer.innerHTML = "pointer Coordinates:" +
    " x: " + pointerData.x +
    " y: " + pointerData.y;
  pointers.appendChild(pointer);
});

// Add new pointer
map.addEventListener("click", function (e) {
  let x = e.offsetX==undefined?e.layerX:e.offsetX;
  let y = e.offsetY==undefined?e.layerY:e.offsetY;
 // console.log(`${x} ${y}`);
  // Узнаем координаты в процентах
  //Нужен map.width (DIV!)
  x = ( x * 100 / parseFloat(map.offsetWidth) ).toFixed(2);
  y = ( y * 100 / parseFloat(map.offsetHeight) ).toFixed(2);
  //console.log(`${x} ${y}`);
  console.log(`${map.offsetWidth} ${map.offsetHeight}`);
  // Новый элемент в список pointers
  //console.log(createPointerElement(x, y));
  let pointer = createPointerElement(x, y);
  // Добавляем в eventlistener onlick
  updatePointerEventListener(pointer);
});

// На каждый pointer вешаем клик
var pointersListArr = Array.from(pointersList);
pointersListArr.forEach(function (pointer) {
  pointer.addEventListener("click", function (event) {
    let x = this.getAttribute("data-x") * map.offsetWidth / 100 - 2.5;// Узнаём координату x в пикселях
    let y = this.getAttribute("data-y") * map.offsetHeight / 100 - 2.5;// Узнаём координату y в пикселях
    mapPointer.style.left = x;
    mapPointer.style.top = y;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/xhr', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
      "x": x,
      "y": y
    }));
    xhr.onreadystatechange = function () {
      if (xhr.readyState != 4) return;
      
      if (xhr.status != 200) {
        alert(xhr.status + ': ' + xhr.statusText);
      } else {
         garbageArea.innerHTML = xhr.responseText;
      }  
    }
  });
});




questList.forEach(function (element) {
  element.addEventListener("mouseenter", function(event) {
    let questListChildrens = Array.from(this.children);
    questListChildrens.forEach(function (item) {
      item.removeAttribute("hidden");
    });
  });
});

questList.forEach(function (element) {
  element.addEventListener("mouseleave", function(event) {
    let questListChildrens = Array.from(this.children);
    questListChildrens.forEach(function (item) {
      if (item.classList.contains('quest-list-item'))
      item.hidden = true;
    });
  });
});

questListItems.forEach(element => {
  element.addEventListener("click", e => {
    let pointerId = element.getAttribute("data-id");
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/index', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({id: pointerId}));
    xhr.onreadystatechange = function () {
      if (xhr.readyState != 4) return;
      
      if (xhr.status != 200) {
        alert(xhr.status + ': ' + xhr.statusText);
      } else {
        if (xhr.responseText != false) {
          console.log(xhr.responseText);
          let pointer = JSON.parse(xhr.responseText);
          createPointerElement(pointer.x, pointer.y);
          updateMapPointerCoordinates(pointer.x, pointer.y);
          return;
        }
        console.log('Извините, информация о метке на данный момент отсутствует');
      }  
    }
  });
});


function updateMapPointerCoordinates(x, y) {
  // Координаты приходят в px - превращаем в проценты
  x = x * map.offsetWidth / 100 - 2.5;// Узнаём координату x в пикселях
  y = y * map.offsetHeight / 100 - 2.5;// Узнаём координату y в пикселях
  mapPointer.style.left = x;
  mapPointer.style.top = y;
}

// Добавляет элемент в список pointers и вешает на него eventlistener
function createPointerElement (pointerX, pointerY) {
  let pointer = document.createElement("div");
  pointer.classList.add("pointer");
  pointer.setAttribute('data-x', pointerX);
  pointer.setAttribute('data-y', pointerY);
  pointer.innerHTML = "pointer Coordinates:" +
    " x: " + pointerX +
    " y: " + pointerY;
  pointers.appendChild(pointer);
  updatePointerEventListener(pointer);
  return pointer;
}


// add new Pointer in EventListener
function updatePointerEventListener(pointer) {
    pointer.addEventListener("click", function (event) {

      let x = this.getAttribute("data-x") * map.offsetWidth / 100 - 5;// Узнаём координату x в пикселях
      let y = this.getAttribute("data-y") * map.offsetHeight / 100 - 5;// Узнаём координату y в пикселях
      mapPointer.style.left = x;
      mapPointer.style.top = y;
      // pointer.x * x * 100
    })
}
