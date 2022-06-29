/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/find-pairs.js":
/*!************************************!*\
  !*** ./resources/js/find-pairs.js ***!
  \************************************/
/***/ (() => {

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var start = document.querySelector('#start');
start.addEventListener('click', startGame);
var newGame = document.querySelector('#theEnd');
newGame.addEventListener("click", goNewGame);
var divGame = document.querySelector('#game');
var blocks = divGame.querySelectorAll('td');
var timer = divGame.querySelector('#timer');
var active = 'active';

var setDefaultColor = function setDefaultColor(elem) {
  return elem.style.background = 'white';
};

var setNewGameColor = function setNewGameColor(elem) {
  return elem.style.background = '#ddd';
};

var colors = fillArray();
var obj = createObj();
var arrTd = [];
var countMove = 0; // functions

var clearArray = function clearArray() {
  return [];
};

var disable = function disable(elem) {
  return elem.disabled = true;
};

var activate = function activate(elem) {
  return elem.classList.add(active);
};

var deactivate = function deactivate(elem) {
  return elem.classList.remove(active);
};

var isActive = function isActive(elem) {
  return elem.classList.contains(active);
};

var initBlocks = function initBlocks(clickMode) {
  var _iterator = _createForOfIteratorHelper(blocks),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var block = _step.value;
      activate(block);
      block.addEventListener('click', clickMode);
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
};

var reInitBlock = function reInitBlock(clickMode) {
  var _iterator2 = _createForOfIteratorHelper(blocks),
      _step2;

  try {
    for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
      var block = _step2.value;

      if (!isActive(block)) {
        block.removeEventListener('click', clickMode);
      }
    }
  } catch (err) {
    _iterator2.e(err);
  } finally {
    _iterator2.f();
  }
};

var colorBack = function colorBack(elem) {
  return elem.style.background;
};

var Win = function Win() {
  return !divGame.querySelectorAll('.active').length;
};

function startGame() {
  disable(start);
  timerGame();
  initBlocks(clickMode);

  function clickMode() {
    countMove++;
    this.style.background = obj[this.innerHTML];
    arrTd.push(this);
    correctClicks(arrTd);

    if (arrTd.length === 2) {
      colorBack(arrTd[0]) === colorBack(arrTd[1]) ? getMatch() : notMatch();
    }
  }

  function getMatch() {
    deactivate(arrTd[0]);
    deactivate(arrTd[1]);
    arrTd = clearArray();
    reInitBlock(clickMode);
  }

  function notMatch() {
    var _iterator3 = _createForOfIteratorHelper(blocks),
        _step3;

    try {
      for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
        var td = _step3.value;
        td.removeEventListener('click', clickMode);
      }
    } catch (err) {
      _iterator3.e(err);
    } finally {
      _iterator3.f();
    }

    var id = setTimeout(function () {
      setDefaultColor(arrTd[0]);
      setDefaultColor(arrTd[1]);
      arrTd = clearArray();

      var _iterator4 = _createForOfIteratorHelper(blocks),
          _step4;

      try {
        for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
          var td = _step4.value;

          if (td.classList.contains('active')) {
            td.addEventListener('click', clickMode);
          }
        }
      } catch (err) {
        _iterator4.e(err);
      } finally {
        _iterator4.f();
      }

      clearTimeout(id);
    }, 300);
  }

  function correctClicks(blocks) {
    if (blocks[0] === blocks[1]) {
      blocks.splice(1);
    }

    if (blocks.length > 2) {
      blocks.splice(2);
    }
  }

  function timerGame() {
    timer.innerHTML = "00:00:000";
    var millisec = 0;
    var seconds = 0;
    var minutes = 0;
    var time = new Date().getTime();
    var id = setInterval(function () {
      millisec = new Date().getTime() - time;

      if (millisec > 999) {
        time = new Date().getTime();
        seconds++;
      }

      if (seconds > 59) {
        seconds = 0;
        minutes++;
      }

      if (Win()) {
        clearInterval(id);
        modalWindow();
      }

      timer.innerHTML = "".concat(getZero(minutes), ":").concat(getZero(seconds), ".").concat(millisec);
    }, 1);
  }

  var getZero = function getZero(num) {
    return num < 10 ? "0".concat(num) : num;
  };

  function modalWindow() {
    document.querySelector('#winner').style.display = 'grid';
    document.querySelector('#yourTime').innerHTML = "".concat(countMove, " \u0445\u043E\u0434\u043E\u0432");
  }
}

function goNewGame() {
  countMove = 0;
  obj = createObj();
  timer.innerHTML = "00:00.000";
  document.querySelector('#winner').style.display = 'none';
  start.disabled = false;

  var _iterator5 = _createForOfIteratorHelper(blocks),
      _step5;

  try {
    for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
      var block = _step5.value;
      setNewGameColor(block);
    }
  } catch (err) {
    _iterator5.e(err);
  } finally {
    _iterator5.f();
  }
}

function fillArray() {
  return ['1', 'red', 'red', 'green', 'green', 'blue', 'blue', 'black', 'black', 'yellow', 'yellow', 'hotpink', 'hotpink', 'indigo', 'indigo', 'magenta', 'magenta'];
}

function createObj() {
  var obj = {};
  var set = new Set();

  while (set.size !== 16) {
    set.add(Math.ceil(Math.random() * 16));
  }

  newObj(set, obj);
  return obj;
}

function newObj(arr, obj) {
  var i = 0;
  arr.forEach(function (elem) {
    i++;
    obj[i] = colors[elem];
  });
}

/***/ }),

/***/ "./resources/css/scss/app.scss":
/*!*************************************!*\
  !*** ./resources/css/scss/app.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/find-pairs": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/find-pairs.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/scss/app.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;