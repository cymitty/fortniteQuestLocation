"use strict";
var questId;
const quests = document.querySelector('.quests');
const questsToggle = document.querySelector('.quests-toggle');
const questList = document.querySelectorAll('.quest-list');
const questListItems = document.querySelectorAll('.quest-list-item');
const mapPointer = document.querySelector(".map-pointer");
const map = document.querySelector(".map");
// map.style.backgroundColor = "red";
// map.style.width  = "200px";
// map.style.height = "200px";
const garbageArea = document.querySelector(".xhr-response");

questsToggle.addEventListener("click", element => {
 if (quests.hidden == true) {
   quests.hidden = false;
   return;
 }
 quests.hidden = true;
});




// Add new pointer
map.addEventListener("click", function (e) {
  let x = e.offsetX==undefined?e.layerX:e.offsetX;
  let y = e.offsetY==undefined?e.layerY:e.offsetY;
  // Узнаем координаты в процентах
  x = ( x * 100 / parseFloat(map.offsetWidth) ).toFixed(2);
  y = ( y * 100 / parseFloat(map.offsetHeight) ).toFixed(2);
  if (questId != null)
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/newpointer", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({
      id: questId,
      x: x,
      y: y,
    }));
    xhr.onreadystatechange = function () {
      if (xhr.readyState != 4) return;

      if (xhr.status != 200) {
        alert(xhr.status + ': ' + xhr.statusText);
      } else {
        garbageArea.innerHTML = xhr.responseText;
        let response = JSON.parse(xhr.responseText);
        if (response.status != 1) { console.log('Координаты не добавлены'); return; }
        console.log('Были присвоены координаты к квесту');
        return;
      }
    }
  }
});

// открыть квесты hover event
// questList.forEach(function (element) {
//   element.addEventListener("mouseenter", function(event) {
//     let questListChildrens = Array.from(this.children);
//     questListChildrens.forEach(function (item) {
//       item.removeAttribute("hidden");
//     });
//   });
// });
// questList.forEach(function (element) {
//   element.addEventListener("mouseleave", function(event) {
//     let questListChildrens = Array.from(this.children);
//     questListChildrens.forEach(function (item) {
//       if (item.classList.contains('quest-list-item'))
//       item.hidden = true;
//     });
//   });
// });

// открыть задания по клику
questList.forEach( element => {
  element.addEventListener("click", e => {
    let questListChildrens = Array.from(element.children);
      questListChildrens.forEach(function (item) {
        if (item.classList.contains('quest-list-item') && item.hidden == true) {
          item.hidden = false;
          return;
        } else {
          item.hidden = true;
        }
      });
  });  
});


// Показать метку на карте
questListItems.forEach(element => {
  element.addEventListener("click", e => {
    let questID = element.getAttribute("data-id");
    questId = questID;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/index', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify({id: questID}));
    xhr.onreadystatechange = function () {
      if (xhr.readyState != 4) return;
      
      if (xhr.status != 200) {
        alert(xhr.status + ': ' + xhr.statusText);
      } else {
        if (xhr.responseText != false) {
          console.log(xhr.responseText);
          let pointer = JSON.parse(xhr.responseText);
          // createPointerElement(pointer.x, pointer.y);
          updateMapPointerCoordinates(pointer.x, pointer.y);
          return;
        }
        console.log('Извините, информация о метке на данный момент отсутствует');
      }  
    }
     quests.hidden = true;
  });
});

document.addEventListener("keyup", (e) => {
  if (e.keyCode == 27) { // escape key maps to keycode `27`
     // <DO YOUR WORK HERE>
     quests.hidden = true;
  }
});


function updateMapPointerCoordinates(x, y) {
  // Координаты приходят в px - превращаем в проценты
  x = x * map.offsetWidth / 100 - 2.5;// Узнаём координату x в пикселях
  y = y * map.offsetHeight / 100 - 2.5;// Узнаём координату y в пикселях
  mapPointer.style.left = x;
  mapPointer.style.top = y;
}

function findQuestById(id) {
  // questListItems.forEach(element => {
  //   if (element.getAttribute("data-id") == id)
  //   {
  //
  //   }
  // });
}

