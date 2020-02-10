/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dashboard/vehicleList.js":
/*!***********************************************!*\
  !*** ./resources/js/dashboard/vehicleList.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
    Script für Vehicle Liste:
    (vehicle.all View)

    sämtliche AJAX-Requests für den Info-Container (Sidebox)
    Load-in Animation der Liste
    Quick-Delete Logik für Liste

    Dep: JQuery, anime.js
*/
(function () {
  var items = document.querySelectorAll('.list-item');
  var container = document.querySelector('.side-box'); // Vertikaler Abstand Sideboxkante - Cusor

  var spacing = 5; // Beschreibt den aktuellen Zustand der Sidebox

  var visible = false; // Wird ausgeführt, wenn auf List-Item geklickt wird

  var clicked = function clicked(event) {
    event.preventDefault();
    getData(event.target.dataset.id);
    moveContainer(event);
    toggleVisibility(true);
  }; // Wird bei Klicken des x und bei Scrollen ausgeführt


  var hideBox = function hideBox(event) {
    event.preventDefault();

    if (container.style.display !== 'none') {
      toggleVisibility(false);
    }
  }; // Sendet Vehicle AJAX Request und gibt Response an displayData Methode weiter


  var getData = function getData(id) {
    var url = "/vehicles/" + id + "/getData";
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });
    $.ajax({
      url: url,
      method: 'get',
      success: function success(res) {
        displayData(res);
      }
    });
  }; // Befüllt Side-Box mit angefragten Daten


  var displayData = function displayData(data) {
    // dynamische Kosten-Zuweisung (um 'undefined' zu verhindern)
    totalCost = data.totalCost ? data.totalCost : 0;
    document.getElementById('currentMake').innerText = data.make;
    document.getElementById('currentModel').innerText = data.model;
    document.getElementById('currentKm').innerText = data.km;
    document.getElementById('currentPlate').innerText = data.plate;
    document.getElementById('currentCosts').innerText = totalCost;
    document.getElementById('currentMakeIcon').innerHTML = data.make_icon;
    document.getElementById('currentSelect').href = '/vehicles/' + data.id + "/select";
    document.getElementById('currentMain').href = '/vehicles/' + data.id + "/main";
    document.getElementById('currentEdit').href = '/vehicles/' + data.id + "/edit";
    document.getElementById('selectForm').action = "/vehicles/" + data.id + "/select";
    document.getElementById('mainForm').action = "/vehicles/" + data.id + "/main";
  }; // Bewegt Container unter/über Cursor (jenachdem ob sich Cursor über/unter der Bildschirmhälfte befindet)


  var moveContainer = function moveContainer(event) {
    var containerRect = container.getBoundingClientRect(); // Maße der Side-Box
    // dynamische Y-Position-Zuordnung

    var y;

    if (event.clientY < window.innerHeight / 2) {
      y = event.clientY - spacing;
    } else {
      y = event.clientY - containerRect.height - spacing;
    }

    var x = event.clientX - containerRect.width / 2; // Zentriert auf horizontaler Achse

    container.style.left = x + "px";
    container.style.top = y + "px";
  }; // Animiert Side-Box Aus/Ein


  var toggleVisibility = function toggleVisibility(dir) {
    if (!dir) {
      visible = false;
      anime({
        targets: '.side-box',
        easing: 'easeOutSine',
        duration: 140,
        height: 0
      });
      setTimeout(function () {
        container.style.display = 'none';
      }, 150);
      container.setAttribute('aria-hidden', true);
    } else {
      container.style.display = 'flex';
      visible = true;
      anime({
        targets: '.side-box',
        easing: 'easeOutSine',
        duration: 120,
        height: 300
      });
      container.setAttribute('aria-hidden', false);
    }
  }; // Event Listener für Click und Scroll


  var initEventListening = function initEventListening() {
    for (var i = 0; i < items.length; i++) {
      items[i].onclick = clicked;
    }
  };

  initEventListening(); // Schließt Side-Box bei Klick auf das X

  document.getElementById('sideCloser').onclick = hideBox; // QUICK-DELETE

  var quickBtn = document.getElementById('quickDelete');
  var deleting = false; // Enählt aktuellen Listenmodus

  var quickClicked = function quickClicked(event) {
    event.preventDefault();

    if (deleting) {
      deleting = false;
      initEventListening();
    } else {
      deleting = true;
      initDelEvents();
    }

    changeButtonStyle();
    changeList();
  };

  var clickedOnVehicle = function clickedOnVehicle(event) {
    if (confirm('Are you sure you want to delete ?')) {} else {}
  };

  var changeButtonStyle = function changeButtonStyle() {
    if (deleting) {
      quickBtn.classList.add('selected');
      quickBtn.innerText = "Deleting";
    } else {
      quickBtn.classList.remove('selected');
      quickBtn.innerText = "Delete";
    }
  };

  var changeList = function changeList() {
    if (deleting) {
      document.querySelector('.list').classList.add('deleting');
    } else {
      document.querySelector('.list').classList.remove('deleting');
    }
  };

  var initDelEvents = function initDelEvents() {
    for (var i = 0; i < items.length; i++) {
      items[i].onclick = clickedOnVehicle;
    }
  };

  quickBtn.onclick = quickClicked;
})();

/***/ }),

/***/ 5:
/*!*****************************************************!*\
  !*** multi ./resources/js/dashboard/vehicleList.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/js/dashboard/vehicleList.js */"./resources/js/dashboard/vehicleList.js");


/***/ })

/******/ });