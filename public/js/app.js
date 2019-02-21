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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ 6:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(7);


/***/ }),

/***/ 7:
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: Cannot find module '@babel/core'\n    at Function.Module._resolveFilename (internal/modules/cjs/loader.js:548:15)\n    at Function.Module._load (internal/modules/cjs/loader.js:475:25)\n    at Module.require (internal/modules/cjs/loader.js:598:17)\n    at require (internal/modules/cjs/helpers.js:11:18)\n    at Object.<anonymous> (/home/dani/Code/architect-iga/node_modules/babel-core/index.js:2:18)\n    at Module._compile (internal/modules/cjs/loader.js:654:30)\n    at Object.Module._extensions..js (internal/modules/cjs/loader.js:665:10)\n    at Module.load (internal/modules/cjs/loader.js:566:32)\n    at tryModuleLoad (internal/modules/cjs/loader.js:506:12)\n    at Function.Module._load (internal/modules/cjs/loader.js:498:3)\n    at Module.require (internal/modules/cjs/loader.js:598:17)\n    at require (internal/modules/cjs/helpers.js:11:18)\n    at Object.<anonymous> (/home/dani/Code/architect-iga/node_modules/babel-loader/lib/index.js:3:13)\n    at Module._compile (internal/modules/cjs/loader.js:654:30)\n    at Object.Module._extensions..js (internal/modules/cjs/loader.js:665:10)\n    at Module.load (internal/modules/cjs/loader.js:566:32)\n    at tryModuleLoad (internal/modules/cjs/loader.js:506:12)\n    at Function.Module._load (internal/modules/cjs/loader.js:498:3)\n    at Module.require (internal/modules/cjs/loader.js:598:17)\n    at require (internal/modules/cjs/helpers.js:11:18)\n    at loadLoader (/home/dani/Code/architect-iga/node_modules/loader-runner/lib/loadLoader.js:18:17)\n    at iteratePitchingLoaders (/home/dani/Code/architect-iga/node_modules/loader-runner/lib/LoaderRunner.js:169:2)\n    at runLoaders (/home/dani/Code/architect-iga/node_modules/loader-runner/lib/LoaderRunner.js:365:2)\n    at NormalModule.doBuild (/home/dani/Code/architect-iga/node_modules/webpack/lib/NormalModule.js:182:3)\n    at NormalModule.build (/home/dani/Code/architect-iga/node_modules/webpack/lib/NormalModule.js:275:15)\n    at Compilation.buildModule (/home/dani/Code/architect-iga/node_modules/webpack/lib/Compilation.js:157:10)\n    at factoryCallback (/home/dani/Code/architect-iga/node_modules/webpack/lib/Compilation.js:348:12)\n    at factory (/home/dani/Code/architect-iga/node_modules/webpack/lib/NormalModuleFactory.js:243:5)\n    at applyPluginsAsyncWaterfall (/home/dani/Code/architect-iga/node_modules/webpack/lib/NormalModuleFactory.js:94:13)\n    at /home/dani/Code/architect-iga/node_modules/tapable/lib/Tapable.js:268:11");

/***/ })

/******/ });